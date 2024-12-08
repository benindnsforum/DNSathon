# Resolver-2:
## Objectif

Mise en place du **Resolver** DNS avec implémentation du **DoH**

## Outils
- [Unbound](https://nlnetlabs.nl/projects/unbound/about/)
- [dig](https://packages.debian.org/buster/dnsutils)

## Installation et Configurations

### Resolver (Unbound)
- Installer "Unbound"

  ```bash
  sudo apt update
  apt install unbound dnsutils 
  systemctl enable unbound
  ```

- Editer le fichier **/etc/unbound/unbound.conf**

  ```bash
        server:
       interface: 10.10.40.10
       interface: ::0
       access-control: 0.0.0.0/0 allow
       access-control: ::/0 allow
       root-hints: "/var/lib/unbound/root.hints"
       verbosity: 0
       qname-minimisation: yes

      #Puissance de l'utilisation du proceseur
       num-threads: 2
       msg-cache-slabs: 4
       rrset-cache-slabs: 4
       infra-cache-slabs: 4
       key-cache-slabs: 4

      #augmentation memoire cache  
       rrset-cache-size: 100m
       msg-cache-size: 50m

      #plage sortante 
       outgoing-range: 465
       so-rcvbuf: 4m
       so-sndbuf: 4m
       port: 53
       do-ip4: yes
       do-ip6: yes
       do-udp: yes
       do-tcp: yes
 ```

 - Telechager le fichier **root.hints** depuis le server racine

 - Remplacer le **/var/lib/unbound/root.hints** avec le **root.hints** telecharger ci-dessous


 - Mettre a jour le **/etc/resolv.conf** pour specifer le *nameserver* que le server doit utilisé:

  ```basic
    nameserver 10.10.40.10
  ```

### DoH

- Ajouter les lignes ci-dessous dans le fichier **/etc/unbound/unbound.conf** pour activer le **DoH** sur le resolver. 
  
  ```basic
        # tls-service-key: "unbound_server.key"
       tls-service-pem: "unbound_control.pem"
       tls-port: 443
  ```


- Redemarrer le service **DoH**

  ```bash
      sudo service unbound restart
      sudo service unbound status
  ```

## Tests

​	Verifier que le *resolver* arrive a resoudre des requetes ver le server *racine*

```bash
dig A ns1.root
dig ns .
```

​	Verifier que le *resolver* arrive a resoudre des requetes ver le server *registre*

```bash
# "10.10.40.10" est l'adresse du resolver
dig cotonou. @10.10.40.10
dig benin. @10.10.40.10
```



## References
- [Avoir son propre resolver](https://www.bortzmeyer.org/son-propre-resolveur-dns.html)
- [unbound](https://tools.ietf.org/id/draft-livingood-doh-implementation-risks-issues-03.html)
- [Installation de Unbound](https://jesuisadmin.fr/installer-resolveur-dns-unbound  )
- [DoH](https://blog.apnic.net/2020/12/14/dns-over-https-in-unbound/)

## Conclusion

Merci pour la lecture
