#!/bin/sh

# Usage: ./deploy-prod.sh {tag or commit}
# Folder structure
# main-folder
#   |-- releases
#     |-- v0.1.1
#   |-- shared
#     |-- storage

MAIN_PATH=$(pwd)

if [ -z "$1" ]
then
    release_name=$(date +"%Y%m%d_%H%M%S")
else
    release_name=$1
fi

mkdir "releases/$release_name"

cd "releases/$release_name" || exit

git clone https://github.com/tuxonice/clipboard.git .
git checkout $release_name

composer install --no-dev

rm .env.example deploy-prod.sh .gitignore readme.md LICENSE docker-compose.yml phpunit.xml
rm -rf tests .github .git storage docker bin

ln -s $MAIN_PATH/shared/.env .env
ln -s $MAIN_PATH/shared/storage storage

cd $MAIN_PATH || exit

rm current
ln -s "releases/$release_name/public/" current