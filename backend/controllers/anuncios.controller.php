<?php

class AnunciosController {

  private $db = null;

  function __construct($conexion) {
    $this->db = $conexion;
  }





  public function enviarAnuncio() {
    if(IDUSER){
      $anuncio = json_decode(file_get_contents("php://input"));
      
      $eval = 'INSERT INTO anuncio (titulo,texto,precio,idanunciante,fotoanu,categoria) VALUES (?,?,?,?,?,?)';
      $peticion = $this->db->prepare($eval);
      $peticion->execute([
        $anuncio->titulo,$anuncio->texto,$anuncio->precio,IDUSER,$anuncio->fotoanu,$anuncio->categoria
      ]);
      
      http_response_code(201);
      exit(json_encode("Mensaje enviado correctamente"));
    }
    else{
      http_response_code(401);
      exit(json_encode(["error" => "Fallo de autorizacion"]));
    }
  }
    public function listarAnuncio() {
    
      $eval = "SELECT DISTINCT * FROM anuncio,usuarios WHERE anuncio.idanunciante=usuarios.id ORDER BY fecha DESC ";
      $peticion = $this->db->prepare($eval);
      $peticion->execute();
      $resultado = $peticion->fetchAll(PDO::FETCH_OBJ);
      exit(json_encode($resultado));
    
  }
    public function listarAnuncioAlim() {
    
      $eval = "SELECT DISTINCT * FROM anuncio,usuarios WHERE anuncio.idanunciante=usuarios.id AND anuncio.categoria='Alimentacion' ORDER BY fecha DESC";
      $peticion = $this->db->prepare($eval);
      $peticion->execute();
      $resultado = $peticion->fetchAll(PDO::FETCH_OBJ);
      exit(json_encode($resultado));
    
  }
    public function listarAnuncioElec() {
    
      $eval = "SELECT DISTINCT * FROM anuncio,usuarios WHERE anuncio.idanunciante=usuarios.id AND anuncio.categoria='Electronica' ORDER BY fecha DESC ";
      $peticion = $this->db->prepare($eval);
      $peticion->execute();
      $resultado = $peticion->fetchAll(PDO::FETCH_OBJ);
      exit(json_encode($resultado));
    
  }
    public function listarAnuncioDeco() {
    
      $eval = "SELECT DISTINCT * FROM anuncio,usuarios WHERE anuncio.idanunciante=usuarios.id AND anuncio.categoria='Decoracion' ORDER BY fecha DESC ";
      $peticion = $this->db->prepare($eval);
      $peticion->execute();
      $resultado = $peticion->fetchAll(PDO::FETCH_OBJ);
      exit(json_encode($resultado));
    
  }
    public function listarAnuncioVehi() {
    
      $eval = "SELECT DISTINCT * FROM anuncio,usuarios WHERE anuncio.idanunciante=usuarios.id AND anuncio.categoria='Vehiculo' ORDER BY fecha DESC ";
      $peticion = $this->db->prepare($eval);
      $peticion->execute();
      $resultado = $peticion->fetchAll(PDO::FETCH_OBJ);
      exit(json_encode($resultado));
    
  }
    
   
    public function listarTusAnuncio() {
    
      $eval = "SELECT DISTINCT * FROM anuncio,usuarios WHERE anuncio.idanunciante=usuarios.id AND anuncio.idanunciante=".IDUSER." ORDER BY fecha DESC ";
      $peticion = $this->db->prepare($eval);
      $peticion->execute();
      $resultado = $peticion->fetchAll(PDO::FETCH_OBJ);
      exit(json_encode($resultado));
    
  }
    public function editarAnuncio(){
        $anuncio = json_decode(file_get_contents("php://input"));
        if(IDUSER) {
          if(!isset($anuncio->idanu) || !isset($anuncio->titulo) || !isset($anuncio->texto) || !isset($anuncio->precio) || !isset($anuncio->categoria)) {
            http_response_code(400);
            exit(json_encode(["error" => "No se han enviado todos los parametros"]));
          }
          $eval = "UPDATE anuncio SET titulo=?, texto=?, precio=?, categoria=? WHERE idanu=?";
          $peticion = $this->db->prepare($eval);
          $peticion->execute([$anuncio->titulo,$anuncio->texto,$anuncio->precio,$anuncio->categoria,$anuncio->idanu]);
          http_response_code(201);
          //Comprobamos si se ha eliminado la nota e informarnos en la respuesta.
          if($peticion->rowCount()) exit(json_encode("Se ha actualizado la nota"));
          else exit(json_encode("La nota no se ha actualizado"));
        } else {
          http_response_code(401);
          exit(json_encode(["error" => "Fallo de autorizacion"]));        
        }
    }
    
