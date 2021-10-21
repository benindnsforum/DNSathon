import urllib3
import sys
import dns.resolver
import dns.ttl
import socket
from cymruwhois import Client
import os
import re, socket, subprocess
import time
import requests

infos = {}


def check_if_dns_exist(domain):
	try:
		socket.gethostbyname(domain)
		infos['EXIST'] = True
		return True
	except socket.gaierror:
		return False


def check_soa(domain):
	try:
		answer = dns.resolver.resolve(domain, "SOA")
		infos['INFO_SOA'] = True
	except dns.resolver.NoAnswer:
		infos['INFO_SOA'] = False


def check_mx(domain):
	try:
		answer = dns.resolver.resolve(domain, "MX")
		mx = []
		for rdata in answer:
			mx.append(rdata.to_text())
		infos['INFO_MX'] = {
			'exist': True,
			'list': mx,
			'number': len(mx)
		}
	except dns.resolver.NoAnswer:
		infos['INFO_MX'] = {
			'exist': False,
			'list': 0,
			'number': 0
		}


def check_ns(domain="gouv.bj"):
	result = dns.resolver.resolve(domain, 'NS')
	ns_len = len(result)
	ns = []
	for ipval in result:
		ns.append(ipval.to_text())
	infos['INFO_NS'] = {
		'list': ns,
		'number': ns_len,
	}
	#Get localisation
	infos['INFO_NS']['ns_location'] = {}
	for name in ns:
		ip = socket.gethostbyname(name)
		response = requests.get('http://ip-api.com/json/'+ip)
		res = response.json()
		infos['INFO_NS']['ns_location'][name] = res['country']+", "+res['city']



	#  Check ASN
	if ns_len >= 2:
		asn = 0
		for name in ns:
			ip = socket.gethostbyname(name)
			c = Client()
			r = c.lookup(ip)

			if asn == 0:
				asn = r.asn
			elif asn != r.asn:
				infos['INFO_NS']['same_asn'] = False
			else:
				asn = r.asn
				infos['INFO_NS']['same_asn'] = True


# Define a function to resolver nameserver into ipv4.
def ns_resolver(ns: str) -> str:
	try:
		res = socket.getaddrinfo(ns, None, socket.AF_INET)[0][4][0]
	except Exception as e:
		res = 'Failed'
	return res


# Define a function to resolver nameserver into ipv6.
def ns_resolverV6(ns: str) -> str:
	try:
		res = socket.getaddrinfo(ns, None, socket.AF_INET6)[0][4][0]
	except Exception as e:
		res = 'Failed'
	return res


# Define the function to extract list of NS for each ccTLDs
def domain_ns_retrieval(domain: str) -> str:
	try:
		res = [ns.__str__() for ns in dns.resolver.resolve(domain, 'NS')]
	except Exception as e:
		res = 'U'
	return res


# Define EDNS Tests list
edns_test_dict = {'dns_plain': ['dig', '+norec', '+noedns', 'soa'],
				  'edns_plain': ['dig', '+norec', '+edns=0', 'soa'],
				  'edns_dnssec': ['dig', '+norec', '+dnssec', 'soa'],
				  'edns_tcp': ['dig', '+norec', '+tcp', 'soa']}


# Define function to execute dig command
def run_dig_cmd(cmd: list, pkt_size=False, flag=False, aa_zone=None)  -> list:
	status = None
	edns_version = None
	pckt_size, flags, answer_section, rrsig = None, None, None, None
	result = subprocess.run(
		cmd, stdout=subprocess.PIPE).stdout.decode('utf-8').split(';;')
	for line in result:
		if re.search('RRSIG', line):
			rrsig = True
		if re.search('status:', line):
			status = line.split(',')[1].split(':')[1].strip()
		elif re.search('EDNS: version: 0', line):
			edns_version = 0
			if pkt_size:
				pckt_size = line.split('; ')[2].split(':')[1].replace(' ', '').replace('\n', '')  # Get the Maximum UDP packet size
			if flag:
				flags = line.split(';')[1].split(':')[3].replace('\n', '').split(' ')  # Get the flags
		elif aa_zone is not None and re.search('ANSWER SECTION', line):
			answer_section = True if re.search(aa_zone, line) else None  # Get the flags
	return status, edns_version, pckt_size, flags, answer_section, rrsig, result


