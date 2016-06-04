#!/usr/bin/env bash

if [ ! -d "/tmp/wordpress" ]; then
    cp -r /home/beapen/Documents/wordpress-test/wordpress /tmp/
    cp -r /home/beapen/Documents/wordpress-test/wordpress-tests-lib /tmp/
fi

phpunit