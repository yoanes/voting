# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

  # Every Vagrant virtual environment requires a box to build off of.
  config.vm.box = "mjp182/CentOS_7"

  config.vm.network "forwarded_port", guest: 8765, host: 8765
  config.vm.network "forwarded_port", guest: 3306, host: 3306

  config.vm.synced_folder "./voting-system", "/opt/work"
  config.vm.provision "shell", path: "provision.sh"
end
