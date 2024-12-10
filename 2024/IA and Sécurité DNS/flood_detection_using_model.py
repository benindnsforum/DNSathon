from scapy.all import sniff, DNS, DNSQR
import joblib
import socket
import struct
import pandas as pd

# Load the trained model
model = joblib.load('dns_flood_detection_model.pkl')

# Function to convert IP address to integer (for modeling purposes)


def ip_to_int(ip):
    return struct.unpack("!I", socket.inet_aton(ip))[0]

# Function to extract features from DNS packets


def extract_features(pkt):
    if pkt.haslayer(DNS) and pkt.haslayer(DNSQR):
        # Extract DNS-related features
        src_ip = ip_to_int(pkt[IP].src)  # Source IP address
        query_name = pkt[DNSQR].qname.decode()  # DNS query name

        # Create a feature set (you can add more features here)
        features = {
            "src_ip": src_ip,
            "query_name": query_name,
            "query_type": pkt[DNSQR].qtype
        }

        return pd.DataFrame([features])
    return None

# Function to classify the packet


def classify_packet(pkt):
    features_df = extract_features(pkt)
    if features_df is not None:
        # Convert the features into the correct format (same as during training)
        # Exclude label column if present
        features = features_df.drop("label", axis=1, errors='ignore')
        prediction = model.predict(features)

        if prediction == 1:
            print("Potential DNS Flood Attack Detected!")
        else:
            print("Normal DNS Query.")


# Start packet sniffing on a specific interface
sniff(filter="udp port 53", prn=classify_packet, store=0)
