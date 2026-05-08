// 1. Expresión regular (Global)
const patronTexto = /^[A-Za-z\s]+$/;
const patronEmail = /^[a-z0-9._-]+@[a-z0-9.-]+\.[a-z]{2,6}$/;
const formulario = document.getElementById('agregar_producto');
console.log("Sistema de validación activo");
function validarFormulario() {
    // Inicializamos el contador cada vez que se intenta enviar
    let errores = 0;
    // CAPTURA DE ELEMENTOS (Referencia al input para cambiar estilos)
    const inputNombre = document.getElementById('txtNombre');
    const inputStock = document.getElementById('numStock');
    const inputFecha = document.getElementById('fecha');
    const inputPrecio = document.getElementById('precio');
    const inputEmail = document.getElementById('txtEmail');
    // CAPTURA DE VALORES
    let valorNombre = inputNombre.value.trim(); // .trim() elimina espacios vacíos al inicio/final
    let valorStock = inputStock.value;
    let valorFecha = inputFecha.value;
    let valorPrecio = inputPrecio.value;
    let valorEmail = inputEmail.value;
    //bordes cuando los input estan vacios.
    inputNombre.classList.remove('error-borde');
    inputPrecio.classList.remove('error-borde');
    inputStock.classList.remove('error-borde');
    console.log("Validando datos de: " + valorNombre);
    // --- VALIDACIÓN DE NOMBRE ---
    if (!patronTexto.test(valorNombre)) {
       // alert("Error: el nombre debe contener letras y espacios");
        Swal.fire({
            icon: 'error',
            title: '¡Cuidado!',
            text: 'El nombre de repuesto es obligatoria',
            //confirmbuttoncolor: #dd3
        });
        errores++;
        inputNombre.style.border = "2px solid red";
    } else if (valorNombre.length < 3) {
        alert("El nombre es muy corto (mínimo 3 caracteres)");
        errores++;
        inputNombre.style.border = "2px solid red";
        inputNombre.classList.add('error-borde');
    } else if (valorNombre.length > 50) {
        alert("El nombre es muy largo (máximo 50 caracteres)");
        errores++;
        inputNombre.style.border = "2px solid red";
    } else {
        //inputNombre.style.border = "2px solid green";
         Swal.fire({
            icon: 'success',
            title: '¡Exelente!',
            text: 'Producto validado',
            timer: 2000
       });   
    }
    // --- VALIDACIÓN DE STOCK ---
    if (valorStock === "" || parseInt(valorStock) <= 0) {
       // alert("La existencia debe ser un número mayor a cero");
        inputStock.classList.add('error-borde');
       Swal.fire({
            icon: 'error',
            title: '¡Stock!',
            text: 'Verifica la cantidad ingresada',
            //confirmbuttoncolor: #dd3
       });   
        errores++;
        inputStock.style.border = "2px solid red";
    } else {
        inputStock.style.border = "2px solid green";
    }
    // --- VALIDACIÓN DE FECHA ---
    if (valorFecha === "") {
        alert("Por favor, seleccione una fecha");
        errores++;
    }
    // --- VALIDACIÓN DE PRECIO ---
    let precioNum = parseFloat(valorPrecio);
    if (valorPrecio === "" || isNaN(precioNum) || precioNum <= 0) {
        inputPrecio.classList.add('error-borde');
        alert("El precio debe ser un número mayor a cero");
        errores++;
        inputPrecio.style.border = "2px solid red";
    } else if (precioNum > 1000) {
        alert("Precio fuera de rango (máximo 1000)");
        errores++;
        inputPrecio.style.border = "2px solid red";
    } else {
        inputPrecio.style.border = "2px solid green";
    }
    //Validamos el correo electrónico
    if (!patronEmail.test(valorEmail)) {
         alert("Error: el email debe llevar el formato adecuado");
        errores++;
        inputEmail.style.border = "2px solid red";
    }else if(valorEmail === ""){
        alert("Por favor, debe especificar un correo");
    }
    // Retornamos true si no hay errores, false si hay al menos uno
    return errores === 0;
}
// 2. ESCUCHADOR DE EVENTO
formulario.addEventListener('submit', function(e) {
    // Si la validación falla (retorna false)
    if (!validarFormulario()) {
        e.preventDefault(); // Detiene el envío a registro.php
        console.log("Envío cancelado: hay errores en el formulario");
    } else {
        console.log("Todo correcto. Enviando datos...");
        // El formulario se enviará normalmente a registro.php
    }
});