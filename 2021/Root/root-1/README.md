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
$TTL 600
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

### 4 - Configuration de la Zone Reverse
Ajouter dans le fichier `/etc/bind/named.config.local` la zone root:

```
zone "10.10.10.in-addr.arpa" {
	type master;
	file "/etc/bind/db.10.10.10";
};
```

Creer dans le fichier `db.10.10.10` dans `/etc/bind`:
`sudo touch /etc/bind/db.10.10.10`.

Editer le fichier `/etc/bind/db.10.10.10` en ajoutant les configs suivante:

```
;
; BIND reverse data file for local loopback interface
;
$TTL    600
@       IN      SOA     ns1.root. contact.root. (
                              2         ; Serial
                         604800         ; Refresh
                          86400         ; Retry
                        2419200         ; Expire
                         604800 )       ; Negative Cache TTL
;
@       IN      NS      ns1.root.
@       IN      NS      ns2.root.
5       IN      PTR     ns1.root.
10      IN      PTR     ns2.root.
```

### 5 - Configurer la synchronisation avec le serveur root 2 ###
Génerer la clé en tapant la commande: <br>
`dnssec-keygen -a HMAC-MD5 -b 128 -n HOST .`

Après l'éxécution de la commande ci-dessus, on a eu les fichiers: <br>
`K.+157+11684.key` et `K.+157+11684.private`

Faire un cat sur `K.+157+11684.key` pour récupérer la clef.

Ajouter ensuite dans le fichier `named.conf.local` la config suivante:

```
key "." {
	algorithm hmac-md5;
	secret "CLE";
};
```

Modifer ensuite les zone **.** et **10.10.10.in-addr.arpa** de la manière suivante:

```
zone "." {
    type master;
    file "/etc/bind/db.root";
	allow-transfer { key "."; 10.10.10.10;};
	allow-update { key "." ; };
};
```

```
zone "10.10.10.in-addr.arpa" {
	type master;
	file "/etc/bind/db.10.10.10";
    allow-transfer { 10.10.10.10;};
};
```

**NB: l'IP 10.10.10.10 est l'adresse IPv4 du serveur root 2**

### 6 - Configurations des options et activation de dnssec ###

Creer le fichier `/etc/bind/named.conf.options` et ajouter les configuations suivantes:


```
options {
	directory "/var/cache/bind";
	dnssec-validation auto;
	dnssec-enable yes;

	listen-on-v6 { any; };
	forwarders {
		10.10.10.1;
	};
	forward only;
	listen-on {127.0.0.1; 10.10.10.5; };
	auth-nxdomain no ;
	version none;
	recursion no;
};

```

### 7 - Tester les configurations ###

Pour tester les configurations et vérifier si tout vas bien exécuter les commandes suivantes:
`named-checkedzone` <br>
`named-checkedconf`

### 8 - Redémarrer bind ###

`sudo systemctl restart bind9`

### 9 - Configurer les résolveurs ###

Modifier le fichier `/etc/resolv.conf`

```
nameserver 10.10.40.5
nameserver 10.10.40.10
```
et exécuter la commande `sudo systemctl restart bind9`.

### 10- Configurer le TLD ###

Modifier le fichier zone du seveur root pour déclarer les TLD .cotonou et .benin

```
$TTL	600
.	IN	SOA	ns1.root. contact.root. (
		     2021102204		; Serial
			 604800		; Refresh
			  86400		; Retry
			2419200		; Expire
			 604800 )	; Negative Cache TTL
;
.				IN	NS	ns1.root.
.				IN	NS	ns2.root.
.				IN	A	10.10.10.5
ns1.root			IN	A	10.10.10.5
ns2.root			IN	A	10.10.10.10
benin.				IN	NS	ns.benin.
ns.benin.			IN	A	10.10.20.10
cotonou.            IN NS   ns1.pdns.cotonou.
ns1.pdns.cotonou.   IN A    10.10.20.5 
```


**NB: A chaque modification d'un fichier de zone il faut incrémenter le Serial dans le SOA.**