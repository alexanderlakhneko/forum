#!/usr/bin/env bash

git pull
docker-compose -f docker-compose.test.y ml up -d --build
