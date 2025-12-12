## Laravel12 React создание простого ws-подключения

1.  Creating a Laravel Project
```
docker exec -it --user www-data nginx-phpfpm bash
composer create-project laravel/laravel ./
```
2. Install Reverb
```
php artisan install:broadcasting
```
3.  Creating React Router (v7) a full-stack React framework
```
npx create-react-router@latest
npm install

npm i laravel-echo
npm i pusher-js
```
4. Реализация подключения к открытому ws каналу
