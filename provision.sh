#!/bin/bash

echo "Install basic environment tools"
yum install -y mysql apache php php-mbstring php-pdo php-intl wget ftp tar bind-utils telnet git

echo "Install php mcrypt extension"
wget http://dl.fedoraproject.org/pub/epel/7/x86_64/e/epel-release-7-5.noarch.rpm -O /tmp/epel-release-7-5.noarch.rpm
rpm -ivh /tmp/epel-release-7-5.noarch.rpm
yum install --enablerepo="epel" php-mcrypt

echo "Do update"
yum update -y

mkdir -p /opt/work/bin
cd /opt/work

echo "Install composer to /opt/work/bin"
curl -sS https://getcomposer.org/installer | php -- --install-dir=bin

echo "Add composer to PATH"
ln -s /opt/work/bin/composer.phar /usr/local/sbin/composer
