#!/bin/bash

dir=$(pwd)

# docker run -p 88:8080 -v $dir:/var/www/html trafex/alpine-nginx-php7

docker run -p 80:80 -p 9000:9000 --name web-tech -v $dir:/var/www -d ttaranto/docker-nginx-php7

# sau khi chay dc docker len roi thi chay
# docker exec -it web-tech bash
# cd /var/www
# composer install