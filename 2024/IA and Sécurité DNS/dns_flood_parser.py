from scapy.all import rdpcap, DNSQR
import pandas as pd

# File paths
normal_pcap_path = "normal_traffic.pcap"
attack_pcap_path = "malicious_dns_query_flood_attaq_traffic.pcap"

# Function to parse PCAP and extract DNS traffic


def parse_pcap(file_path, label):
    packets = rdpcap(file_path)
    data = []

    for packet in packets:
        # Check if the packet has a DNS Query layer
        if packet.haslayer(DNSQR):
            data.append({
                "timestamp": packet.time,
                "src_ip": packet[1].src if packet.haslayer("IP") else None,
                "dst_ip": packet[1].dst if packet.haslayer("IP") else None,
                "query_name": packet[DNSQR].qname.decode('utf-8') if packet[DNSQR].qname else None,
                "query_type": packet[DNSQR].qtype,
                "label": label
            })

    return pd.DataFrame(data)


# Parse normal and attack PCAP files
# Normal traffic labeled as 0
normal_traffic = parse_pcap(normal_pcap_path, label=0)
# Attack traffic labeled as 1
attack_traffic = parse_pcap(attack_pcap_path, label=1)

# Combine datasets
combined_dataset = pd.concat(
    [normal_traffic, attack_traffic], ignore_index=True)

# Save to CSV
output_csv_path = "dns_query_flood_dataset.csv"
combined_dataset.to_csv(output_csv_path, index=False)

print(f"Dataset saved to {output_csv_path}")
