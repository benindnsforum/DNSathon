# Resolver-1:
## Objectif

Mis en place d'un **resolver** avec **bind9**

S'assurer que le DNSSEC est active et fontionne correctement apres que le server *racine* l'active

## Outils
- [bind9]()
- [dig]()

## Installation et Configurations

### Resolver (bind9)
- Installation de "bind9"

  ```bash
  sudo apt update
  sudo apt install bind9 bind9utils bind9-doc
  ```

- Sauvegarder les fichier de configurations avant de les mettre a jour

  ```bash
  sudo cp /etc/dhcp/dhclient.conf /etc/dhcp/dhclient.conf_bkp
  sudo cp /etc/bind/named.conf.default-zones /etc/bind/named.conf.default-zones_bkp
  sudo cp /usr/share/dns/root.hints /usr/share/dns/root.hints_bkp
  ```

- Telechager le fichier **root.hints** depuis le server racine

- Remplacer le **/usr/share/dns/root.hints** avec le **root.hints** telecharger ci-dessous

  ```bash
  sudo cp /home/pi/root.hints /usr/share/dns/root.hints
  ```

- Mettre a jour le **/etc/resolv.conf** pour specifer le *nameserver* que le server doit utilisé:

  ```basic
  nameserver 10.10.40.5
  ```

- Ajouter les configuration de securité dans le **/etc/bind/named.conf.options** por pemtre:

  ```basic
  listen-on-v6 {any;};
  listen-on {any;};
  allow-query {10.10.40.0/24; 10.10.10.0/24; 10.10.20.0/24;};
  allow-recursion {10.10.10.0/24; 10.10.20.0/24; 10.10.30.0/24; 10.10.40.0/24; 10.10.60.0/24; };
  ```

### DNSSEC

- Ajouter les lignes ci-dessous dans le fichier **/etc/bind/named.conf.options** pour activer le **DNSSEC** sur le resolver. 
  S'assurez vous que le server **racine** a activer le **DNSSEC**.

  ```basic
  dnssec-validation yes;
  ```

- Recuperer la clés DNS depuis le root avec la commande (la clé **257 3 8**)

  ```bash
  dig DNSKEY @10.10.10.5 .
  ```

- Ajouter le record **trusted-keys** dans **named.conf**

  ```basic
  trusted-keys {
      . 257 3 8 "DNSKEY";
  };
  ```

- Redemarrer le service **bind9**

  ```bash
  sudo service bind9 restart
  sudo service bind9 status
  ```

## Tests

​	Verifier que le *resolver* arrive a resoudre des requetes ver le server *racine*

```bash
dig A ns1.root
dig ns .
```

​	Verifier que le *resolver* arrive a resoudre des requetes ver le server *registre*

```bash
# "10.10.40.5" est l'adresse du resolver
dig cotonou. @10.10.40.5
dig benin. @10.10.40.5
```

Verifier du DNSSEC: Confirmer que le flag **ad** est present dans la reponse de la requete ci-dessous

```bash
# "10.10.40.5" est l'adresse du resolver
dig SOA . @10.10.40.5 +dnssec
```

## Conclusion

Merci a tous.

