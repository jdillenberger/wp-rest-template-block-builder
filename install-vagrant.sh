#!/usr/bin/env bash
echo 'Installing the wp-rest-template-blocks testserver'

echo "Server: Defining variables for User"
USER='admin'
PASS='1234'

# turn off prompts during installations
echo "Server: Setting noninteractive install"
export DEBIAN_FRONTEND="noninteractive"

# update repo list
echo "Server: Updating the repo list"
sudo apt-get update

# update installed packages
echo "Server: Updating installed packages"
sudo apt-get upgrade -y

# enable the default user to work in www-folder
echo "Server: Changing permissions of the default user 'ubuntu'"
sudo usermod -a -G www-data ubuntu

# enable npm scripts to be installed in www-folder
echo "Server: Changing html folter permissions for npm"
sudo chmod 777 /var/www/html

# prepare MySQL and phpmyadmin install configuration
## MySQL and phpma need to be configured before installation
## otherwise, their interactive configurators will break provisioning
echo "Server: Configuring MySQL and phpmyadmin"
sudo debconf-set-selections <<< "mysql-server mysql-server/root_password password $PASS"
sudo debconf-set-selections <<< "mysql-server mysql-server/root_password_again password $PASS"
debconf-set-selections <<< "phpmyadmin phpmyadmin/dbconfig-install boolean true"
debconf-set-selections <<< "phpmyadmin phpmyadmin/app-password-confirm password $PASS"
debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/admin-pass password $PASS"
debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/app-pass password $PASS"
debconf-set-selections <<< "phpmyadmin phpmyadmin/reconfigure-webserver multiselect apache2"

# install needed packages
echo "Server: Installing packages via apt-get"
sudo apt-get install -y 	apache2 \
	mysql-server \
	php7.2 \
	libapache2-mod-php7.2 \
	php7.2-mysql \
	php7.2-mbstring \
	php7.2-cgi \
	php7.2-dev \
	php7.2-cli \
	curl \
	build-essential \
	phpmyadmin \
	fish

sudo apt-get install -y	composer \
	node-gyp \
	npm

# create new database user
mysql -u root -p$PASS -e "GRANT ALL PRIVILEGES ON *.* TO '$USER'@'localhost' IDENTIFIED BY '$PASS';" 2> /dev/null

# configure apache mods
echo "Server: Configuring Apache"
sudo a2enmod rewrite
sudo phpenmod mbstring
sudo systemctl restart apache2

# install WP-CLI
echo "Server: Installing WP-CLI"
curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
chmod +x wp-cli.phar
sudo mv wp-cli.phar /usr/local/bin/wp

# install WP
echo "Server: Installing WordPress"
mkdir -p /var/www/html/wordpress
cd /var/www/html/wordpress
wp core download --allow-root
wp core config --dbuser=$USER --dbpass=$PASS --dbname=wp --allow-root
wp db create --allow-root
wp core install --url=192.168.13.37/wordpress --title=wp-rest-blocks-dev --admin_user=$USER --admin_password=$PASS --admin_email=example@exampe.com --allow-root

# make WordPress folder available to webserver
echo "Server: Changing permissions of wordpress folder to www-data"
sudo chown www-data:www-data /var/www/html/wordpress/ -R

echo "Done."
echo "Reminder: Do not make this environment available via internet!"
echo "You will be baked and there will be cake."

printf "User: $USER \nPASSWORD: $PASS\n"
open "http://192.168.13.37/wordpress/"