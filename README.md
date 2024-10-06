# Sistema Web: inventario de alimentos
**Francisco Fernández, Diego González, Xabier Unzilla y Abdessamad El Horbouli**

*Sistemas de Gestión de Seguridad de Sistemas de Información*

*Grado en Ingeniería Informática de Gestión y Sistemas de Información*

*[UPV-EHU](https://www.ehu.eus/es/) / Curso 2024-25*

## Introducción
Basándonos en un **stack Linux + Apache + MariaDB (MySQL) + PHP 7.2** en Docker Compose con mod_rewrite habilitado por defecto, este Sistema Web propone la gestión de un **inventario de alimentos** con registro de usuarios. Será posible ver el listado almacenado de alimentos con la fecha de caducidad de cada uno de ellos (así como una vista ampliada de todos los campos), editarlos, eliminarlos o añadir uno nuevo. Por otro lado, existe la opción de registrarse e iniciar sesión, ver los detalles del perfil de un usuario y modificar la información.

## Inicialización

> [!WARNING]
> Este proyecto se basa en Docker Compose, por lo que se asume que de forma previa el usuario ha realizado [la instalación de Docker](https://docs.docker.com/get-started/get-docker/) en su equipo de forma previa y que ha creado un contenedor asociado al proyecto.

**Lo primero que se deberá hacer es [clonar el repositorio](https://docs.github.com/en/repositories/creating-and-managing-repositories/cloning-a-repository)**. Se recomienda realizarlo mediante SSH. **Accediendo a la ruta pricipal** con el comando ```cd <<ruta_descarga>>/docker-lamp```, será posible ejecutarlo con el siguiente comando:

```bash
$ docker-compose up -d
```

Tal y como sugiere el fichero [docker-compose.yml](docker-compose.yml), el **servidor web basado en Apache** estará disponible en el puerto **81**, mientras que la **interfaz phpMyAdmin**, que permite controlar la instancia de MariaDB asociada, puede encontrarse en el puerto **8890**. Por ello, accediendo a ```localhost:81``` con un navegador web, se podrá ver el proyecto.

### Volcado de información de la base de datos

Tal y como se explica con mayor detalle en [las instrucciones de uso y documentación](#instrucciones-de-uso-y-documentaci%C3%B3n), la primera vez que se instancia el proyecto es necesario i**mportar el volcado de la base de datos disponible en el fichero [database.sql](database.sql)**. Para ello, lo más sencillo es acceder a phpMyAdmin en ```localhost:8890``` y, situándonos en la base de datos *database*, pulsar sobre *Importar* y seleccionar el fichero ```database.sql``` descargado previamente. A continuación, el Sistema Web debería cargar correctamente accediendo a ```localhost:81```.

## Detener el contenedor

Una vez finalizado el uso del contenedor Docker, puede **detenerse su uso** ejecutando el siguiente comando:

```bash
$ docker-compose stop
```

## Instrucciones de uso y documentación

La documentación completa del proyecto junto con las funcionalidades disponibles para su uso se encuentran en el **fichero [doc.pdf](doc.pdf)** para su consulta en cualquier momento.

## Créditos y agradecimientos

Este programa incluye **[Bootstrap](https://getbootstrap.com) v5.3.3**, herramienta utilizada en base a [su licencia MIT](https://github.com/twbs/bootstrap/blob/v5.3.3/LICENSE) para facilitar el diseño CSS y ofrecer algunas funcionalidades mediante JavaScript. **En la parte final de [las instrucciones de uso y documentación](#instrucciones-de-uso-y-documentaci%C3%B3n) se mencionan otros aportes de terceros** menores que han sido utilizados para el proyecto, así como agradecimientos.
