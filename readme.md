# Club del Búho Web

Aplicación web del Club del Búho, construida con Laravel, Inertia.js y Tailwind CSS. Este repositorio contiene la interfaz web, la configuración de desarrollo y los recursos necesarios para ejecutar el proyecto localmente.

## Tecnologías

- Laravel
- Inertia.js
- PHP
- JavaScript / Node.js
- Tailwind CSS
- Vite / Mix
- Docker

## Requisitos previos

- PHP 8+
- Composer
- Node.js 16+ o superior
- Yarn o npm
- SQLite, MySQL o PostgreSQL

## Instalación local

Clona el repositorio:

```sh
git clone https://github.com/SManriqueDev/clubdelbuho-web.git
cd clubdelbuho-web
```

Instala las dependencias de PHP:

```sh
composer install
```

Instala las dependencias de frontend:

```sh
yarn install
```

Copia el archivo de entorno:

```sh
cp .env.example .env
```

Genera la clave de la aplicación:

```sh
php artisan key:generate
```

Si usas SQLite, crea la base de datos:

```sh
touch database/database.sqlite
```

Ejecuta las migraciones y seeders:

```sh
php artisan migrate --seed
```

Compila los assets:

```sh
yarn dev
```

Levanta el servidor de desarrollo:

```sh
php artisan serve
```

## Desarrollo con Docker

El proyecto incluye configuración para trabajar con Docker. Revisa los archivos `docker-compose.yml`, `Dockerfile.php` y `Dockerfile.node` para adaptar el entorno a tus necesidades.

## Credenciales de ejemplo

Si el proyecto incluye datos de prueba, puedes revisar el seeder o el archivo de configuración correspondiente para obtener las credenciales disponibles.

## Scripts útiles

- `yarn dev` — compila los assets en modo desarrollo
- `yarn watch` — recompila automáticamente al detectar cambios
- `yarn prod` — genera build optimizada para producción
- `php artisan test` — ejecuta la suite de pruebas

## Pruebas

```sh
php artisan test
```

## Estructura general

- `app/` — lógica de la aplicación
- `resources/` — vistas, assets y componentes frontend
- `routes/` — definición de rutas
- `database/` — migraciones, seeders y base de datos
- `public/` — archivos públicos

## Licencia

Este proyecto está publicado bajo la licencia MIT.