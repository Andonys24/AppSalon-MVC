# AppSalon

AppSalon es una aplicación web de gestión de citas para un salón de belleza. Esta aplicación permite a los usuarios registrarse, iniciar sesión, reservar citas y administrar sus reservas. También incluye funcionalidades para un usuario administrador que puede gestionar citas y servicios.

## Características

- **Registro de Usuarios**: Los usuarios pueden crear una cuenta con validación de email.
- **Inicio de Sesión**: Los usuarios pueden iniciar sesión si han confirmado su email.
- **Recuperación de Contraseña**: Los usuarios pueden recuperar su contraseña a través de un token enviado por email.
- **Gestión de Citas**: Los usuarios pueden seleccionar servicios, elegir fecha y hora para una cita, y ver un resumen antes de reservar.
- **Administración**: Un usuario administrador puede ver citas por fecha, agregar y eliminar servicios, y eliminar citas atendidas.

## Tecnologías Utilizadas

- **PHP 8**
- **MySQL**
- **SASS**
- **Gulp**
- **Mailtrap** para envío de emails de verificación y recuperación de contraseña

## Instalación

### Prerrequisitos

- PHP 8
- MySQL
- Node.js
- Composer
- Gulp

### Clonar el Repositorio

```bash
git clone https://github.com/Andonys24/App-Salon.git
cd appsalon
```

### Configurar el Entorno

1. Copia el archivo `.env.example` a `.env` y configura tus variables de entorno:
    - Base de datos (DB_HOST, DB_NAME, DB_USER, DB_PASS)
    - Mailtrap (MAILTRAP_USERNAME, MAILTRAP_PASSWORD)

2. Instala las dependencias de PHP con Composer:
    ```bash
    composer install
    ```

3. Instala las dependencias de Node.js con npm:
    ```bash
    npm install
    ```

4. Ejecuta Gulp para compilar los archivos SASS:
    ```bash
    npm run dev
    ```

### Configurar la Base de Datos

1. Crea la base de datos:
    ```sql
    CREATE DATABASE appsalon_mvc;
    ```

2. Importa las tablas y datos iniciales desde el archivo `appsalon_mvc.sql`:
    ```bash
    mysql -u tu-usuario -p appsalon < appsalon_mvc.sql
    ```
3. Editar database.php para usar la base de datos, segun tus credenciales
## Uso

### Registro e Inicio de Sesión

1. Visita la página de registro y crea una cuenta.
2. Recibirás un email de confirmación. Confirma tu cuenta haciendo clic en el enlace proporcionado.
3. Inicia sesión con tus credenciales.

### Reserva de Citas

1. Selecciona los servicios deseados.
2. Ve a la sección de "Información de Cita" y selecciona la fecha y hora.
    - No se permiten fechas anteriores, horarios fuera de trabajo o fines de semana.
3. Revisa el resumen de tu cita y confirma la reserva.

### Administración

1. Inicia sesión como administrador.
2. Gestiona citas por fecha, agrega o elimina servicios y elimina citas atendidas.

## Contribución

1. Haz un fork del repositorio.
2. Crea una nueva rama (`git checkout -b feature/nueva-funcionalidad`).
3. Realiza tus cambios y commitea (`git commit -am 'Añadir nueva funcionalidad'`).
4. Push a la rama (`git push origin feature/nueva-funcionalidad`).
5. Crea un nuevo Pull Request.
