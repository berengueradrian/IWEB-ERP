# IWEB-ERP-RRHH
## Proyecto ERP - Apartado de RRHH

- Autores:
    - `Adrián Berenguer Agulló`
    - `Rosa María Rodríguez Lledó`
    - `Javier Rodríguez Juan`
    - `Ilya Slyusarchuk Dimitrouchkina`

## Plantilla instalada
- https://themeselection.com/item/materio-free-vuetify-vuejs-laravel-admin-template/

## Instalación de plantilla
-  Mirad este enlace para ver los comandos que tenéis que ejecutar por si tenéis dudas_
    - https://demos.themeselection.com/materio-vuetify-vuejs-admin-template-vue2/documentation/guide/laravel-integration/installation.html#guide

## BBDD
- Pasos para crear la Base de datos:
    - Tener instalado mysql y alguna aplicación que nos sirva como servidor de bases de datos (en mi caso uso DataGrip, también se puede usar Adminer).
    - Después el proceso sería:
        - `sudo mysql -p -u root`
        - mysql> `CREATE DATABASE erp CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;`
        - mysql> `CREATE USER 'usuario'@'localhost' IDENTIFIED BY 'contraseña';`
        - mysql> `GRANT ALL PRIVILEGES ON *.* TO 'dss'@'localhost';`
        - mysql> `FLUSH PRIVILEGES;`
        - A continuación, en tu servidor de BBDD introduces los datos anteriores y pruebas la conexión.
        - En el proyecto, `cp .env.example .env`, (si no has hecho `php artisan key:generate` lo haces) y, introduces los datos de *DB_DATABASE*, *DB_USERNAME* y *DB_PASSWORD* con tus datos.
        - Después, en la raíz del proyecto, ejecutas `php artisan:migrate install`.
        - Finalmente, revisas el servidor de BBDD para comprobar que se ha instalado correctamente y tienes las tablas.

    - El **phpunit.xml**, ha sido modificado con el nombre de la BBDD y el servidor de BBDD, en este caso, **mysql**. Por esto mismo y por si acaso, lo mejor es tener el mismo nombre de BBDD.
