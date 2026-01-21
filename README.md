# Recomendación de prueba del proyecto:

## Que hace el proyecto
Es un Catálogo (Menú)  el cual se pueden agregar, eliminar y actualizar, categorías e ítems. Tienes un usuario de prueba el que te permite realizar estas acciones. Solo necesitas ir a admin en la parte inferior de la página y hacer el login

## Proceso de instalación y configuración
Algunos pasos pueden variar dependiendo del sistema operativo que usted utilice. Este ejemplo se está realizando en Windows 10. En Mac o Linux, los pasos podrían diferir.
### Versiones, con las que trabajo:
- Php : 8.3.10 (cli)
- Laravel: laravel/framework: "^11.31"
- Composer: 2.8.5
- Mysql: mysql  Ver 14.14 Distrib 5.7.24, for Win64 (x86_64)
### Instalar Chocolatey
#### Si no cuentas con Chocolatey. Tendrás que agregarlo.
- command powershell:
```powershell 
- Set-ExecutionPolicy Bypass -Scope Process -Force; `
[System.Net.ServicePointManager]::SecurityProtocol = [System.Net.ServicePointManager]::SecurityProtocol -bor 3072; `
iex ((New-Object System.Net.WebClient).DownloadString('https://community.chocolatey.org/install.ps1'))
```
### Instalar Php
-Command: 
```powershell
choco install php --version=8.3.10
```
### Instalar composer
- Descargar y instalar de: 
```
https://getcomposer.org/
```
### Traer dependencias del proyecto
- En la ubicación del proyecto, en la terminal ejecutar command:`
```bash
 composer install
 ```

### Configuración .env
- Renombrar   .env.example a .env
- Configurar los parámetros de conexión a la base de datos en .env  que se vaya a usar y sacarle el #  :
```
 # DB_CONNECTION=mysql
 # DB_HOST=127.0.0.1
 # DB_PORT=3306
 # DB_DATABASE=laravel
 # DB_USERNAME=root
 # DB_PASSWORD=
```
### Configuración base de datos
### Opcional Instalar Mamp
- Instalar Mamp de:
    ```
    https://www.mamp.info/en/downloads/
    ```
#### Respaldo base de datos
- Abrimos una terminal y usamos el command:
```  
cd C:\MAMP\bin\mysql\bin
```
- Ejecutamos en la ubicación anterior el command: 
```
mysql -u root -p nombre_database < ubicacion/backups_restaurant.sql
```
- Se puede omitir el -p si la base de datos no tiene contraseña

### Obligatorio, realizar enlace simbólico
- En la ubicación del proyecto ejecutar el command: 
```
php artisan storage:link
```
## Levantar proyecto
- Abrir una terminal en la ubicación del proyecto teniendo levantado Mamp con el Mysql server encendido utilizar el command: 
``` 
php artisan serve
```
- Levantará el  proyecto web en el localhost. 
- Otro comando es: 
``` 
php artisan serve --host=tu_ip_local --port=8080 
``` 
- Se levanta en tu red local y podrás ver el proyecto en los dispositivos que estén en tu red local.
- Para ver tu ip en window es: 
```
ipconfig
``` 
- Esta en:
```
     Dirección IPv4. . . . . . . . . . . . . . : 192.168.1.7
```
---

# Project Testing Recommendation

## What the project does

This is a **Catalog (Menu)** where you can **add, delete, and update categories and items**.\
You have a **test user** that allows you to perform these actions.\
Simply go to **Admin** at the bottom of the page and log in.
## Demo
visit the live demo: 
```
https://eadweb.tech/home/cooking
```
## Installation and Setup Process

Some steps may vary depending on your operating system. This example is done on **Windows 10**.\
On **Mac** or **Linux**, the steps may differ slightly.

### Versions I worked with:

- **PHP**: 8.3.10 (cli)
- **Laravel**: laravel/framework: "^11.31"
- **Composer**: 2.8.5
- **MySQL**: mysql  Ver 14.14 Distrib 5.7.24, for Win64 (x86\_64)

### Install Chocolatey

If you don't have Chocolatey installed, you need to add it:

```powershell
Set-ExecutionPolicy Bypass -Scope Process -Force; `
[System.Net.ServicePointManager]::SecurityProtocol = [System.Net.ServicePointManager]::SecurityProtocol -bor 3072; `
iex ((New-Object System.Net.WebClient).DownloadString('https://community.chocolatey.org/install.ps1'))
```

### Install PHP

```bash
choco install php --version=8.3.10
```

### Install Composer

Download and install it from:\
[https://getcomposer.org/](https://getcomposer.org/)

### Install Project Dependencies

Navigate to your project directory and run:

```bash
composer install
```

### .env Configuration

- Rename `.env.example` to `.env`.
- Configure your database connection settings in the `.env` file by uncommenting and updating:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

### Database Setup

#### Optional: Install MAMP

Download MAMP from:\
[https://www.mamp.info/en/downloads/](https://www.mamp.info/en/downloads/)

#### Restore Database Backup

- Open a terminal and navigate to:

```bash
cd C:\MAMP\bin\mysql\bin
```

- Run the following command to restore the database:

```bash
mysql -u root -p database_name < path/to/backups_restaurant.sql
```

You can omit the `-p` if your database has no password.

### Mandatory: Create the symbolic link

In your project directory, run:

```bash
php artisan storage:link
```

## Start the Project

- Open a terminal in your project directory. With **MAMP** running and **MySQL server started**, execute:

```bash
php artisan serve
```

This will start the web project on **localhost**.

- Alternatively, to run it on your **local network**, use:

```bash
php artisan serve --host=your_local_ip --port=8080
```

You can view the project on other devices connected to the same network.

To check your **local IP on Windows**, run:

```bash
ipconfig
```

Look for:

```
IPv4 Address. . . . . . . . . . . : 192.168.1.7
```
