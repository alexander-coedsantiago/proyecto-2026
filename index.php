<?php 
  $alerta = isset($_GET ['status'])?$_GET['status']: "";
  $umbral_critico = 5; //umbral de stock minimo de producto
?>
<!--Encabezado dinámico -->
<?php include 'consultas.php'; ?>
<?php include 'includes/header.php'; ?>
  <main>
    <section>
      <h2>Bienvenidos a Reparación de Carros</h2>
        <p>Bienvenidos</p>
    </section>
  </main>
  <!--Formulario de registro de productos-->
  <form id="agregar_producto" border="1" action="registro.php" method="post">
    <input type="hidden" id = "estado_php" value= "<?php echo $alerta; ?>">
    <label for="txtNombre">Nombre:</label>
    <input type="text" id="txtNombre" name="txtNombre"><br><br>
    <label for="numStock">Cantidad:</label>
    <input type="number" id="numStock" name="numStock"><br><br>
    <label for="selCat">Categoría:</label>
    <select name="categoria_prod" id="selCat">
        <option value="3">Motor</option>
        <option value="4">Interior</option>
        <option value="5">Exterior</option>
    </select><br><br>
    <label for="precio">Precio Unitario:</label>
    <input type="text" id="precio" name="precio"><br><br>
    <button class="Guardar-Inventario" type="submit">Guardar en Inventario</button>
    <button class="limpiar" type="reset">Limpiar</button>
    
  </form>
  <!--Tabla de productos en stock-->
  <div class="tabla-responsiva">
    <table id="mitabla" class = "mitabla" border="1"> 
      <thead>  
        <th>Producto</th>
        <th>Cantidad</th>
        <th>precio</th>
        <th>Opciones</th>
        <th>Imagen</th>
      </thead>
    <tbody id="tablaInventario">
      <?php 
        //Inicio del bucle para renderizado dinamico de inventario.
        while ($producto = pg_fetch_assoc($resultado)){

        
      ?>
      <tr>
        <td><?php echo $producto['nombre_prod']; ?></td>
        <td <?php 
              if($producto['stock']< $umbral_critico){
                echo 'style = "color:orange; font-weight: bold"';
              }
            ?>>
            <?php 
              echo $producto['stock'];
            ?>
        </td>
        
        <td><?php $precio_formateado = number_format($producto['precio'],2,'.',',');
              echo "$" . $precio_formateado;
        ?>
        </td>
        <td><button class = "Guardar Inventario" style = "background-color: pink; margin-right:5px">Editar</button><button class = "Guardar Inventario" style = "background-color: pink; margin-right:5px">Eliminar</button></td>
        <td>
          <?php 
            //comprobamos que la foto exixta o sea nula
            if(!empty($producto['foto'])){
              //1. postgres envia los datos bytea, hay que desencriptarilos
              $imagen_binaria = pg_unescape_bytea($producto['foto']);
              //2. convertimos esos datos a base64
              $imagen_base64 = base64_encode($imagen_binaria);
              //3. Imprimimos la imagen usando "data URI
              //nota: asumo que son imagenes JPEG. si son PNG cambia 
              //'Image/jpeg´ a 'image/png'
              echo '<img src = "data:image/jpeg;base64,' . $imagen_base64 . '"
              alt ="producto"width="80" height="80" style="object-fit:cover;
              border_redius:5px;">';
            }else{
              echo '<span style ="color: pink; font-size: 12px;">sin imagen</span>';
            }
          ?>
        </td>
      </tr>
      <?php 
        }
      ?>
       
    </tbody>
    </table>
  </div>
  <div class="contenedor-resumen">
    <p>Resumen de productos</p>
    <div class="tarjeta">
      <p>Productos</p>
    </div>
    <div class="tarjeta">
      <p>Ventas</p>
    </div>
    <div class="tarjeta">
      <p>Usuarios</p>
    </div>
  </div>
  <script src="js/validar.js"></script>
  <script>
      const status = document.getElementById('estado_php').value;
      if(status === 'success'){
        Swal.fire({
          title: '¡Operación exitosa!',
          text: 'El inventario ha sido actualizado',
          icon: 'success',
          confirmButtonText: 'Aceptar'
        });
      }
      if(status === 'error'){
        Swal.fire({
          title: '¡Error de guardado!',
          text: 'Hubo un error al procesar los datos',
          icon: 'error',
          confirmButtonText: 'Aceptar'
        });
      }
      if(status){
        window.history.replaceState({}, document.title, window.location.pathname);
      }
  </script>
<!--Pie de página dinámico -->
  <?php include 'includes/footer.php';?>