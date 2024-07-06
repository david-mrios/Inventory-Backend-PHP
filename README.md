<h1 align="center"> CodeIgniter 4 Application Starter: Inventory<h1> 

<h1 align="center"> Sistema de Inventario de Equipos Tecnológicos en Laboratorios de Computación <h1>

## Descripción General

El **Sistema de Inventario de Equipos Tecnológicos en Laboratorios de Computación** es una aplicación basada en CodeIgniter 4 diseñada para gestionar y monitorear el equipo tecnológico en laboratorios de computación. Este sistema ayuda a mantener un registro actualizado de todos los equipos, asegurando un seguimiento y gestión eficientes de los artículos tanto funcionales como no funcionales.

## Características

- **Gestión de Inventario**: Permite añadir, editar, eliminar y visualizar equipos tecnológicos.
- **Seguimiento de Equipos**: Mantiene un registro de equipos funcionales y no funcionales.
- **Migraciones de Base de Datos**: Implementa migraciones para gestionar cambios en la estructura de la base de datos.
- **Conexión a MySQL**: Usa MySQL como sistema de gestión de bases de datos.

## Requisitos

- PHP 7.3 o **superior**
- MySQL 8.3 **Preferiblemente**
- Composer: **latest**

## Instalación

1. **Clonar el Repositorio**

   ```bash
   https://github.com/david-mrios/Inventory-Backend-PHP.git
   ```

    ```bash
   cd Inventory-Backend-PHP
   ```

2. **Instalar Dependencias**

   Asegúrate de tener Composer instalado y ejecuta:

   ```bash
   composer install
   ```

3. **Configurar el Entorno**

Ubica el archivo `app/Config/Database.php` y ajusta la configuración de la base de datos:

   ```plaintext
    public array $default = [
        'DSN'          => '',
        'hostname'     => 'localhost',
        'username'     => 'root',
        'password'     => 'root',
        'database'     => 'inventory',
        'DBDriver'     => 'MySQLi',
        'DBPrefix'     => '',
        'pConnect'     => true,
        'DBDebug'      => true,
        'charset'      => 'utf8',
        'DBCollat'     => 'utf8_general_ci',
        'swapPre'      => '',
        'encrypt'      => false,
        'compress'     => false,
        'strictOn'     => false,
        'failover'     => [],
        'port'         => 3306,
        'numberNative' => false,
    ];
   ```

4. **Ejecutar Migraciones**

   Ejecuta las migraciones para crear las tablas necesarias en la base de datos:

   ```bash
   php spark migrate
   ```

5. **Iniciar el Servidor**

   Puedes iniciar el servidor de desarrollo de CodeIgniter con el siguiente comando:

   ```bash
   php spark serve
   ```

   La aplicación estará disponible en `http://localhost:8080` o `http://localhost:8081`. 