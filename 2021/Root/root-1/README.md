# Serveur racine 1

## Outils ##

`bind9, bind9utils, libbind9-161`<br>
`NB: Faire un sudo apt-cache search libbind9 pour avoir la dernière version de libbind9`

## Configurations ##

### 1 -Installation de bind9 ###

`sudo apt-get install bind9, bind9utils, libbind9-161`

### 2 - Configuration de la zone root ###

Ajouter dans le fichier `/etc/bind/named.config.local` la zone root:

```
zone "." {
    type master;
    file "/etc/bind/db.root"
}
```

Creer dans le fichier `db.root` dans `/etc/bind`:
`sudo touch /etc/bind/db.root`.

Editer le fichier `/etc/bind/db.root` en ajoutant les configs suivante:

```
;
; BIND data file for local loopback interface
;
$TTL 604800
. IN SOA ns1.root. admin.root. (
       2021102201  ; Serial
    604800  ; Refresh
     86400  ; Retry
   2419200  ; Expire
    604800 ) ; Negative Cache TTL
;
.    IN NS ns1.root.
.    IN NS ns2.root.
.    IN A 10.10.10.5 ; Adresse IP du serveur
.    IN A 10.10.10.10 ; Adresse IP du serveur root 2
ns1.root    IN A 10.10.10.5
ns2.root    IN A 10.10.10.10
```
Faire une sauvegarde du fichier `/etc/bind/named.conf.default-zones` et en modifier l'existant.

Changer la section

```
zone "." {
    type hint;
    file "/usr/share/dns/root.hints"
} 
```

contenu dans `/etc/bind/named.conf.default-zones` en

```
zone "." {
    type hint;
    file "/etc/bind/root.hints"
} 
```

Creer le fichier `/etc/bind/root.hints` et ajouter le contenu suivant:

```
.                    360      NS    ns1.root.
.                    360      NS    ns2.root.
ns1.root.       360      A     10.10.10.5
ns2.root.       360      A     10.10.10.10 ;Adresse IP du serveur root 2
```

### 4 - Tester la configuration ###

Pour tester les configurations et vérifier si tout vas bien exécuter la commande suivant:
`named-checkedzone` **.** `db.root`

```
NB: Ici le . représente le nom de zone et db.root le fichier de configuation de la zone
```

### 6 - Démarrer bind ###

`sudo systemctl restart bind9`

### 5 - Forcer l'utilisation du résolveur DNS local ###

Modififier le fichier `/etc/resolv.conf` et utiliser `127.0.0.1` pour nameserver:

`nameserver       127.0.0.1`
