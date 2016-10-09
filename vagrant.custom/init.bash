﻿#!/usr/bin/env bash

# Скрипт, занимающийся установкой площадки

SCRIPT_DIR="/home/bitrix/vagrant.custom/"
HOME="/home/bitrix/"

## Установка БД
mysql -uroot < ${HOME}/vagrant.custom/mysql.sql || exit 1

# Установка Битрикс

# @todo: нужно сделать какой-то выбор типа редакции
#http://www.1c-bitrix.ru/private/download/
#                "business"=>"Бизнес",
#                "expert"=>"Эксперт",
#                "small_business"=>"Малый бизнес",
#                "standard"=>"Стандарт",
#                "start"=>"Старт",
#_encode_php5.tar.gz


## Скачиваем и распаковываем Битрикс
cd ${HOME}
wget http://www.1c-bitrix.ru/download/start_encode_php5.tar.gz || exit 1

mkdir tmp_b
tar -xf start_encode_php5.tar.gz -C tmp_b
mv tmp_b/bitrix www/bitrix
mv tmp_b/upload www/upload
rm tmp_b -rf
rm start_encode_php5.tar.gz -rf

# Спасаем индексную страницу, потому что следующий шаг её прибьёт :(
cp ${HOME}www/index.php /tmp/index.php

## Запускаем установку Битрикса. К сожалению - приходится извращаться и запускать по шагам.
php -f ${SCRIPT_DIR}install.php || exit 1

# Восстанавливаем индексную страницу
cp /tmp/index.php ${HOME}www/index.php -f

echo "OLALA!"

## Обновление композера
cd ${HOME}
composer install

## Временный костыль
# @notice Пока что console jedi не умеет прописывать файлы `.settings.php` и `dbconn.php`, поэтому нужно скопировать
cp -f ${HOME}www/bitrix/.settings.php.example ${HOME}www/bitrix/.settings.php
cp -f ${HOME}www/bitrix/php_interface/dbconn.php.example ${HOME}www/bitrix/php_interface/dbconn.php

## Init Console.Jedi
cd ${HOME}
# @notice: на проекте уже выполнен `www/vendor/bin/jedi init`
www/vendor/bin/jedi env:init dev