    public function eliminarAnuncio($idanu) {
    if(empty($idanu)) {
      http_response_code(400);
      exit(json_encode(["error" => "Peticion mal formada"]));    
    }
    if(IDUSER) {
      $eval = "DELETE FROM anuncio WHERE idanu=?";
      $peticion = $this->db->prepare($eval);
      $peticion->execute([$idanu]);
      http_response_code(200);
      //Comprobamos si se ha eliminado la nota e informarnos en la respuesta.
      if($peticion->rowCount()) exit(json_encode("Nota eliminada correctamente"));
      else exit(json_encode("La nota no se ha podido eliminar"));
    } else {
      http_response_code(401);
      exit(json_encode(["error" => "Fallo de autorizacion"]));            
    }
  }
    
    public function subirAvatarAnu() {
    if(is_null(IDUSER)){
      http_response_code(401);
      exit(json_encode(["error" => "Fallo de autorizacion"]));
    }
    if(isset($_FILES['imagenanu'])) {
      $imagenanu = $_FILES['imagenanu'];
      $mime = $imagenanu['type'];
      $size = $imagen['size'];
      $rutaTemp = $imagenanu['tmp_name'];
  
      //Comprobamos que la imagen sea JPEG o PNG y que el tamaño sea menor que 400KB.
      if( !(strpos($mime, "jpeg") || strpos($mime, "png")) || ($size > 400000) ) {
        http_response_code(400);
        exit(json_encode(["error" => "La imagen tiene que ser JPG o PNG y no puede ocupar mas de 400KB"]));
      } else {
  
        //Comprueba cual es la extensión del archivo.
        $ext = strpos($mime, "jpeg") ? ".jpg":".png";
        $nombreFoto = "p-".IDUSER."-".time().$ext;
        $ruta = ROOT."imagesanu/".$nombreFoto;
  
        //Comprobamos que el usuario no tenga mas fotos de perfil subidas al servidor.
        //En caso de que exista una imagen anterior la elimina.
        $imgFind = ROOT."imagesanu/p-".IDUSER."-*";
        $imgFile = glob($imgFind);
        foreach($imgFile as $fichero) unlink($fichero);
        
        //Si se guarda la imagen correctamente actualiza la ruta en la tabla usuarios
        if(move_uploaded_file($rutaTemp,$ruta)) {
  
          //Prepara el contenido del campo imgSrc
          $imgSRC = "http://localhost/EL_TRABAJAZO/".basename(ROOT)."/imagesanu/".$nombreFoto;
  
          $eval = "UPDATE anuncio SET fotoanu=? WHERE idanu=?";
          $peticion = $this->db->prepare($eval);
          $peticion->execute([$anuncio->fotoanu,$anuncio->idanu]);
  
          http_response_code(201);
          exit(json_encode("Imagen actualizada correctamente"));
        } else {
          http_response_code(500);
          exit(json_encode(["error" => "Ha habido un error con la subida"]));      
        }
      }
    }  else {
      http_response_code(400);
      exit(json_encode(["error" => "No se han enviado todos los parametros"]));
    }
  }
}
    
