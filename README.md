<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://devsprinters.com/public/images/devsprinter_logo_bg_white.webp" width="300" alt="Laravel Logo"></a></p>

## CEES API - Laravel

API de la Aplicación CEES.

## Configuración inicial del proyecto

Para comenzar se debe copiar .env.example para un nuevo archivo .env.

Luego se debe colocar los datos de la base de dato relacional (Ejemplo: MySQL), y los datos para el JWT.

No olvidarse de instalar las dependencias con composer:

> composer install

## Migrations

Crear base de datos con el mismo nombre colocado en el .env, para posteriormente ejecutar:

> php artisan migrate

Esto creara todas las tablas de la base de datos con sus relaciones.

## Seed

Ejecutar:

> php artisan db:seed

Esto creara los roles: Super Admin y Admin, en la base de datos junto con el usuario Super Admin.

> john.doe@gmail.com

> 123123

## Ejecutar proyecto

> php artisan serve

O instalar el sitio en un servidor Apache o NGINX.

## Insomnia

En la carpeta insomnia existe un archivo "insomnia.json", el cual sirve para ver todas las rutas de la api, y analizar su funcionamiento, para ellos se debe importar el archivo desde la aplicación **Insomnia**.