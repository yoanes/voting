# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

  config.vm.define "voting-provision" do |prov|
     # Every Vagrant virtual environment requires a box to build off of.
     prov.vm.box = "mjp182/CentOS_7"
     prov.vm.synced_folder "./voting-system", "/opt/work"
     prov.vm.provision "shell", path: "provision.sh"

     prov.vm.provider "virtualbox"

     prov.vm.provider "virtualbox" do |v|
       v.name = 'replique-vote-base'
     end
   end
 
   config.vm.define "voting", primary: true do |vote|
      vote.vm.box = "replique/vote"
      vote.vm.box_url = "file:///Users/yoanesk/Development/workspace/replique/voting/voting.box"

      vote.vm.synced_folder "./voting-system/voting/webroot", "/home/replique/public_html/voting/webroot"
      vote.vm.synced_folder "./voting-system/voting/www", "/home/replique/public_html/voting"
      vote.vm.synced_folder "./voting-system/voting/bin", "/home/replique/opt/voting/bin"
      vote.vm.synced_folder "./voting-system/voting/config", "/home/replique/opt/voting/config"
      vote.vm.synced_folder "./voting-system/voting/tmp", "/home/replique/tmp", owner: "vagrant", group: "vagrant", mount_options: ["dmode=777,fmode=777"]
      vote.vm.synced_folder "./voting-system/voting/logs", "/home/replique/logs/voting/", owner: "vagrant", group: "vagrant", mount_options: ["dmode=777,fmode=777"]
      vote.vm.synced_folder "./voting-system/voting/src", "/home/replique/opt/voting/src"
      vote.vm.synced_folder "./voting-system/voting/vendor", "/home/replique/opt/voting/vendor"

      vote.vm.provider "virtualbox"

      vote.vm.provision "shell", inline: "rm -Rf /var/www/html && ln -s /home/replique/public_html/voting /var/www/html"

      vote.vm.network "forwarded_port", guest: 80, host:8080
      vote.vm.network "forwarded_port", guest: 8765, host: 8765
      vote.vm.network "forwarded_port", guest: 3306, host: 3306
   end
end
