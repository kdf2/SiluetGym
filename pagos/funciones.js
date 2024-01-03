//buscar miembro
$('#telefono_miembro').keyup(function (e) {
    e.preventDefault();

    var tcliente = $(this).val();
    var action = 'infomiembro';

    $.ajax({
        url: 'ajax.php',
        type: "POST",
        data: { action: action, tcliente: tcliente },
        success: function (response) {
            // console.log(response);
            if (response == 0) {
                $('#idmiembro').val('');
                $('#nombre_miembro').val('');
                $('#membresia_miembro').val('');
                $('#txt_cantidad_meses').val('0');
                $('#fecha_inicio').val('');
                $('#fechavencimiento').val('');
                $('#total_meses').val('0');
                $('#txt_cantidad_meses').attr('disabled', 'disabled');
                $('#total_meses').attr('disabled', 'disabled');

            }
            else {
                var data = JSON.parse(response);
                var concatenar = data.nombremembresia + ' - ' + data.precio;
                $('#idmiembro').val(data.idmiembro);
                $('#nombre_miembro').val(data.personanombre);
                $('#membresia_miembro').val(concatenar);
                $('#fecha_inicio').val(data.fechaincio);
                $('#fechavencimiento').val(data.fechapago);
                $('#precio').val(data.precio);
                $('#txt_cantidad_meses').val('0');
                $('#txt_cantidad_meses').removeAttr('disabled');
                $('#txt_cantidad_meses').val('');
                $('#total_meses').val('');



                $('#idmiembro').attr('disabled', 'disabled');
                $('#nombre_miembro').attr('disabled', 'disabled');
                $('#membresia_miembro').attr('disabled', 'disabled');

            }


        },
        error: function (error) {

        }

    });
});

//calcular total y mes final

$('#txt_cantidad_meses').keyup(function (e) {
    e.preventDefault();
    var precio_total = $(this).val() * $('#precio').val();
    $('#total_meses').val(precio_total);
    // Obtener la fecha inicial desde el campo de entrada
    var fechaInicial = new Date(document.getElementById('fechavencimiento').value);
    // Obtener el número de meses a sumar
    var numeroMeses = parseInt(document.getElementById('txt_cantidad_meses').value, 10);

    // Validar que se haya ingresado una fecha válida
    if (!isNaN(fechaInicial.getTime())) {
        // Clonar la fecha inicial para no modificar la original
        var fechaResultado = new Date(fechaInicial);

        // Sumar el número de meses
        fechaResultado.setMonth(fechaResultado.getMonth() + numeroMeses);

        // Formatear la fecha y mostrar el resultado
        var resultadoFormato = fechaResultado.toISOString().split('T')[0];
        //console.log("Nueva Fecha: " + resultadoFormato);
        $('#fechavencimiento').val(resultadoFormato)
    }
    if ($(this).val() < 1 || isNaN($(this).val())) {

        $('#btn-facturar-mensualidad').slideUp();
        $('#btn_anular_mensualidad').slideUp();
        $('#btn-pdf').slideUp();
    }
    else {
        $('#btn-facturar-mensualidad').slideDown();
        $('#btn_anular_mensualidad').slideDown();
        

    }
});



//agregar producto fantasma
$('#btn-facturar-mensualidad').click(function (e) {
    e.preventDefault();
    $('#btn-pdf').slideDown();
    console.log('hola');
    if ($('#txt_cantidad_meses').val() > 0) {
        console.log('si entre');
        var codmiembro = $('#idmiembro').val();
        var cantidad = $('#txt_cantidad_meses').val();
        var total = $('#total_meses').val();
        var fecha = $('#fechavencimiento').val();
        var action = 'addpago';
        $.ajax({
            url: 'ajax.php',
            type: "POST",
            async: true,
            data: { action: action,codmiembro: codmiembro, cantidad: cantidad, total: total, fecha:fecha },
            success: function (response) {
                console.log(response);
                if (response != 'error') {
                    swal("Pago registrado","correctamente", "success");
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


$('#btn-pdf').click(function (e) {
    var url = 'generarpdf.php';
    window.open(url, '_blank');
    location.reload();
});
function refrezcar(){
    location.reload();
};


