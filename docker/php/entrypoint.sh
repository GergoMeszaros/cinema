#!/bin/sh

php-fpm & npm run build & npm run dev

tail -f /dev/null
