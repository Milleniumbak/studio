// es la funcion que se ejecutara cuando hay cambio
// en el tipo de compra
function modificarControles(value){
    valor = $(value).find('input:checked').val()
    if(valor==1){ // formato digital
        $('#scompraimpresa-fktipopapel').attr('disabled', 'disabled');
        $('#scompraimpresa-fkdimension').attr('disabled', 'disabled');

        $('#scompraimpresa-cantidad').val('1');
        $('#scompraimpresa-cantidad').attr('disabled', 'disabled');

        $('#scompraimpresa-precio').val($('#sprecioxfoto1').val());
    }else{
        if(valor == 2){ // formato impreso
            $('#scompraimpresa-fktipopapel').removeAttr('disabled');
            $('#scompraimpresa-fkdimension').removeAttr('disabled');
            $('#scompraimpresa-cantidad').val("1");
            $('#scompraimpresa-cantidad').removeAttr('disabled');
            $('#scompraimpresa-precio').val($('#sprecioxfoto1').val());
        }
    }
}
/**
 * Calcula el precio total en base a la cantidad de fotos que hara
 */
function calcularprecio(cantidad){
    precioUnitario = $('#sprecioxfoto1').val();
    $('#scompraimpresa-precio').val(cantidad * precioUnitario);
}
