#!/bin/bash


buildDocker(){
    docker-compose up -d --build store db
    echo -ne '\n' | docker-compose exec store bash
}

deployBackend(){
    currentPath=$(pwd)
    cd backend
    composer update
    php bin/console do:sc:up --force
    cd $currentPath
}

deployFrontend(){
    currentPath=$(pwd)
    cd frontend
    curl -o- https://raw.githubusercontent.com/creationix/nvm/v0.33.8/install.sh | bash
    npm install -g @angular/cli
    npm install
    ng build
    cd $currentPath
}


buildDocker
deployBackend
deployFrontend

echo "----------------"
echo "DEPLOY FINISHED \n"
echo "Enjoy :) \n"