<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# EnergiTrack

**EnergiTrack** es un sistema de monitoreo energético en tiempo real diseñado para recopilar y analizar datos precisos sobre el consumo y la generación de energía en tu hogar. A través de una plataforma web intuitiva, EnergiTrack te permite acceder a estos datos, visualizarlos de manera clara y tomar decisiones informadas para un uso más eficiente de la energía.



## Instalación

Para instalar y ejecutar el proyecto en tu entorno local, sigue estos pasos:

1. **Clonar el repositorio**:
    ```bash
    git clone https://github.com/tu-usuario/EnergiTrack.git
    cd EnergiTrack
    ```

2. **Instalar dependencias**:
    ```bash
    composer install
    npm install
    ```

3. **Configurar el entorno**:
    Copia el archivo `.env.example` y renómbralo a `.env`. Luego, edítalo para configurar las variables de entorno necesarias, como la base de datos y las claves API.

    ```bash
    cp .env.example .env
    ```

  Asegúrate de agregar las siguientes credenciales de Google OAuth para la autenticación:

    ```dotenv
    GOOGLE_CLIENT_ID=tu-google-client-id
    GOOGLE_CLIENT_SECRET=tu-google-client-secret
    GOOGLE_REDIRECT_URI=tu-google-redirect-uri
    ```

4. **Generar clave de aplicación**:
    ```bash
    php artisan key:generate
    ```

5. **Migrar la base de datos**:
    ```bash
    php artisan migrate
    ```

6. **Iniciar el servidor**:
    ```bash
    php artisan serve
    npm run dev
    ```

    Accede a la aplicación en `http://localhost:8000`.

## Uso

Una vez que la aplicación esté en funcionamiento, puedes registrarte e iniciar sesión para empezar a monitorear y visualizar los datos energéticos de tu hogar. La interfaz de usuario te guiará a través de las diferentes funciones disponibles para un monitoreo eficiente y una mejor comprensión de tu consumo de energía.

## Contribuciones

¡Gracias por considerar contribuir a EnergiTrack! Por favor, sigue las pautas de contribución descritas en nuestro [documento de contribución](CONTRIBUTING.md).

## Código de Conducta

Para asegurar un ambiente acogedor y respetuoso para todos, por favor, revisa y sigue nuestro [Código de Conducta](CODE_OF_CONDUCT.md).

## Licencia

Este proyecto está licenciado bajo la [Licencia MIT](https://opensource.org/licenses/MIT).

## Contacto

Para cualquier pregunta o información adicional, por favor, contacta con:

- **Nombre del Desarrollador**: [Juan Jose Rios Huete]
- **Correo Electrónico**: [jrios9836@gmail.com]
- **GitHub**: [https://github.com/juanjose23](https://github.com/juanjose2)
