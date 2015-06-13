#!/bin/bash

echo "Install basic environment tools"
yum install -y httpd php php-mbstring php-pdo php-intl php-mysqli wget ftp tar bind-utils telnet git

echo "Install php mcrypt extension"
wget http://dl.fedoraproject.org/pub/epel/7/x86_64/e/epel-release-7-5.noarch.rpm -O /tmp/epel-release-7-5.noarch.rpm
rpm -ivh /tmp/epel-release-7-5.noarch.rpm
yum install --enablerepo="epel" php-mcrypt

echo "Install MySQL community edition"
rpm -Uvh http://dev.mysql.com/get/mysql-community-release-el7-5.noarch.rpm
sudo yum install -y mysql-community-server

echo "Enable mysql daemon"
systemctl enable mysqld

echo "Start mysql server"
systemctl start mysqld

echo "Secure mysql installation"
mysql -e "UPDATE mysql.user SET Password = PASSWORD('password') WHERE User = 'root'"
mysql -e "DROP USER ''@'localhost'"
mysql -e "DROP USER ''@'$(hostname)'"
mysql -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' identified by 'password' WITH GRANT OPTION"
mysql -e "FLUSH PRIVILEGES"

#echo "Do update"
#yum update -y
#
#echo "Update kernel and rebuild vbox add"
#yum install kernel-devel-$(uname -r) kernel-headers-$(uname -r) dkms -y
#/etc/init.d/vboxadd setup

echo "Shutdown firewall"
systemctl stop firewalld

mkdir -p /opt/work/bin
cd /opt/work

echo "Install composer to /opt/work/bin"
curl -sS https://getcomposer.org/installer | php -- --install-dir=bin

echo "Add composer to PATH"
ln -s /opt/work/bin/composer.phar /usr/local/sbin/composer

if [ -f /opt/work/voting/src/Database/pentasbakat.sql ]; then
   mysql -u root -ppassword < /opt/work/voting/src/Database/pentasbakat.sql
fi

if [ -f /opt/work/voting/src/Database/voting.sql ]; then
   mysql -u root -ppassword < /opt/work/voting/src/Database/voting.sql
fi
