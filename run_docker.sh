#!/bin/bash

dir=$(pwd)
docker run -p 80:8080 -v $dir:/var/www/html trafex/alpine-nginx-php7