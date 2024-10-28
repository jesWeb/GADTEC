<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About GADTEC - Sistema de Control Vehicular
Este proyecto está basado en Laravel 10 y está diseñado para facilitar el control vehicular. A continuación, encontrarás las instrucciones para clonar, configurar y ejecutar el proyecto en un entorno de desarrollo local (Windows o macOS).


## Servicios Necesarios
Para ejecutar este proyecto con MySQL, asegúrate de que los siguientes servicios estén activos en tu entorno:
- Servidor Web(Apache o Nginx) 
    -> XAMPP y MAMP: usa Apache.
    -> Laragon: admite Apache o Nginx.
- Servidor de Base de Datos (MySQL)
    -> Laravel utiliza MySQL para gestionar los datos. Enciéndelo antes de ejecutar las migraciones y la aplicación.

## Requisitos Previos
- PHP 8.1+
- Composer
- Node.js y NPM
- Git

## Instalación y Configuración
Clonación del Repositorio
- [git clone](git@github.com:jesWeb/GADTEC.git)

## Ingresar al Proyecto
- cd GADTEC
- cd GADTEC-Project -> en caso de que sea descargado el proyecto

## Instalación de Dependencias
Instala las dependencias de PHP y de Node.js con los siguientes comandos:
- composer install
- npm install

## Configuración del Entorno
Duplica el archivo [.env.example] para crear el archivo [.env]:
- cp .env.example .env

Establece la conexión a tu base de datos MySQL en local, que suelen ser los siguientes:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1       
DB_PORT=3306            # Puerto estándar de MySQL
DB_DATABASE=nombre_bd   # Cambia 'nombre_bd' al nombre de tu base de datos
DB_USERNAME=usuario     # Cambia 'usuario' por tu usuario de MySQL (en XAMPP suele ser 'root')
DB_PASSWORD=contraseña  # Cambia 'contraseña' por tu contraseña de MySQL (en XAMPP suele estar vacía por defecto)

## Genera la clave de la aplicación:
- php artisan key:generate

## Migraciones de Base de Datos
Ejecuta las migraciones para crear las tablas necesarias en la base de datos:
- php artisan migrate

## Compilar Estilos de Vue (o frontend)
Compila los archivos necesarios con el siguiente comando:
- npm run build

## Ejecutar Proyecto
Para iniciar el servidor del sistema, utiliza:
- php artisan serve

[Nota:] Para acceder al proyecto desde dispositivos móviles, utiliza la IP de tu computadora. 

Por ejemplo:
- php artisan serve --host=192.168.1.104 --port=8000
Reemplaza 192.168.1.104 con la IP correspondiente de tu computadora en la red.

