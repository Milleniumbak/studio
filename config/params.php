<?php

return [
    'adminEmail' => 'limbertx@hotmail.com',
    'usrCliente' => 4, // por el momento aqui configuramos el id del cliente
    'usrFotografo' => 2, // aqui colocamos el id del fotografo
    'imgWatermark'   => '/upload/watermark.png', // es la imagen con marca de agua

    //'SERV_IO_HOST' => '127.0.0.1',
    //'SERV_IO_PORT' => "8080", // en heroku es sin puerto
    'SERV_IO_HOST' => 'nodjsstudio.herokuapp.com',
    'SERV_IO_PORT' => "", // en heroku es sin puerto

    
    "PATH_CREDENCIALES" => "/credenciales/credenciales.json",
    "ACCOUNT_SERVICE" => "studio-web-login@studio-37248.iam.gserviceaccount.com",

];

/** DATOS INICIALES PARA EL TIPO DE USUARIO
    configuracion de heroku
    
    https://stackoverflow.com/questions/33160064/yii2-app-not-displaying-on-heroku-domain

*/

