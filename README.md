## IMPORTANTE!
En caso de usar Docker ir al readme en la carpeta .docker

## Requisitos
* PHP >= 7.3.0
* PostgreSQL >= 9.6
* Node >= 13.11.0

## Instalación

Pasos para instalar el proyecto por primera vez:
 1. Clonar el proyecto
 2. Copiar el archivo .env.example a .env y configurar mínimamente los parámetros: 
- 2.1 Acceso a la Base de Datos Postgres (mysql) <br/>
(Se tiene separada la base de datos en dos conexiones, pudiendose usar dos bases Postgres independientes, dos schemas de una misma base, o un mismo schema)
- 2.2 Acceso a la Base de Datos Redis para sesión y cache (redis)
- 2.3 Credenciales de Envio de Correos
- 2.4 (OPCIONAL) Credenciales de Google reCAPTCHA (Generarlas en https://www.google.com/recaptcha/admin/)
 3. `composer install`
 4. `php artisan key:generate`
 4. `php artisan config:cache`
 5. `php artisan migrate --seed`
 6. `php artisan passport:keys`
 7. `npm install`
 8. `npm run dev`

## Acceso al Backoffice
 1. Ingresar al backoffice (`/backend/login`) con las credenciales de usuario de backend. <br/>
 Por defecto, las mismas seran las siguientes:
 ```
 user: superadmin
 pass: superadmin
 ```
 2. Una vez dentro, dirijase a la Barra de Navegacion -> Mi Perfil (`/backend/profile/edit`) y modifique las credenciales a gusto.

## Manejo de Clientes
 1. Para registrar clientes, dirijase a la Barra de Navegacion -> Clientes -> Agregar (`/backend/client/add`). Deberá colocar, entre otras cosas, el URL al que su cliente espera se redirija a los usuarios identificados.
 2. Una vez registrado un cliente, verá sus credenciales en el listado al que fue redirigido, al cual podrá ingresar en todo momento desde Clientes -> Listado (`/backend/client`)

## Configuración de parte del Cliente
Sus clientes requerirán los siguientes datos:

1. `client_id` : Campo ID de la tabla del Listado de Clientes, filtrada por nombre si es preciso.
2. `client_secret` : Campo Secret de la tabla del Listado de Clientes, filtrada por nombre si es preciso.
3. URL de Autorización: `/oauth/authorize`
4. URL de Solicitud de Token de Acceso: `/oauth/token`
5. URL de obtención de datos del usuario (Requiere Token de Acceso): `/api/user`

##DEPENDENCIAS
1. https://github.com/spatie/emoji (EMOJIS)
