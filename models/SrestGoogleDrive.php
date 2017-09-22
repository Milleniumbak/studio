<?php

namespace app\models;

use Yii;
use yii\BaseYii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
/**
 * Clase encargada de conectarse al servicio en la nube de google
 */

class Srestgoogledrive
{
    /**
        Constructor de clase
    **/
    public function __construct(){

    }
    /**
    *   Metodo para conectar al servicio en la nube
    *   devuelve un objeto cliente con la conexion a la nube
    **/
    public function connect_to_cloud(){
        $credencial_json = Yii::getAlias("@app") ."/client_id.json";
        $credentials = Yii::getAlias("@app") ."/credentials.json";
        if (!file_exists($credencial_json)){
            Yii::Warning("Configuracion a servidor no encontrada");
            return null;
        }
            
        # Autenticacion con OAth
        $client = new \Google_Client();
        $client->setAuthConfig($credencial_json);
        #$client->setAuthConfigFile($credencial_json);
        $client->addScope(\Google_Service_Drive::DRIVE_FILE);         
        $client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/web/index.php?r=simgevent/oauthocallback');
        $client->setAccessType('offline');
        $client->setApprovalPrompt('force');

        # verificamos si existe el archivo de credenciales
        if (file_exists($credentials)){
            $access_token = (file_get_contents($credentials));
            $client->setAccessToken($access_token);
            #verificamos si el token de acceso a expirado
            if ($client->isAccessTokenExpired()) {                
                Yii::Warning("Token ha expirado");
                $token = $client->getRefreshToken();
                $client->fetchAccessTokenWithRefreshToken($token);
                file_put_contents($credentials, json_encode($client->getAccessToken()));
            }else{
                Yii::Warning("El token sigue vigente!!!");
            }
            return $client;
        }else{
            # redireccionar a autocallback
            Yii::Warning("Archivo de credenciales no existe!!");
            return null;
        }
    }
    /**
    * Metodo para la autenticacion 
    * call back que vuelve del Servidor
    **/
    public function oauth_callback(){
                
        $credencial_json = Yii::getAlias("@app") ."/client_id.json";
        $credentials = Yii::getAlias("@app") ."/credentials.json";

        $client = new \Google_Client();
        $client->setAuthConfigFile($credencial_json);
        $client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/web/index.php?r=simgevent/oauthocallback');
        $client->addScope(\Google_Service_Drive::DRIVE_FILE);
        $client->setAccessType('offline');
        $client->setApprovalPrompt('force');

        if (!isset($_GET['code'])) {
            Yii::Warning("Code no esta definida");            
            $auth_url = $client->createAuthUrl();
            Yii::Warning("url google autho : " . $auth_url);
            // devolvemos el redireccionamiento de autenticacion de google
            return filter_var($auth_url, FILTER_SANITIZE_URL);
        } else {
            #cuando no llego el codigo aun            
            $client->authenticate($_GET['code']);
            Yii::Warning("codigo de autenticacion : " . $_GET['code']);
            $access_token = $client->getAccessToken();
            # guardamos el archivo
            file_put_contents($credentials, json_encode($access_token));

            # quiere decir que se guardo correctamente las credenciales
            # ahora continuamos con la subida de imagenes
            return null;
        }        
    }
    /**
    *
    * Metodo que crea un directorio en la nube 
    * devuelve un ID del directorio creado
    * @param $client Conexion hacia la nube
    * @param $name Nombre del folder que se va a crear
    * @param $parent_id id de la carpeta donde se va a crear la nueva carpeta
    **/
    function createDirectory($client, $name_folder, $parent_id){
        #nos conectamos al servidor
        $drive_service = new \Google_Service_Drive($client);
        $fileMetadata = null;
        if(is_null($parent_id)){
            $fileMetadata = new \Google_Service_Drive_DriveFile(array(
                'name' => $name_folder,
                'mimeType' => 'application/vnd.google-apps.folder'
                )
            );
        }else{
            $fileMetadata = new \Google_Service_Drive_DriveFile(array(
                'name' => $name_folder,
                'mimeType' => 'application/vnd.google-apps.folder',
                'parents' => array($parent_id)
                )
            );
        }

        $file = $drive_service->files->create($fileMetadata, array(
            'fields' => 'id'));
        return $file->id;
    }
    /**
     * Metodo que elimina un archivo o carpeta de la nube
     * @param $client Conexion a la nube
     * @param $idFile Identificador del archivo a eliminar en la nube
     */
    public function deleteFile($client, $idFile){
        try {
            $service = new \Google_Service_Drive($client);
            $files = $service->files->delete($idFile);
        } catch (Exception $e) {
            Yii::Warning($e->getMessage());
        }
    }
    /**
    *
    * Metodo que busca un directorio en especifico y devuelve el identificador
    * Retorna [nullo] si no encuentra ningun directorio con ese nombre
    * @param $client La conexion con el servidor de google
    * @param $name El nombre de la carpeta que se esta buscando
    **/
    public function searchFolder($client, $name){
        $result = array();
        $parameters = array(
            'q' => "trashed=false and mimeType contains 'application/vnd.google-apps.folder' and name= '$name' ",
        );

        $service = new \Google_Service_Drive($client);
        $files = $service->files->listFiles($parameters);
        $result = array_merge($result, $files->getFiles());	
        
        if(count($result)>0){
            # obtenemos el id del folder    
            return $result[0]["id"];
        }else{
            Yii::Warning("no se encontro carpeta");
            return null;
        }
    }
    /**
     * Busca una imagen en base al nombre del archivo
     * @param $client Conexion a la nube
     * @param $name nombre de la imagen a buscar
    */
    public function searchImage($client, $name){
        $result = array();
        $parameters = array(
            'q' => "trashed=false and mimeType contains 'image/' and name= '$name' ",
        );

        $service = new \Google_Service_Drive($client);
        $files = $service->files->listFiles($parameters);
        $result = array_merge($result, $files->getFiles());	
        
        if(count($result)>0){
            # obtenemos el id del folder
            return $result[0]["id"];
        }else{
            Yii::Warning("no se encontro carpeta");
            return null;
        }
    }    
    /**
    * Lista los archivos en la nube
    * @param $client Conexion a la nube
    **/
    public function listarArchivos($client){
        $parameters = array(
            'q' => "trashed=false",
        );	
        $drive_service = new \Google_Service_Drive($client);
        $files_list = $drive_service->files->listFiles($parameters)->getFiles();
        foreach ($files_list as $file){
            $res['name'] = $file->getName();
            $res['id'] = $file->getId();
            $files[] = $res;
        }	
        echo json_encode($files_list);
        return $files_list;
    }
    /**
     * Metodo que sube a la nube un archivo
     * @param $file_path direccion donde esta ubicado el archivo
     * @param $client conexion a la nube
     * @param $name Nombre del archivo
     * @param $descripcion Descripcion del archivo
     * @param $mime_type Es el content type del archivo
     * @param $parent_folder_id Es la carpeta donde se va a guardar el archivo
     * 
     */
    public function uploadFileBig($file_path, $client, $name, $description, $mime_type, $parent_folder_id){
        
        #$file_path = "/home/limbert/Documentos/repositorios/studio/php-drive/src1.png";
        $service = new \Google_Service_Drive($client);        
        #tamaño del archivo en bytes
        $sizeFile = filesize($file_path);
        
        $file = new \Google_Service_Drive_DriveFile(
            array(
                'name' => $name,
                "description" => $description,
                'mimeType' => $mime_type,
                'fileSize'	=> $sizeFile,
                'parents' => array($parent_folder_id)
                )
        );	
        #tamaño de los bytes a obtener
        $chunkSizeBytes = 1 * 1024 * 1024; // 1MB
        
        #llamamos a la API 
        $client->setDefer(true);
        $request = $service->files->create($file, array('fields' => 'id'));
    
        #creamos un archivo para subir que representa el proceso
        $media = new \Google_Http_MediaFileUpload(
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
        }
        $result = false;
        if($status !=false){ # quiere decir que se completo la carga
            $result = $status;
        }
        #cerramos el archivo
        fclose($handle);
        #Restablecer al cliente para ejecutar solicitudes inmediatamente en el futuro.
        $client->setDefer(false);
        Yii::Warning("pase hasta aqui sin error");
    }
    
    private function readVideoChunk($handle, $chunkSize){
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

}