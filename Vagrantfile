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
      vote.vm.synced_folder "./voting-system", "/opt/work"
      vote.vm.provider "virtualbox"

      vote.vm.network "forwarded_port", guest: 8765, host: 8765
      vote.vm.network "forwarded_port", guest: 3306, host: 3306
   end
end
