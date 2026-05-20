<?php
    // Definir la constante para que config.php nos permita entrar
    define('ACCESO', true);
    //Extracción de inventario y conteo gerencial. 
    include 'includes/config.php';
    //Select mejorado con los metadatos que necesitamos.
    $query = "SELECT nombre_prod, stock, precio FROM productos ORDER BY nombre_prod ASC;";//El * extrae todos los campos de las tablas 
    $resultado = pg_query($db_conn,$query);
    if(!$resultado){
        die("Error critico en la consulta SQL" . pg_last_error($db_conn));
        //echo "No funciona";
    } 
    echo "Ya funciona";
    //Validación de existencia fisica 
    $total_filas = pg_num_rows($resultado);
    if($total_filas == 0){
        echo "<h3>El inventario se encuentra vacio actualmente</h3>";
    }else{
        echo "<h3>Control de calidad. Se encontraron " . $total_filas . "productos activos en el sistema.</h3>";
    }
    pg_close($db_conn);

?>