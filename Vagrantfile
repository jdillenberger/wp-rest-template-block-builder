VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = "ubuntu/bionic64"
  config.vm.network "private_network", ip: "192.168.13.37"
  config.vm.provision :shell, :path => "install-vagrant.sh"

  config.vm.synced_folder ".",
                          "/var/www/html/wordpress/wp-content/plugins/wp-rest-template-block-builder",
                          owner: "www-data", group: "www-data"

  config.vm.provider "virtualbox" do |v|
    v.memory = 2048
  end

  unless Vagrant.has_plugin?("vagrant-vbguest")
    puts "Installing vagrant-vbguest plugin"
    system "vagrant plugin install vagrant-vbguest"
  end

end
