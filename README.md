<h1 align="center">
   STRYDE
</h1>

Tarea de desarrollo de tienda de ropa

---
## 👥 Creadores

Este proyecto fue desarrollado por:

- **Randall Álvarez**  
  [![GitHub](https://img.shields.io/badge/GitHub-Ogiwara--unu-blue?style=flat&logo=github)](https://github.com/Ogiwara-unu)

- **Valeria Fernández**  
  [![GitHub](https://img.shields.io/badge/GitHub-ValeeFernandez-blue?style=flat&logo=github)](https://github.com/ValeeFernandez)

- **Alejandro Chaves**  
  [![GitHub](https://img.shields.io/badge/GitHub-alendroc-blue?style=flat&logo=github)](https://github.com/alendroc)

---

Consideraciones del Proyecto
Instalación:

- npm i
- composer install
- copy .env.example .env
- php artisan key:generate
  
Base de Datos

Actualmente el proyecto utiliza SQLite.

Ubicación de la base de datos:

TenisShop/TeniShop/database

Se debe crear manualmente el archivo:

database.sqlite 


Para generar la base de datos con el dataset:

- php artisan migrate:fresh --seed

Consejo para las mentes jiji:

Usen php artisan tinker, te deja interacturar con la base de datos desde la consola 

Ejemplos

Ver tablas existentes:

DB::select("SELECT name FROM sqlite_master WHERE type='table'");

Verificar si existe una tabla:

Schema::hasTable('categorias');

Ver columnas de una tabla:

Schema::getColumnListing('categorias');

Consultar datos:

App\Models\Categoria::all();
App\Models\Marca::all();
App\Models\ImagenZapato::all();
App\Models\TallaZapato::all();







