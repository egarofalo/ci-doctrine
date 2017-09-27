<h1>CI Doctrine</h1>
Librería de CodeIgniter 3 para utilizar Doctrine como ORM.

<h2>Requisitos</h2>
CI Doctrine necesita PHP >= 7.0.8 y CodeIgniter 3.x para poder ser ejecutado.

<h2>Instalación</h2>
Instale Composer en su equipo y luego ejecute el comando <code>composer require co-developers/ci-doctrine</code> dentro de la raíz de su proyecto en CodeIgniter.

<h2>Configuración manual de la librería</h2>
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
Antes de comenzar a utilizar la consola de Doctrine, copie el archivo <code>application/libraries/doctrine/cli-config.php</code> en la raíz de su proyecto en CodeIginiter 3, o sea, al mismo nivel del controlador frontal <code>index.php</code> y de la carpeta <code>vendor</code> de Composer. Luego verifique, en el mismo archivo, que las constantes <code>BASEPATH</code> y <code>APPPATH</code> sean correctas. Una vez realizado este paso, ya puede ejecutar la consola de Doctrine desde la línea de comandos para crear entidades, crear repositorios, crear las tablas en la base de datos a partir de los metadatos, etc.
Para ver la lista de comandos disponibles ejecute desde la shell <code>$ php vendor/bin/doctrine</code> en linux o <code>vendor\bin\doctrine</code> en Windows, desde la raíz de su proyecto en ambos casos.

# Metadatos de las entidades
CI Doctrine utiliza anotaciones para especificar los metadatos de las entidad, ya que es la forma recomendada actualmente por Symfony. Por lo tanto ingrese los metadatos en los archivos de las entidades a través de las anotaciones.

# Carga automática de la libreria
Antes de agregar CI Doctrine al array de carga automática de librerías, abra el archivo <code>application/config.php</code> e indique la ruta del archivo <code>autoload.php</code> de Composer en el array <code>$config</code> de la siguiente manera: <code>$config['composer_autoload'] = 'vendor/autoload.php';</code>.
Para cargar la librería automaticamente, abra el archivo <code>application/config/autoload.php</code> y agregue el string <code>'doctrine'</code> al array <code>$autoload['libraries']</code>. Recuerde, en caso de que se cargue automaticamente, desactivar la librería Database de CodeIgniter.

# Utilizar la clase MY_Controller (opcional)
Si usted lo desea, puede utilizar la clase MY_Controller declarada en el archivo <code>application/libraries/doctrine/MY_Controller.php</code> como clase controladora base en CodeIgniter. Si extendemos todos nuestros controladores de MY_Controller tenemos disponibles la instancia al EntityManager en el atributo <code>$this->em</code> dentro de cada controlador. Para comenzar a utilizar esta extensión del controlador del core debemos copiar el archivo <code>application/libraries/doctrine/MY_Controller.php</code> en la carpeta <code>application/core</code>.
