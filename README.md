# Doctrigniter
Librería de CodeIgniter 3 para utilizar Doctrine como ORM.

# Requisitos
Doctrigniter necesita PHP >= 7.0.8 y CodeIgniter 3.x para poder ser ejecutado.

# Instalación
Instale Composer en su equipo y luego ejecute el comando <code>composer require co-developers/doctrigniter</code> dentro de la raíz de su proyecto en CodeIgniter. Luego siga los pasos de las siguientes secciones respetando el orden:
- <strong>El archivo <code>database.yml</code>
- <strong>Carga automática de la librería</strong>
- <strong>Creando entidades y repositorios</strong>.

# El archivo <code>database.yml</code>
El archivo <code>application/libraries/doctrigniter/database.yml</code> contiene la configuración de la conexión a la base de datos que utiliza Doctrine para acceder a la misma. Antes de comenzar a utilizar Doctrigniter debe copiar éste archivo en la carpeta <code>application/config</code>.
Dentro del yml, la clave <code>active_group</code> le indica a Doctrine que grupo de parámetros utilizar para acceder a la base de datos (<code>development</code>, <code>testing</code> o <code>production</code>).

# Carga automática de la libreria
Para cargar la librería automaticamente, abra el archivo <code>application/config/autoload.php</code> y agregue la libreria al array <code>$autoload['libraries']</code>. Recuerde, en caso de que se cargue automaticamente, desactivar la librería Database de CodeIgniter.

# Creando entidades y repositorios
Antes de comenzar a crear entidades se deben crear las siguientes carpetas:
- <code>application/ORM/Entity</code>: En esta carpeta se crean las entidades.
- <code>application/ORM/Repository</code>: En esta carpeta se generan los repositorios de cada entidad.
- <code>application/ORM/Proxy</code>: En esta carpeta se generan las clases Proxy de cada entidad.
Una vez que se generaron dichas carpetas, se puede comenzar a crear las entidades y los repositorios de forma manual. La clases Proxy se generan de forma automática por carga diferida (Lazy Loading).

# Metadatos de las entidades
Doctrigniter utiliza anotaciones para especificar los metadatos de las entidad, ya que es la forma recomendada actualmente por Symfony. Por lo tanto ingrese los metadatos en los archivos de las entidades a través de las anotaciones.

# Utilizando Doctrine Console
Antes de comenzar a utilizar la consola de Doctrine, copie el archivo <code>application/libraries/doctrigniter/cli-config.php</code> en la raíz de su proyecto en CodeIginiter 3, o sea, al mismo nivel de la carpeta <code>vendor</code> de Composer. Una vez realizado este paso, ya puede ejecutar la consola de Doctrine desde la línea de comandos para crear entidades, crear repositorios, crear las tablas en la base de datosa partir de los metadatos, etc.
Para ver la lista de comandos disponibles ejecute desde la shell ejecute <code>$ php vendor/bin/doctrine</code> en linux o <code>vendor\bin\doctrine</code> en Windows, desde la raíz de su proyecto en ambos casos.