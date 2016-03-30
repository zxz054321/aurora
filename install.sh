#!/bin/bash

# Created by Abel<zxz054321@163.com> on 2016/2/3.

echo "Aurora Installer"
echo "by Abel <zxz054321@163.com>"

sudo chown -R www.www *
sudo chmod -R 666 storage

if [ ! -f "/usr/local/bin/composer" ]; then
    echo "Downloading Composer..."
    curl -sS https://getcomposer.org/installer | php
    sudo mv composer.phar /usr/local/bin/composer
    echo "composer installed."
fi

if [ ! -f "_" ]; then
    echo "Would you like to setup ENV now?"
    echo "Please enter the ENV filename."
    echo "ENV list:"
    ls _*.php
	echo ""
    echo "Your choose:"
    read input
    echo ""
    if [ -f "$input" ];then
        sudo mv $input _
        cat _
        echo ""
        echo ""
        echo "Done."
        echo ""
    fi
fi

if [ ! -d "vendor" ]; then
    composer install --no-dev
    composer dump-autoload --optimize
fi