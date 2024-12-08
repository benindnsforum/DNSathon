# Serveur racine 2

## Outils

`Knot DNS`<br>

## Configurations

### 1 - Installation de NSD

`sudo apt-get install knot`

### 2 - Configuration préalable

Modifier le fichier /etc/resolv.conf et ajouter l'adresse IP du serveur primaire :

```
nameserver <ADRESSE_IP_SERVEUR_PRIMAIRE>

````

### 3 - Configuration de nsd comme slave du serveur primaire

#### 3-1 Ajout de la clé pour le TSIG

Recupérer le 'secret' sur le serveur primaire et ajouter comme suit dans le fichier /etc/knot/knot.conf:

```
key:
  - id: .
    algorithm: hmac-sha256
    secret: CLE
```

#### 3-2 Ajout de la zone root

Ajouter dans le fichier `/etc/knot/knot.conf` la zone root:

```
remote:
  - id: master
    address: 192.168.74.10@53
    key: .

acl:
  - id: notify_from_master
    address: 192.168.74.10
    key: .
    action: notify

zone:
  - domain: .
    storage: /var/lib/knot/zones/
    file: root.zone
    master: master
    acl: notify_from_master
```<br>


Vous obtenez donc pour le fichier :

``# This is a sample of a minimal configuration file for Knot DNS.
# See knot.conf(5) or refer to the server documentation.

server:
    rundir: "/run/knot"
    user: knot:knot
    listen: [ 0.0.0.0@53, ::@53]

log:
  - target: syslog
    any: info

database:
    storage: "/var/lib/knot"

key:
  - id: .
    algorithm: hmac-sha256
    secret: CLE

remote:
  - id: master
    address: 192.168.74.10@53
    key: .

acl:
  - id: notify_from_master
    address: 192.168.74.10
    key: .
    action: notify

zone:
  - domain: .
    storage: /var/lib/knot/zones/
    file: root.zone
    master: master
    acl: notify_from_master
```

### 4 - Démarrer NSD ###

`sudo systemctl restart knot`

### 5 - Récupérer le fichier root depuis le server primaire

`sudo knotc zone-refresh .`