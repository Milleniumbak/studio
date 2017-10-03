<?php

return [
    'adminEmail' => 'limbertx@hotmail.com',
    'usrCliente' => 2, // por el momento aqui configuramos el id del cliente
    'usrFotografo' => 1, // aqui colocamos el id del fotografo id
    'uploadFaces'   => '/upload/faces/',
    'uploadEvents'   => '/upload/events/',
    'imgWatermark'   => '/upload/watermark.png', // es la imagen con marca de agua
    'SERV_IO_HOST' => 'localhost',
    'SERV_IO_PORT' => "8080"
];

/** DATOS INICIALES PARA EL TIPO DE USUARIO
  INSERT INTO public.stipousuario(codigo, descripcion) VALUES ('001', 'FOTOGRAFO');
  INSERT INTO public.stipousuario(codigo, descripcion) VALUES ('002', 'CLIENTE');

*/
