<?php 
    //Configuración de conexión de Melody Flowers
    $host = "localhost"; //Servidor local
    $port = "5432"; //Puerto que usará Postgres
    $db_name = "db_inventario_empresa";
    $user = "postgres";
    $password = "Roalex1122";

    //Cadena de conexión
    $cadenaConexion = "host=$host port=$port dbname=$db_name user=$user password=$password";
    
    //Proceso de conexión activa
    $db_conn = @pg_connect($cadenaConexion);

    //Comprobar conexión.
    $modo = "prod"; //Modo de producción

    if(!$db_conn){ 
        if($modo == "dev"){
           die("Fallo: " . preg_last_error()); 
        }else{
        die("Sistema en mantenimiento temporal");
        }
       
    }
        else{//echo "Conexión exitosa a la BD";
    }

    // Si la constante ACCESO no existe, detiene la ejecución
if (!defined('ACCESO')) {
    exit('Acceso denegado');
}
    
  
?>