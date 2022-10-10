# Implementación de Clave Única del estado de Chile con PHP y Laravel 8

Clave única funciona con oAuth2 que en terminos simples el flujo es el siguiente:

## Un poco de pseudo código

```php
# Paso 1, ruta https://miweb.cl/claveunica
# Confeccionas una URL con tus datos de cliente y redireccionas tu aplicación hacia esa URL que es de clave única.
function autenticar()
{
    // las urls son de ejemplo, para que se entienda la idea, las reales están más abajo o en el código.
    $url = https://claveunica.cl/cliente=123123&otros_parametros=12312
    redirect $url;
}

# Paso 2, ruta https://miweb.cl/claveunica/callback
# El usuario se autentifica en la plataforma de CU (clave única) y luego es redireccionado a una URL de tu sitio, 
# esta url es llamada Callback (de autentificación) y recibe un token, con ese token puedes a consultar 
# que usuario es el que se logeo (run y nombre) con esos datos ya entra en la lógica de tu sistema, 
# ejemplo: iniciar sesion en tu sistema o guardar el usuario o rechazarlo, etc.
function callback($token)
{
    $usuario = http::get($url_para_obtener_el_usuaro_de_cu_en_base_a_un_token, $token);
    // Listoco, autentificar localmente, guardar, rechazar, etc
    $usuario->login();
    ...
}

# Paso 3, ruta https://miweb.cl/claveunica/logout
# El último paso es cerrar sesión, funciona igual que el login, redireccionas tu aplicación a una URL de CU, 
# se cierra la sesión de CU y te devuelve a una URL de tu aplicación Callback (de cierre de sessión).
function logoutCu()
{
    $url = https://claveunica.cl/logout?parametros=123213&direcccion_callback_logout=https://miweb.cl/logout
    redirect $url;
}

# Paso 4, ruta https://miweb.cl/logout
# La URL callback se ejecuta y debe realizar la lógica de cierre de tu sistema, 
# ejemplo: cerrar sesión, borrar cookies, regenerar token, etc.
function logoutLocal()
{
    // cierre de sessión local
    $current_user_logged->logout();
    // Siempre regenerar el token de nuestro sistema 
    // por si es necesario autenticar otro usuario ya no podemos reutilziar el anterior.
    $token->regenerate();
    
}
```


## Solicitar las credenciales de sandbox a clave única, ingresando las siguiente URL
* Url Principal (donde estará el botón clave única, no tiene relevancia dentro del proceso): https://miweb.cl
## URL Callback para la autentificación
* Url Callback autentificación producción (donde se redirecciona una vez autentificado): https://miweb.cl/claveunica/callback
* Url Callback autentificación sandbox (puedes utilizar la misma de arriba): https://miweb.cl/claveunica/callback
## URL Callback para el logout (nota, no utilizo /claveunica/logout, sino que directo /logout)
* Url Callback logout producción (donde se redirecciona una vez cerrada la sesión de CU): https://miweb.cl/logout
* Url Callback logout sandbox (puede ser la misma de arriba): https://miweb.cl/logout

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
* Iniciar servidor web o bien a través del comando `php artisan serve`
* Abrir el navegador en la URI del proyecto.

   

## Archivos con la implementación

* Archivo con las rutas: <a  href="https://github.com/cl-ssi/claveunica/blob/main/routes/web.php">web.php</a>
* Controlador: <a  href="https://github.com/cl-ssi/claveunica/blob/main/app/Http/Controllers/ClaveUnicaController.php">ClaveUnicaController</a>
* Vista con el boton de CU: <a  href="https://github.com/cl-ssi/claveunica/blob/main/resources/views/welcome.blade.php">welcome.blade.php</a>


#
> Alvaro Torres F.

> Telegram: https://t.me/AquaroTorres 

> Instagram: @AquaroTorres
