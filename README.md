# Doctrigniter
Librería de CodeIgniter 3 para utilizar Doctrine como ORM.

# Requisitos
Twigniter necesita PHP >= 5.5.9|7.0.8 y CodeIgniter 3.x para poder ser ejecutado.

# Instalación
Instale Composer en su equipo y luego ejecute el comando <code>composer require co-developers/doctrigniter</code> dentro de la raíz de su proyecto en CodeIgniter.

# Carga automática de la libreria
Para cargar la librería automaticamente, abra el archivo <code>application/config/autoload.php</code> y agregue la libreria al array <code>$autoload['libraries']</code>. Recuerde, en caso de que se cargue automaticamente, desactivar la librería Database de CodeIgniter.



# Comenzando a desarrollar con Doctrigniter
- Para comenzar a utilizar Twigniter en cualquier método de un controlador debe agregar la librería al array <code>$autoload['libraries']</code> o cargarla de forma manual en el constructor del controlador o en una acción del mismo justo antes de utilizarla. Para cargar la librería de forma manual se debe ejecutar <code>$this->load->library('twigniter')</code> (se recomienda utilizar la carga automática).
- Para enviar una vista al navegador se debe ejecutar <code>$this->twigniter->display('archivo', $params)</code> donde el parametro <code>'archivo'</code> es un archivo con extension <code>twig</code> ubicado en la carpeta <code>application/views</code> y el parametro <code>$params</code> es un array con pares <code>'clave' => valor</code> donde <code>clave</code> es el nombre de la variable disponible a utilizar en el archivo twig y <code>valor</code> es el valor de dicha variable.
- Para obtener el resultado de una vista en twig y guardarlo en una variable y hacer con ello lo que deseen se debe ejecutar el método <code>$this->twigniter->render('archivo', $params)</code>. Los parámetros son los mismos que los del método <code>display()</code>.

# Extendiendo Twig
- Para agregar funciones a Twig y que estén disponibles para utilizar en todos los templates se debe ejecutar <code>$this->twigniter->addFunction($name, $function)</code> donde el parámetro <code>$name</code> es el nombre de la función en Twig, y <code>$function</code> puede ser el nombre de una función nativa de PHP, el de un helper de CodeIgniter cargado previamente, o una función anónima.
- Para agregar una variable global en Twig se debe ejecutar <code>$this->twigniter->addGlobal($name, $value)</code> donde <code>$name</code> es el nombre de la variable en Twig y <code>$value</code> es el valor de dicha variable.
- Se recomienda extender Twig a través del hook <code>post_controller_constructor</code> para que las funciones y/o variables agregadas estén disponibles en todos los métodos de los controladores de su aplicación. Si desea extender Twig en un controlador específico, se recomienda hacerlo en el constructor de dicho controlador. Recuerde que para extender Twig a través del hook debe configurar la carga automática de la libreria.

# Modo desarrollo y producción
Twigniter utiliza la variable <code>ENVIRONMENT</code> de CodeIgniter para configurar Twig de la forma más óptima dependiendo del entorno en que se esté ejecutando.
