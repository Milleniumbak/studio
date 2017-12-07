<?php
require_once __DIR__ . '/vendor/autoload.php';

if (!file_exists("client_id.json")) 
exit("Client secret file not found");

$client = new Google_Client();
$client->setAuthConfig('client_id.json');
$client->addScope(Google_Service_Drive::DRIVE_FILE); // admi. los archivos solo de esta app

if (file_exists("credentials.json")) {
	$access_token = (file_get_contents("credentials.json"));
	$client->setAccessToken($access_token);
	//Refresh the token if it's expired.
	if ($client->isAccessTokenExpired()) {
		echo "Mi token ha expirado!!!!!!!!!!!!!";
		$client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());		
		file_put_contents($credentialsPath, json_encode($client->getAccessToken()));		
	}
	// id del folder events "0B2xwIp-Xlx0dQ1hBZzY5LV9heGc"
	// createDirectory($client, "02", "0B2xwIp-Xlx0dQ1hBZzY5LV9heGc");
	
	/*
	$id = searchFolder($client, "02");
	if(!is_null($id)){
		//uploadFile($client, "segundo.png", "primera imagen subida", "image/png", $id);
		uploadFileBig($client, "scrito_size1.png", "linux desktop", "image/png", $id);
	}
	*/

	listarArchivos($client);
	//descargarArchivoConBase64($client);
} else {
  $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/php-drive/oauth2callback.php';
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}
/**
	creamos el directorio de eventos sociales
  	y devolvemos el identificador de carpeta
*/
function createDirectory($client, $name_folder, $parent_id){
	$drive_service = new Google_Service_Drive($client);
	$fileMetadata = new Google_Service_Drive_DriveFile(array(
		'name' => $name_folder,
		'mimeType' => 'application/vnd.google-apps.folder',
		'parents' => array($parent_id),
		)
	);

	$file = $drive_service->files->create($fileMetadata, array(
		'fields' => 'id'));
	printf("El Folder ID para guardar en algun lugar : %s\n", $file->id);
	return $file->id;
}

/** 
	metodo que busca un folder en especifico 
	y retorna el id del folder caso contrario retorna nulo si no encuentra
**/
function searchFolder($client, $name){
	$result = array();
	$parameters = array(
		'q' => "trashed=false and mimeType contains 'application/vnd.google-apps.folder' and name= '$name' ",
	);
	$service = new Google_Service_Drive($client);
	$files = $service->files->listFiles($parameters);
	$result = array_merge($result, $files->getFiles());

	if(count($result)>0){
		# obtenemos el id del folder
		echo "folder encontrado \n";
		return $result[0]["id"];
	}else{
		echo "no se encuentra folder";
		return null;
	}
}
/*subir archivo menor o igual a 5MB*/
function uploadFile($client, $name, $description, $mime_type, $parent_folder_id){

	$file_path = "/home/limbert/Documentos/repositorios/studio/php-drive/src1.png";
	$service = new Google_Service_Drive($client);
	$fileMetaData = new Google_Service_Drive_DriveFile(
		array(
			'name' => $name,
			'description' => $description,
			'parents' => array($parent_folder_id)
			)
	);

	$content = file_get_contents($file_path);
	
	try{
		$file = $service->files->create(
			$fileMetaData, array(
				'data' => $content,
				'mimeType' => $mime_type,
				'uploadType' => 'multipart',
				'fields' => 'id'
			)
		);		

		print "archivo subido correctamente : id : " . $file->id;
	}catch(Exception $e){
		print "Ocurrio un error al subir el archivo : " . $e->getMessage();
	}

}
/**
	Metodo que sube un archivo mayor a 5MB y reanudable
**/
function uploadFileBig($client, $name, $description, $mime_type, $parent_folder_id){
	# falta probar para para documentos grandes
	$file_path = "/home/limbert/Documentos/repositorios/studio/php-drive/src1.png";
	$service = new Google_Service_Drive($client);
	
	#tamaño del archivo en bytes
	$sizeFile = filesize($file_path);
	
	$file = new Google_Service_Drive_DriveFile(
		array(
			'name' => $name,
			'mimeType' => $mime_type,
			'fileSize'	=> $sizeFile,
			'parents' => array($parent_folder_id),
			)
	);	
	#tamaño de los bytes a obtener
	$chunkSizeBytes = 1 * 1024 * 1024; // 1MB
	
	#llamamos a la API 
	$client->setDefer(true);
	$request = $service->files->create($file);

	#creamos un archivo para subir que representa el proceso
	$media = new Google_Http_MediaFileUpload(
		$client,
		$request,
		$mime_type,
		null, # data
		true, # true si es reanudable
		$chunkSizeBytes # numero de bytes a enviar
	);

	#ingresamos el tamaño del archivo
	$media->setFileSize($sizeFile);
	#cargamos varios partes mientras $status sea false
	#hasta que se complete
	$status = false;
	$handle = fopen($file_path, "rb");
	while(!$status && !feof($handle)){
		#$chunk = readVideoChunk($handle, $chunkSizeBytes);
		$chunk = fread($handle, $chunkSizeBytes);
		$status = $media->nextChunk($chunk);
		echo "cargando <br>";
	}
	$result = false;
	if($status !=false){ # quiere decir que se completo la carga
		$result = $status;
	}
	#cerramos el archivo
	fclose($handle);
	#Restablecer al cliente para ejecutar solicitudes inmediatamente en el futuro.
	$client->setDefer(false);
	printf("ARCHIVO CARGADO CORRECTAMENTE");
}

