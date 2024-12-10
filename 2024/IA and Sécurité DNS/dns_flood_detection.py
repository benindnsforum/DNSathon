import joblib
import matplotlib.pyplot as plt
from sklearn.metrics import classification_report, accuracy_score
from sklearn.ensemble import RandomForestClassifier
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import LabelEncoder
import struct
import socket
import pandas as pd

# Charger le fichier CSV contenant le dataset DNS
file_path = "dns_query_flood_dataset.csv"
df = pd.read_csv(file_path)

# Inspection initiale des données
# Affiche les premières lignes pour comprendre la structure des données
print(df.head())
print(df.info())  # Donne des informations sur les colonnes et les types de données

# Conversion des adresses IP en valeurs entières


def ip_to_int(ip):
    try:
        return struct.unpack("!I", socket.inet_aton(ip))[0]
    except socket.error:
        return None  # Gérer les erreurs en renvoyant une valeur nulle


df["src_ip_int"] = df["src_ip"].apply(ip_to_int)
df["dst_ip_int"] = df["dst_ip"].apply(ip_to_int)

# Suppression des colonnes d'adresses IP originales si elles ne sont plus nécessaires
df.drop(["src_ip", "dst_ip"], axis=1, inplace=True)

# Encodage des noms de requêtes DNS

le = LabelEncoder()
df["query_name"] = le.fit_transform(df["query_name"])

# Gestion des valeurs manquantes
df.fillna(0, inplace=True)  # Remplace les valeurs nulles par 0

# Séparation des données en ensembles d'entraînement et de test

X = df.drop("label", axis=1)  # Caractéristiques
y = df["label"]  # Cible (binaire ou multi-classes)

X_train, X_test, y_train, y_test = train_test_split(
    X, y, test_size=0.2, random_state=42)

# Entraînement du modèle Random Forest

model = RandomForestClassifier(random_state=42)
model.fit(X_train, y_train)

# Prédictions
y_pred = model.predict(X_test)

# Évaluation du modèle
print("Rapport de classification :\n", classification_report(y_test, y_pred))
print("Précision globale :", accuracy_score(y_test, y_pred))

# Visualisation de l'importance des caractéristiques

feature_importances = model.feature_importances_
features = X.columns

plt.figure(figsize=(10, 6))
plt.barh(features, feature_importances, color="skyblue")
plt.xlabel("Importance des caractéristiques")
plt.title("Importance des caractéristiques dans le modèle Random Forest")
plt.show()

# Exporter le modèle entraîné

model_filename = "dns_flood_detection_model.pkl"
joblib.dump(model, model_filename)
print(f"Modèle exporté et enregistré sous {model_filename}")
