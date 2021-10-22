# Serveur racine 2

## Outils

`NSD`<br>

## Configurations

### 1 - Installation de NSD

`sudo apt-get install nsd`

### 2 - Configuration préalable

Modifier le fichier /etc/resolv.conf et ajouter l'adresse IP du serveur primaire :

```
nameserver <ADRESSE_IP_SERVEUR_PRIMAIRE>

````

### 3 - Configuration de nsd comme slave du serveur primaire

#### 3-1 Ajout de la clé pour le TSIG

Recupérer le 'secret' sur le serveur primaire et ajouter comme suit:

```
key:
    name: "tsig_key"
    algorithm: hmac-md5
    secret: "prYG2niVE3HJ8VGBPe2VDw=="
```

#### 3-2 Ajout de la zone root

Ajouter dans le fichier `/etc/nsd/nsd.conf` la zone root:

```
zone:
    name: "."
    zonefile: "secondary/.signed"
    # the master is allowed to notify and will provide zone data.
    allow-notify: <ADRESSE_IP_SERVEUR_PRIMAIRE> NOKEY
    request-xfr: <ADRESSE_IP_SERVEUR_PRIMAIRE> ns1.root.
```<br>


Vous obtenez donc pour le fichier :

```# NSD configuration file for Debian.
#
# See the nsd.conf(5) man page.
#
# See /usr/share/doc/nsd/examples/nsd.conf for a commented
# reference config file.
#
# The following line includes additional configuration files from the
# /etc/nsd/nsd.conf.d directory.

key:
    name: "tsig_key"
    algorithm: hmac-md5
    secret: "prYG2niVE3HJ8VGBPe2VDw=="

zone:
    name: "."
    zonefile: "zone/root.zone"
    # the master is allowed to notify and will provide zone data.
    allow-notify: 10.10.10.5 tsig_key
    request-xfr: AXFR 10.10.10.5 tsig_ke
```

### 4 - Tester la configuration ###

Pour tester les configurations et vérifier si tout vas bien exécuter la commande suivant:
`nsd-checkconf /etc/nsd/nsd.conf`

### 5 - Démarrer NSD ###

`sudo systemctl restart NSD`