# Define function to run tests on NS
def run_ednsComp_test(zone: str, ns: str):
	# Reset results vars
	dns_plain, edns_plain, edns_dnssec, edns_tcp = False, False, False, False
	packet_size = 0
	# Test DNS plain resolution first
	dns_plain = True if run_dig_cmd(edns_test_dict['dns_plain'] + [zone, '@' + ns], aa_zone=zone)[:-2] == ('NOERROR', None, None, None, True) else False
	if dns_plain:
		# Test EDNS plain resolution first
		edns_plain_test = run_dig_cmd(edns_test_dict['edns_plain'] + [zone, '@' + ns], pkt_size=True)[:-1]
		packet_size = edns_plain_test[2]
		edns_plain = True if edns_plain_test[:-1] == ('NOERROR', 0, packet_size, None, None) else False

		edns_dnssec_test = run_dig_cmd(edns_test_dict['edns_dnssec'] + [zone, '@' + ns], aa_zone=zone, flag=True)[:-1]
		try:
			if 'do' in edns_dnssec_test[3] and edns_dnssec_test[4] and edns_dnssec_test[5] and edns_dnssec_test[0:2] == ('NOERROR', 0):
				edns_dnssec = True
		except Exception:
			edns_dnssec = False

		edns_tcp = True if run_dig_cmd(edns_test_dict['edns_tcp'] + [zone, '@' + ns])[0:2] == ('NOERROR', 0) else False

	#t_results = [ns, dns_plain, edns_plain, edns_dnssec, edns_tcp, packet_size, zone]
	t_results = {'ZONE': zone, 'NAMESERVER': ns, 'DNS': dns_plain, 'EDNS': edns_plain,
				 'DNSSEC': edns_dnssec,'TCP': edns_tcp, 'PACKET_SIZE': packet_size,
				 'IPv4': ns_resolver(ns=ns), 'IPv6': ns_resolverV6(ns=ns)}
	return t_results


def edns_tests_full(domain: str, nameserver: str = None) -> list:
	all_results = []
	nameservers = domain_ns_retrieval(domain=domain)
	print(nameservers)
	all_results.append(run_ednsComp_test(zone=domain, ns=nameservers[0]))
	if all_results[0]['EDNS']:
		infos['PERFORMANCE_EDNS'] = True
	else:
		infos['PERFORMANCE_EDNS'] = True


def check_dnssec(domain):
	dnssec = os.popen(f"dig {domain} +dnssec @9.9.9.9|egrep -w '^flags|ad'|wc -l")
	dnssec = dnssec.read()
	infos['SEC_DNSSEC'] = {}
	if int(dnssec) == 0:
		infos['SEC_DNSSEC']['exist'] = False
	else:
		infos['SEC_DNSSEC']['exist'] = True

	val = os.popen(f"dig DNSKEY {domain} +dnssec @9.9.9.9|egrep -w '^flags|ad'|wc -l")
	val = val.read()
	if int(val) == 0:
		infos['SEC_DNSSEC']['dns_key'] = False
	else:
		infos['SEC_DNSSEC']['dns_key'] = True

	val = os.popen(f"dig DS {domain} +trace @9.9.9.9|egrep -w '^flags|ad'|wc -l")
	val = val.read()
	if int(val) == 0:
		infos['SEC_DNSSEC']['ds'] = False
	else:
		infos['SEC_DNSSEC']['ds'] = True


def check_ipv6(domain):
	try:
		answer = dns.resolver.resolve(domain, "AAAA")
		infos['INFO_IPV6'] = True
	except dns.resolver.NoAnswer:
		infos['INFO_IPV6'] = False
	# except dns.resolver.NXDOMAIN:
	#     print "No such domain"


def check_ssl(domain):
	try:
		http =  urllib3.PoolManager(cert_reqs='CERT_REQUIRED')
		http.request('GET', f"https://{domain}")
		infos['SEC_SSL'] = True
	except Exception:
		infos['SEC_SSL'] = False


def get_performance(domain):
	dns_start = time.time()
	socket.gethostbyname(domain)
	dns_end = time.time()
	dnstime = (dns_end - dns_start) *1000
	infos['PERFORMANCE_DNSTIME'] ='%.2f ms' % dnstime