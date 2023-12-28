

//buscar cliente


$('#telefono_cliente').keyup(function (e) {
    e.preventDefault();

    var cl = $(this).val();
    var action = 'searCliente';

    $.ajax({
        url: 'ajax.php',
        type: "POST",
        data: { action: action, cliente: cl },
        success: function (response) {
            console.log(response);
            if (response == 0) {
                $('#idCliente').val('');
                $('#nombre_cliente').val('');
                $('#direccion_cliente').val('');
            }
            else {
                var data = JSON.parse(response);
                $('#idCliente').val(data.idpersona);
                $('#nombre_cliente').val(data.nombre);
                $('#direccion_cliente').val(data.direccion);


                $('#idCliente').attr('disabled', 'disabled');
                $('#nombre_cliente').attr('disabled', 'disabled');
                $('#direccion_cliente').attr('disabled', 'disabled');
            }


        },
        error: function (error) {

        }

    });
});


//buscar producto
$('#text_codigo_producto').keyup(function (e) {
    e.preventDefault();

    var producto = $(this).val();
    var action = 'infoproducto';

    $.ajax({
        url: 'ajax.php',
        type: "POST",
        async: true,
        data: { action: action, producto: producto },
        success: function (response) {
            //  console.log(response);

            if (response == 0) {
                $('#text_nombre').html('-');
                $('#text_existencia').html('-');
                $('#text_marca').html('-');
                $('#text_precio').html('0.00');
                $('#text_precio_total').html('0.00');
                $('#txt_cantidad_producto').val('0');
                $('#txt_cantidad_producto').attr('disabled', 'disabled');
                $('#add_producto_venta').slideUp();

            }
            else {
                var data = JSON.parse(response);
                $('#text_nombre').html(data.nombre);
                $('#text_existencia').html(data.cantidad);
                $('#text_marca').html(data.marca);
                $('#text_precio').html(data.precio);
                $('#txt_cantidad_producto').val('0');
                $('#txt_cantidad_producto').removeAttr('disabled');
                $('#add_producto_venta').slideDown();
                $('#btn-facturar-venta').slideDown();
                $('#btn_anular_venta').slideDown();
                $('#text_nombre').attr('disabled', 'disabled');
                $('#text_existencia').attr('disabled', 'disabled');
                $('#text_marca').attr('disabled', 'disabled');
                $('#text_precio').attr('disabled', 'disabled');

            }



        },
        error: function (error) {

        }

    });
});

//calcular producto
$('#txt_cantidad_producto').keyup(function (e) {
    e.preventDefault();
    var precio_total = $(this).val() * $('#text_precio').html();
    var existencia = parseInt($('#text_existencia').html());
    $('#text_precio_total').html(precio_total);

    if (($(this).val() < 1 || isNaN($(this).val())) || ($(this).val() > existencia) ) {
        $('#add_producto_venta').slideUp();
    }
    else {
        $('#add_producto_venta').slideDown();
    }
});

//agregar producto fantasma
$('#add_producto_venta').click(function (e) {
    e.preventDefault();
    if ($('#txt_cantidad_producto').val() > 0) {
        var codproducto = $('#text_codigo_producto').val();
        var cantidad = $('#txt_cantidad_producto').val();
        var subtotal = $('#text_precio_total').html();
        var action = 'addProductodetalle';
        $.ajax({
            url: 'ajax.php',
            type: "POST",
            async: true,
            data: { action: action, producto: codproducto, cantidad: cantidad, subtotal: subtotal },
            success: function (response) {
                // console.log(response);
                if (response != 'error') {

                    var infor = JSON.parse(response);
                    $('#detalle_venta').html(infor.detalle);
                    $('#detalle_totales').html(infor.totales);

                    $('#text_codigo_producto').val('0');
                    $('#text_nombre').html('-');
                    $('#text_existencia').html('-');
                    $('#text_marca').html('-');
                    $('#text_precio').html('0.00');
                    $('#text_precio_total').html('0.00');
                    $('#txt_cantidad_producto').val('0');
                    $('#txt_cantidad_producto').attr('disabled', 'disabled');
                    $('#add_producto_venta').slideUp();


                }
                else {
                    console.log('nodata');
                }
            },
            error: function (error) {

            }
        });

    }
});


function del_producto_detalle(correlativo) {
    var action = 'delProductoDetalle';
    var idfan = correlativo;
    $.ajax({
        url: 'ajax.php',
        type: "POST",
        async: true,
        data: { action: action, idfan: idfan },
        success: function (response) {
            var infor = JSON.parse(response);
            $('#detalle_venta').html(infor.detalle);
            $('#detalle_totales').html(infor.totales);

            $('#text_codigo_producto').val('0');
            $('#text_nombre').html('-');
            $('#text_existencia').html('-');
            $('#text_marca').html('-');
            $('#text_precio').html('0.00');
            $('#text_precio_total').html('0.00');
            $('#txt_cantidad_producto').val('0');
            $('#txt_cantidad_producto').attr('disabled', 'disabled');
            $('#add_producto_venta').slideUp();

        },
        error: function (error) {
        }

    });

}


$('#btn_anular_venta').click(function (e) {
    e.preventDefault();
    var rows = $('#detalle_venta tr').length;

    if (rows > 0) {
        var action = 'anularventa';
        $.ajax({
            url: 'ajax.php',
            type: "POST",
            async: true,
            data: { action: action },
            success: function (response) {
                console.log(response);
                if (response != 'error') {
                    location.reload();
                }
            },
            error: function (erro) {
            }
        });
    }
    console.log('no tiene registros');
});



function enviarID() {
    // Obtener el valor del input
    var id = document.getElementById("idCliente").value;
    // Crear una instancia de XMLHttpRequest
    var url = 'generarventa.php';

    // Abre una nueva pestaña o ventana con la URL especificada
    window.open(url, '_blank');
    location.reload();
    var xhr = new XMLHttpRequest();
  
    // Configurar la solicitud AJAX
    xhr.open("POST", "generarventa.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  
    // Enviar el valor del input a PHP
    xhr.send("id=" + id);
  
    // Manejar la respuesta de PHP
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          // Hacer algo con la respuesta de PHP
          console.log(xhr.responseText);
        } else {
          // Manejar errores
          console.error("Error: " + xhr.status);
        }
      }
    };


  }