<?php

return [
    'adminEmail' => 'limbertx@hotmail.com',
    'usrCliente' => 4, // por el momento aqui configuramos el id del cliente
    'usrFotografo' => 2, // aqui colocamos el id del fotografo
    'imgWatermark'   => '/upload/watermark.png', // es la imagen con marca de agua

    'SERV_IO_HOST' => 'nodjsstudio.herokuapp.com',  
    'SERV_IO_PORT' => "", // local 8080

    "PATH_CREDENCIALES" => "/credenciales/credenciales.json",
    "ACCOUNT_SERVICE" => "studio-web-login@studio-37248.iam.gserviceaccount.com",

];

/** DATOS INICIALES PARA EL TIPO DE USUARIO

    cuando ingresemos estos datos tenemos que configurar el id de fotografo y cliente
    
    INSERT INTO public.stipousuario(codigo, descripcion) VALUES ('001', 'FOTOGRAFO');
    INSERT INTO public.stipousuario(codigo, descripcion) VALUES ('002', 'CLIENTE');


    configuracion de heroku
    
    https://stackoverflow.com/questions/33160064/yii2-app-not-displaying-on-heroku-domain

*/

