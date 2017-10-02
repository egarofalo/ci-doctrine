<h1>CI Doctrine</h1>
Librería de CodeIgniter 3 para utilizar Doctrine como ORM.

<h2>Requisitos</h2>
CI Doctrine necesita PHP >= 7.0.8 y CodeIgniter 3.x para poder ser ejecutado.

<h2>Instalación</h2>
Instale Composer en su equipo y luego ejecute el comando <code>composer require co-developers/ci-doctrine v1.0.0-alpha.4</code> dentro de la raíz de su proyecto en CodeIgniter.

<h2>Configuración manual de la librería</h2>

<h3>Activar Composer en CodeIgniter</h3>
Para activar Composer en CodeIgniter abra el archivo <code>application/config.php</code> e indique la ruta del archivo <code>autoload.php</code> de Composer en el array <code>$config</code> de la siguiente manera: <code>$config['composer_autoload'] = 'vendor/autoload.php';</code>.

<h3>Copiar el archivo <code>database.yml</code></h3>
El archivo <code>application/libraries/doctrine/database.yml</code> contiene la configuración de la conexión a la base de datos que utiliza Doctrine para acceder a la misma. Antes de comenzar a utilizar CI Doctrine debe copiar éste archivo en la carpeta <code>application/config</code>.
Dentro del yml, la clave <code>active_group</code> le indica a Doctrine que grupo de parámetros utilizar para acceder a la base de datos (<code>development</code>, <code>testing</code> o <code>production</code>).

<h3>Creando la estructura de carpetas</h3>
Antes de comenzar a crear entidades se deben crear las siguientes carpetas:
<ul>
<li><code>application/ORM/Entity</code>: En esta carpeta se crean las entidades.</li>
<li><code>application/ORM/Repository</code>: En esta carpeta se generan los repositorios de cada entidad.</li>
<li><code>application/ORM/Proxy</code>: En esta carpeta se generan las clases Proxy de cada entidad.</li>
</ul>
Una vez que se generaron dichas carpetas, se puede comenzar a crear las entidades y los repositorios. La clases Proxy se generan de forma automática por carga diferida (Lazy Loading).<br>
Recuerde que antes de generar cada entidad debe especificar el <code>namespace</code> en el archivo de declaración de la clase. Lo mismo aplica para los repositorios. El <code>namespace</code> de las entidades es <code>Entity</code> y el de los repositorios es <code>Repository</code>.

<h3>Copiar y configurar <code>cli-config.php</code> (Doctrine Console)</h3>
Para poder utilizar la consola de Doctrine, copie el archivo <code>application/libraries/doctrine/cli-config.php</code> en la raíz de su proyecto en CodeIginiter 3, o sea, en el mismo directorio del controlador frontal <code>index.php</code> y de la carpeta <code>vendor</code> de Composer. Luego verifique, en el mismo archivo, que las constantes <code>BASEPATH</code> y <code>APPPATH</code> sean correctas. Una vez realizado este paso, ya puede ejecutar la consola de Doctrine desde la línea de comandos para crear entidades, crear repositorios, crear las tablas en la base de datos a partir de los metadatos, etc.
Para ver la lista de comandos disponibles ejecute desde la shell <code>$ php vendor/bin/doctrine</code> en linux o <code>vendor\bin\doctrine</code> en Windows, desde la raíz de su proyecto en ambos casos.

<h3>Copiar el archivo <code>MY_Controller.php</code> (opcional)</h3>
Si usted lo desea, puede utilizar la clase MY_Controller declarada en el archivo <code>application/libraries/doctrine/MY_Controller.php</code> como clase controladora base en CodeIgniter. Si extendemos todos nuestros controladores de MY_Controller tenemos disponibles la instancia al EntityManager en el atributo <code>$this->em</code> dentro de cada controlador. Para comenzar a utilizar esta extensión del controlador del core en primera instancia debemos activar la carga automática de la librería y luego debemos copiar el archivo <code>application/libraries/doctrine/MY_Controller.php</code> en la carpeta <code>application/core</code>.

<h3>Carga automática de la librería</h3>
Para cargar la librería automaticamente en CodeIgniter, abra el archivo <code>application/config/autoload.php</code> y agregue el string <code>'doctrine'</code> al array <code>$autoload['libraries']</code>. Recuerde, en caso de que se cargue automaticamente, desactivar la librería Database de CodeIgniter.

<h2>Configuración automática de la librería</h2>

<h3>Copiar el archivo <code>Doctrine_cli.php</code> a la carpeta <code>controllers</code></h3>
Copie el archivo <code>application/libraries/doctrine/Doctrine_cli.php</code> a la carpeta <code>controllers</code> de CodeIgniter. Este archivo es un controlador de CodeIgniter que solo se ejecuta por CLI, y que dispone de un metodo <code>setup</code> para configurar automaticamente la librería y otros métodos sencillos para utilizar los complejos comandos de la consola de Doctrine.

<h3>Ejecutar la acción <code>setup</code> por CLI</h3>
Abra la terminal de su sistema operativo y dentro del directorio de la raíz del proyecto (al mismo nivel de la carpeta vendor y del controlador frontal <code>index.php</code>) ejecutar <code>php doctrine_cli/setup</code>. Una vez finalizada la ejecución de la acción se mostrará en pantalla los resultados de la misma. Si se produce algún error en la instalación, se le informará del mismo.

<h3>Comandos de Doctrine CLI</h3>
El controlador <code>Doctrine_cli.php</code> dispone de las siguientes acciones:
<ul>
<li><code>doctrine_cli/generate_entities</code>: Genera las entidades a partir de los metadatos. Recuerde que antes de ejecutar este comando, debe generar las entidades sólo con sus atributos y metadatos en formato de anotaciones en la carpeta <code>application/ORM/Entity</code>. Los métodos <code>getters</code> y <code>setters</code> se generan automáticamente por dicho comando.</li>
<li><code>doctrine_cli/generate_proxies</code>: Genera las clases Proxy a partir de las entidades en la carpeta <code>application/ORM/Proxy</code>.</li>
<li><code>dontrine_cli/generate_repositories</code>: Genera los repositorios a partir de los metadatos de las entidades. Se generan en la carpeta <code>application/ORM/Repository</code>.</li>
<li><code>doctrine_cli/create_schema</code>: Genera toda la estructura de la base de datos a partir de los metadatos de las entidades.</li>
<li><code>doctrine_cli/update_schema</code>: Actualiza la estructura de la base de datos a partir de los metadatos de las entidades. Se recomienda usar el parámetro <code>--force</code>.</li>
</ul>

<h3>Carga automática de la librería</h3>
Una vez terminada la instalación automática abra el archivo <code>application/config/autoload.php</code> y agregue el string <code>'doctrine'</code> al array <code>$autoload['libraries']</code>. Recuerde, en caso de que se cargue automaticamente, desactivar la librería Database de CodeIgniter.

<h2>Metadatos de las entidades</h2>
CI Doctrine utiliza anotaciones para especificar los metadatos de las entidades, ya que es la forma recomendada actualmente por Symfony. Por lo tanto ingrese los metadatos en los archivos de las entidades a través de las anotaciones.