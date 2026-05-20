<?php 
    if($_POST){
       // define('ACCESO', true);
       // Definir la constante para que config.php nos permita entrar
        define('ACCESO', true);
        include 'includes/config.php';
        //Receptor de datos - Melody Flowers
        $nombre = trim($_POST['txtNombre']);
        $nombre = strip_tags($_POST['txtNombre']);
        $stock =  filter_var($_POST['numStock'], FILTER_SANITIZE_NUMBER_INT);      ;
        $precio = filter_var( $_POST['precio'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $fecha = date("Y-m-d");
        $categoria = $_POST['selCat'];
        //Paso 1: Buscar si el producto ya existe en la BD.
        $sql_buscar = "SELECT stock FROM productos WHERE nombre_prod = '$nombre';";
        $res_buscar = pg_query($db_conn, $sql_buscar);
        $existe = pg_num_rows($res_buscar);
        if($existe > 0){
            //  El producto existe, preparamos la "suma".
            $fila = pg_fetch_assoc($res_buscar);
            $stock_actual = $fila['stock'];
            $nuevo_total = $stock_actual + $stock;
            $query = "UPDATE productos SET stock = $nuevo_total WHERE nombre_prod = '$nombre';";
        }else{
            //El producto es nuevo, preparamos la inserción
            $query = "INSERT INTO productos (nombre_prod, stock, precio, fecha_ingreso, id_categoria) VALUES ('$nombre', $stock, $precio, '$fecha', $categoria);";
        }
        $resultado = pg_query($db_conn, $query);
        if($resultado){
            //echo "Operación realizada con éxito" .pg_last_error($db_conn);
            header("Location: index.php?status=success");
            exit();
        }else{
            //echo "Error en la actualización o inserción";
            pg_close($db_conn);
            header("Location: index.php?status=error");
            exit();
        }
    }
?>