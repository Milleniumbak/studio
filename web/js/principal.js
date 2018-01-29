function sendMessageAll(){

    if(($('#tituloid').val().length <= 0) || ($('#messageid').val().length <= 0)){
        alert("Titulo o Mensaje no puede estar vacio!!");
        return;
    }


    $.get('sendmessageall', 
        { 
            'titulo' : $('#tituloid').val(), 
            'cuerpo' : $('#messageid').val()
        },
        function(data){
            var response = data;       

            if(response == null){
                response = "";
            }else{
                console.log("response : " + response);
            }
        }
    );
}
