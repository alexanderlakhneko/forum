#!/bin/sh

if [ "$1" == "app" ]; then
    COMMAND="-wait tcp://redis:6379 -- sh /app/docker/run-fpm.sh"
elif [ "$1" == "worker" ]; then
    COMMAND="-wait tcp://redis:6379 -- php /app/artisan horizon"
elif [ "$1" == "cron" ]; then
    COMMAND="-wait tcp://redis:6379 -- supercronic -json /app/docker/artisan-cron"
elif [ "$1" == "test" ]; then
    dockerize -wait tcp://test_db:5432 $COMMAND -- sh /app/docker/run-test.sh
else
    echo "NO SUCH JOB $1"
    exit 2
fi

if [ "$1" != "test" ]; then
    dockerize -wait tcp://db:5432 $COMMAND
fi
