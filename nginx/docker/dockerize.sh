#!/bin/sh

dockerize -wait tcp://app:9000 -- nginx