#!/bin/sh
set -e

# first arg is `-f` or `--some-option`
if [ "${1#-}" != "$1" ]; then
	set -- apache2-foreground "$@"
fi

echo "--> Running setup: composer, languages, chmods"

cd /var/www
composer install
chown -R www-data:www-data ./
service apache2 start
while true; do sleep 1000; done


