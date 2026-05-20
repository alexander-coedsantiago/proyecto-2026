<?php 
  $alerta = isset($_GET ['status'])?$_GET['status']: "";
?>
<!--Encabezado dinámico -->
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
        <option value="1">Motor</option>
        <option value="2">Interior</option>
        <option value="3">Exterior</option>
    </select><br><br>
    <label for="precio">Precio Unitario:</label>
    <input type="text" id="precio" name="precio"><br><br>
    <button class="Guardar-Inventario" type="submit">Guardar en Inventario</button>
    <button class="limpiar" type="reset">Limpiar</button>
    
  </form>
  <!--Tabla de productos en stock-->
  <div class="tabla-responsiva">
    <table id="mitabla" border="1"> 
      <thead>
        <th class="columna-eliminada">Número</th>  
        <th>Producto</th>
        <th>Categoría</th>
        <th>Cantidad</th>
        <th></th>
        <th></th>
        <th>Imagen</th>
    </thead>
    <tbody id="tablaInventario">
      <tr>
          <td class="columna-eliminada">1</td>
          <td>Arreglo de flores Herberas</td>
          <td>Ramo</td>
          <td>50</td>
          <td><button>Editar</button></td>
          <td><button>Eliminar</button></td>
          <td><img src="assets/img/Herberas.jpg" alt="Imagen del producto" width="100" height="100"></td>
        </tr>
       
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