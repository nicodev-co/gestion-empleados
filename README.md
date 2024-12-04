# Proyecto Empleados

Este proyecto es una aplicación web para la gestión de empleados. Utiliza PHP 8.2 y Apache2 para servir la aplicación con rutas amigables.

## Requisitos

- PHP 8.2
- Apache2
- MySQL (o cualquier otro sistema de gestión de bases de datos compatible)

## Instalación

1. Clona el repositorio en tu servidor web:

    ```bash
    git clone https://github.com/nicodev-co/gestion-empleados.git 
    ```

2. Navega al directorio del proyecto:

    ```bash
    cd /var/www/gestion-empleados
    ```

3. Configura tu servidor Apache para que apunte al directorio del proyecto. Asegúrate de que el módulo `mod_rewrite` esté habilitado para permitir rutas amigables.

    ```bash
    sudo a2enmod rewrite
    sudo systemctl restart apache2
    ```

4. Asegúrate de que el archivo `.htaccess` esté presente en el directorio raíz del proyecto para manejar las rutas amigables.

5. Configura tu base de datos y actualiza el archivo de configuración de la base de datos en el proyecto.

6. Accede a la aplicación desde tu navegador web:

    ```
    http://localhost
    ```

## Uso

- Navega a la URL principal para acceder a la aplicación.
- Utiliza las diferentes secciones de la aplicación para gestionar empleados.

## Contribuciones

Las contribuciones son bienvenidas. Por favor, abre un issue o un pull request para discutir cualquier cambio que desees realizar.

## Licencia

Este proyecto está licenciado bajo la [MIT License](LICENSE).