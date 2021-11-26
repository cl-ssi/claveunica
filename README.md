# Implementación de Clave Única del estado de Chile con Laravel 8

  

> Para probar el sistema, tienes que tener acceso a la URL callback proporcionada al solicitar tus credenciales en clave única, ya que una vez autentificado, clave única redireccionará la respuesta a esa URL.

## Requerimientos

- Php 7.4
- Laravel 8
- Composer
- Git

  

## Instalación

* Clonar el repositorio `git clone https://github.com/cl-ssi/claveunica.git`
*  `cd claveunica`
* Crea una copia del archivo .env.example con el nombre .env
* Editar el archivo .env y agregar las credenciales de clave única y base de datos (opcional).
* Ejectua `php artisan key:generate`
* Ejecutar `composer install`
* Ejecutar el servidor del proyecto `php artisan serve`
* Abrir el navegador el proyecto.

   

## Archivos con la implementación

* Archivo con las rutas: <a  href="https://github.com/cl-ssi/claveunica/blob/main/routes/web.php">web.php</a>
* Controlador: <a  href="https://github.com/cl-ssi/claveunica/blob/main/app/Http/Controllers/ClaveUnicaController.php">ClaveUnicaController</a>
* Vista con el boton de CU: <a  href="https://github.com/cl-ssi/claveunica/blob/main/resources/views/welcome.blade.php">welcome.blade.php</a>


#
> Alvaro Torres F.
> Telegram: https://t.me/AquaroTorres
> Instagram: @AquaroTorres