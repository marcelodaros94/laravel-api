# Proyecto Laravel 9

## Nota

Algunas mejoras de código y características adicionales que no se pudieron completar a tiempo incluyen:

- **Inicialización de constantes**: Valores numéricos y index strings que sean constantes, trato de colocarlos normalmente como private variables al comienzo de los controladores.
- **Pruebas adicionales**: Se necesitan más pruebas unitarias y de integración que cubran más casuísticas. Y automatizarlas con Husky u otras librerías para ejecutarlas antes de cada push.
- **Manejo de errores**: Agregar try catch a cada función de los controladores es fundamental. Y uniformizar las respuestas con formato success-data-message
- **Repositorios**: Por premura también tuve que utilizar modelos directamente en el controlador, pero lo que normalmente hago es separar en repositorios las tareas que interactúan con la base de datos. Así lo separamos en capas.

Estas mejoras están en la lista de tareas pendientes y serán consideradas en futuras actualizaciones.

## Descripción

Este es un proyecto básico de Laravel 9. Puedes usarlo como punto de partida para tus aplicaciones web.

## Requisitos

- PHP 8.0 o superior
- Composer

## Instalación

1. Clona el repositorio:
    ```bash
    git clone <url_del_repositorio>
    ```

2. Navega al directorio del proyecto:
    ```bash
    cd nombre_del_proyecto
    ```

3. Instala las dependencias:
    ```bash
    composer install
    ```

4. Copia el archivo de configuración:
    ```bash
    cp .env.example .env
    ```

5. Genera la clave de aplicación:
    ```bash
    php artisan key:generate
    ```

6. (Opcional) Ejecuta las migraciones:
    ```bash
    php artisan migrate
    ```

## Uso

Para iniciar el servidor de desarrollo, ejecuta:
```bash
php artisan serve
