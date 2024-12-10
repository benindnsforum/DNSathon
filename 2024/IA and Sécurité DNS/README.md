# IA et sécurité

## Tips

### Convertir un fichier pcap en csv
```bash
tshark -T fields -n -r {the pathname of the capture file} -E separator=, -e {first field name} -e {second field name} ... >{the pathname of the output file}
```

Exemple
```bash
tshark -T fields -n -r capture.pcap -E separator=, -e ip.src -e ip.dst ... > output.csv
```

## Références

- [dnsperf](https://www.dns-oarc.net/files/dnsperf/2.0.0.0/dnsperf.pdf)
- [hping3](https://www.geeksforgeeks.org/hping3-command-in-linux/)
- [PoC to perform DDoS using DNS amplification technique](https://github.com/r3vskd/Meteorain)
- [Anomaly detection based on DNS traffic analysis](https://github.com/mannirulz/BotDAD)
- [An ML tool for performing anomaly detection on DNS requests](https://github.com/Xenios91/DNS_Anomaly_Finder)
