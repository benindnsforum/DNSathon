# Registrar
## Objectif
Mettre en place un service d’enregistrement des noms de domaines pour les TLD .cotonou et .benin grâce à une interface web d’enregistrement et/ou une API.
Le groupe mettra également en place les serveurs NS qui feront autorité sur les domaines enregistrés et mettra en place un service à valeur ajoutée d’hébergement mutualisé.


## Outils
* bind9
* bind9utils
* apache2
* mariadb-server-10
* php7


## Configurations

### 1 - Fixer l'adresse IP du serveur
Nous allons fixer l'adresse IP en effectuant les configuarations suivantes :
```bash
nano /etc/network/interfaces
```
Ajouter dans le fichier les lignes suivntes dans le fichier :
```conf
auto eth0
iface eth0 inet static
    address 10.10.30.5
    netmask 255.255.0.0
    gateway 10.10.30.1
```

### 2 - Installation des outils
```bash
apt update && apt full-upgrade
apt install bind9 bind9utils mariadb-server-10 apache2 php7
systemctl enable --now bind9 mysql apache2
```
La derniere commande lance les outils installes a chaque redemarrage


### 3 - Configuration prealable
Modifier le fichier `/etc/resolv.conf` et ajouter l'adresse de notre machine
```
nameserver 10.10.30.5
```

### 4 - Configurations des Nameservers
Dans cette section nous aurons a configurer les `ns1` et `ns2` de notre domaine `dnshosting.benin`
Modifier le fichier `/etc/bind/named.conf.local`
```
nano /etc/bind/named.conf.local
```
Ajouter les lignes suivantes :
```
zone "dnshosting.benin" {
    type master;
    file "/etc/bind/hosting.benin";
};

zone "30.10.10.in-addr.arpa" {
    type master;
    file "/etc/bind/hosting.rev";
};
```
Creation des fichiers `/etc/bind/hosting.benin` et `/etc/bind/hosting.rev`
```bash
touch /etc/bind/hosting.benin
touch /etc/bind/hosting.rev
```
* Editer le fichier `/etc/bind/hosting.benin` et ajouter les configurations suivantes :
```
;
; BIND data file for local loopback interface
;
$TTL	604800
@	IN	SOA	dnshosting.benin. root.dnshosting.benin. (
			      2		; Serial
			 604800		; Refresh
			  86400		; Retry
			2419200		; Expire
			 604800 )	; Negative Cache TTL
;
@	IN	NS	ns1.dnshosting.benin.
ns1.  IN  A 10.10.30.5
@	IN	NS	ns2.dnshosting.benin.
ns2.  IN  A 10.10.30.5
```
* Editer le fichier `/etc/bind/hosting.rev` et ajouter les configurations suivantes :
```
;
; BIND data file for local loopback interface
;
$TTL	604800
@	IN	SOA	dnshosting.benin. root.dnshosting.benin. (
			      2		; Serial
			 604800		; Refresh
			  86400		; Retry
			2419200		; Expire
			 604800 )	; Negative Cache TTL
;
@	IN	NS	ns1.dnshosting.benin.
5 IN  PTR ns1.dnshosting.benin.
@	IN	NS	ns2.dnshosting.benin.
5 IN  PTR ns2.dnshosting.benin.
```
Apres ces configurations editer le fichier `/etc/bind/named.conf.options` comme suit :
```
options {
	directory "/var/cache/bind";
  	dnssec-validation auto;
	allow-recursion { any; }

	auth-nxdomain no;    # conform to RFC1035
	listen-on { any; };
  	listen-on-v6 { any; };
};
```
Redemarrer les services `bind`
```bash
systemctl restart bind9
```
Effectuez la commande suivante :
```bash
dig NS dnshosting.benin
```
Apres cette commande si tout a ete bien configurer les `ns1.dnshosting.benin` et `ns2.dnshosting.benin` doivent etre lister avec leur adresse IP

## 5 - Configuration du serveur Web
L'application Web se trouve [ici](template/dnshosting.benin/).
L'appliction Web a ete realiser avec les technologies suivantes :
* HTML
* CSS
* PHP
* JS

Copier le dossier dans le repertoire `/var/www/html/`

## 6 - Configuration du serveur Mysql
Connexion au serveur Mysql
```bash
mysql -uroot -p
```
Creation de la base de donne, taper la commande suivante
```sql
CREATE DATABASE dns;
```
Importer le fichier(dump) de la base de donnnes
Le fichier se trouve [ici](template/dns.sql)
```bash
mysql -uroot -p dns < dns.sql
```
Redemarrer les services `mysql` et `apache2`
```bash
systemctl restart mysql apache2
```
### Toutes les configurations sont Ok!! l'application Web est disponible !!

## References
* [https://github.com/th3f0r3ign3r/DNSSEC](https://github.com/th3f0r3ign3r/DNSSEC)


## Realisation
* [Ronel KPOSSOU](https://github.com/th3f0r3ign3r)
* [Tino Anago](https://github.com/tinosmargue)
* [Ulrich SEGLA](https://github.com/alges22)
* Esai
