#!/bin/bash
source ./.env

if [ ! -f "www/bitrix/index.php" ]; then
	if [ ! -f "core.zip" ]; then
		wget http://$ip_rep/upload/distro/core.zip --user=bitrix --ask-password -O core.zip;
	fi;

	if [ -f "core.zip" ]; then
		if [ ! -d "www/bitrix" ]; then
			mkdir www/bitrix;
		fi;

		unzip -nqq core.zip -d www/bitrix && rm core.zip;
	fi;
fi;

docker-compose up -d --build;

echo "waiting mysql server. 5 seconds...";

sleep 5;

TABLES=$(docker exec -i bsymfony_percona mysql -u$MYSQL_USER -p$MYSQL_PASSWORD $MYSQL_DATABASE <<< "show tables;");

if [ -z "$TABLES" ]; then
	if [ ! -f "dump.zip" ]; then
		wget http://$ip_rep/upload/distro/dump.zip --user=bitrix --ask-password -O dump.zip;
	fi;

	if [ -f "dump.zip" ]; then
		unzip -nqq dump.zip && rm dump.zip;
	fi;

	if [ -f "dump.sql" ]; then
		docker exec -i bsymfony_percona mysql -u$MYSQL_USER -p$MYSQL_PASSWORD $MYSQL_DATABASE < dump.sql;
		docker exec -i bsymfony_percona mysql -u$MYSQL_USER -p$MYSQL_PASSWORD -e "alter database $MYSQL_DATABASE default character set utf8"

		rm dump.sql;
	fi;
fi;

docker exec -t bsymfony_php composer install;
docker exec -t bsymfony_php php bin/migrate up;
docker exec -t bsymfony_php php bin/console doctrine:migrations:migrate;
#docker exec -t bsymfony_php vendor/bin/phpunit --configuration phpunit.xml;

npm install;
npm run build;