function readVideoChunk($handle, $chunkSize){
    $byteCount = 0;
    $giantChunk = "";
    while (!feof($handle)) {        
        $chunk = fread($handle, 8192);
        $byteCount += strlen($chunk);
        $giantChunk .= $chunk;
        if ($byteCount >= $chunkSize)
        {
            return $giantChunk;
        }
    }
    return $giantChunk;
}
/**metodo que lista los archivos**/
function listarArchivos($client){
	$parameters = array(
		'q' => "trashed=false",
	);	
	$drive_service = new Google_Service_Drive($client);
	$files_list = $drive_service->files->listFiles($parameters)->getFiles();
	foreach ($files_list as $file){
        $res['name'] = $file->getName();
		$res['id'] = $file->getId();
        $files[] = $res;
	}	
	echo json_encode($files_list);
}
/* 
	Metodo para descargar 
*/
function descargarArchivo($client){
	//$fileId = '0B2xwIp-Xlx0dZW9BNlpmV2NhZ00'; // del archivo de 16MB
	$fileId = "0B2xwIp-Xlx0dc1ZwandEX2JxQTQ"; // del archivo de 0.5MB

	$drive_service = new Google_Service_Drive($client);
	$response = $drive_service->files->get($fileId, array(
		'alt' => 'media'));
	
	$rawData = $response->getBody()->getContents();
	
	//convertimos a base64
	$imageData = base64_encode($rawData);
	
	//obtenemos el tipo de contenido de la respuesta
	$contentType = $response->getHeader("content-type");

	// formato de la imagen src:  data:{mime};base64,{data}
	$src = 'data: '.$contentType.';base64,'.$imageData;

	echo "<html>";
	echo "<head>";
	echo "<h1>HOLA MUNDO DESCARGA</h1>";
	echo "</head>";
	echo "<body>";
	// :::::::Tengo dos formas de mostrar la imagen ::::::::::::
	// esta es la otra forma donde hacemos la descarga directamente
	echo '<img src="' . $src . '" alt="holas"/>';
	
	// esto de esto tambien funciona directamente con el id de fotografia
	//echo '<img src="https://drive.google.com/uc?id='.$fileId.'" />';
	//                https://drive.google.com/uc?id=0B2xwIp-Xlx0dc1ZwandEX2JxQTQ
	echo "</body>";
	echo "</html>";
}

function descargarArchivoConBase64($client){
	// https://github.com/google/google-api-php-client/blob/master/examples/large-file-download.php
	// http://academy.leewayweb.com/como-acceder-a-google-drive-usando-php/
	//$fileId = "0B2xwIp-Xlx0dc1ZwandEX2JxQTQ"; // del archivo de 0.5MB
	$fileId = "0B2xwIp-Xlx0dODN3YjFpcXV0VEE"; // scrito_size1.png
	$drive_service = new Google_Service_Drive($client);

	// obtengo el metadata del archivo
	$metaData = $drive_service->files->get($fileId);
	// obtengo el archivo mediante el 
	$file = $drive_service->files->listFiles([
		'q' => "name='" . $metaData->name . "'",
		'fields' => 'files(id,size)'
		]);
	$fileSize = 0;
	if(count($file)>0){
		if($file[0]->id == $fileId){
			$fileSize = intval($file[0]->size);
		}else{
			echo "Archivo distinto del buscado";
			return;
		}	
	}else{
		echo "Archivo no encontrado!!";
		return;
	}

	#todo salio correctamente
	// enviamos la autorizacion Guzzle HTTP client
	$http = $client->authorize();
			
	//creamos el archivo donde vamos a guardar la descarga!!
	$fp = fopen($metaData->name, "w");

	// Download in 1 MB chunks
	$chunkSizeBytes = 1 * 1024 * 1024;
	$chunkStart = 0;

	// iteramos cada chunks y escribimos en nuestro archivo
    while ($chunkStart < $fileSize) {
		$chunkEnd = $chunkStart + $chunkSizeBytes;
		$response = $http->request(
		  'GET',
		  sprintf('/drive/v3/files/%s', $fileId),
		  [
			'query' => ['alt' => 'media'],
			'headers' => [
			  'Range' => sprintf('bytes=%s-%s', $chunkStart, $chunkEnd)
			]
		  ]
		);
		$chunkStart = $chunkEnd + 1;
		fwrite($fp, $response->getBody()->getContents());
	}
    // cerramos el puntero al archivo
	fclose($fp);
	
	//$rawData = $response->getBody()->getContents();
	$rawData = file_get_contents("./".$metaData->name);
	//convertimos a base64
	$imageData = base64_encode($rawData);
	//obtenemos el tipo de contenido de la respuesta
	$contentType = $metaData->mimeType;
	// formato de la imagen src:  data:{mime};base64,{data}
	$src = 'data: '.$contentType.';base64,'.$imageData;

	echo "<html>";
	echo "<head>";
	echo "<h1>HOLA MUNDO DESCARGA2</h1>";
	echo "</head>";
	echo "<body>";
	// esta es la otra forma donde hacemos la descarga directamente
	echo '<img src="' . $src . '" alt="holas"/>';
	echo "</body>";
	echo "</html>";
}

