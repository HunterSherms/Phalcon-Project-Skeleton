# Phalcon Project Skeleton

A project skeleton for quickstarting a <a href="https://docs.phalconphp.com/">Phalcon</a> php project.

Setting up your server:
```shell
sudo su
apt-get update

#apache
apt-get install apache2
service apache2 restart

echo "ServerName localhost" | tee /etc/apache2/conf-available/fqdn.conf && a2enconf fqdn
service apache2 restart

#php
apt-get install libapache2-mod-php5
service apache2 restart

#mysql
apt-get install mysql-server libapache2-mod-auth-mysql php5-mysql

#phpmyadmin
apt-get install phpmyadmin

php5enmod mcrypt #enable mcrypt module
a2enmod rewrite  #enable apache rewrite for .htaccess
service apache2 restart

#phalcon
apt-add-repository ppa:phalcon/stable
apt-get update
apt-get install php5-phalcon
```

Open /etc/apache2/apache2.conf and include the following:
```
#include phpmyadmin
Include /etc/phpmyadmin/apache.conf
```
Open /etc/apache2/sites-available/000-default.conf and include the following:
```
<Directory /var/www/project1>
    AllowOverride ALL
</Directory>
```
Finally, restart apache.
