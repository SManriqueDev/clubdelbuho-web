#!/bin/sh

set -e

echo 'running prestart node script'
echo 'running yarn install'
yarn install

echo 'initialization done, start watching'
yarn run watch-poll