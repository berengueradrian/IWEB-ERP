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
-  Mirad este enlace para ver los comandos que tenéis que ejecutar por si tenéis dudas
    - https://demos.themeselection.com/materio-vuetify-vuejs-admin-template-vue2/documentation/guide/laravel-integration/installation.html#guide

## BBDD
- Draw.io con la estructura de la BBDD: https://app.diagrams.net/#G1Zdn3UXGbnQ15xSQ_08hQ3R2FfHNFtsm5
- Pasos para crear la Base de datos:
    - Tener instalado mysql y alguna aplicación que nos sirva como servidor de bases de datos (en mi caso uso DataGrip, también se puede usar Adminer).
    - Después el proceso sería (en una terminal):
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

## Puesta en marcha del proyecto
- Después de haber inicializado el proyecto instalando sus dependencias y, después de realizar la instalación de la BBDD, abrimos dos terminales y ejecutamos:
    - `php artisan serve`, ejecutamos el back-end.
    - `npm run watch`, ejecutamos el front-end. Con este comando no necesitamos volver a ejecutar el programa si realizamos cambios.
    - También podríamos ejecutar `npm run dev`, pero en este caso cuando realizásemos cambios, tendríamos que reiniciarlo.
    - Por último, cuando queramos subir la aplicación a producción, ejecutamos `npm run prod`.

## Estructura del proyecto
- Las carpetas relevantes del proyecto son las siguientes:
    - *app/*: Donde tenemos el back-end de la aplicación. Aquí encontramos diversas carpetas:
        - *Http/*: aquí tenemos los controllers en *Controllers/* y la capa intermedia para hacer comprobaciones en *Middleware/*.
        - *Models/*: la capa de acceso a la bbdd.
        - *Providers/* y *Console/*, son dos carpetas que no usaremos en principio.

    - *database/*: aquí tenemos las migraciones/tablas de la bbdd *migrations/* y los datos de prueba en la bbdd *seeders/*.

    - *public/*: aquí encontramos la carpeta *images/*, donde introduciremos una nueva llamada *users/* y meteremos las imágenes de perfil de los usuarios. Esta carpeta no se subirá a git por lo que la creamos todos y nos pasamos las fotos.

    - *resources/*, por último, esta carpeta contiene las vistas en *js/src/views*, también *js/src/components* y *js/src/*. También encontramos las rutas *js/src/router*. Otras como el *js/src/store* (manejo del estado de la aplicación) o *js/src/plugins*.
