<?php

class AnunciosController {

  private $db = null;

  function __construct($conexion) {
    $this->db = $conexion;
  }





  public function enviarAnuncio() {
    if(IDUSER){
      $anuncio = json_decode(file_get_contents("php://input"));
      
      $eval = 'INSERT INTO anuncio (titulo,texto,precio,idanunciante,fotoanu) VALUES (?,?,?,?,?)';
      $peticion = $this->db->prepare($eval);
      $peticion->execute([
        $anuncio->titulo,$anuncio->texto,$anuncio->precio,$anuncio->idanunciante,$anuncio->fotoanu
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
    
    
    public function buscarAnuncio(){
        $busqueda = null;
      if(!empty($_GET["busqueda"])) $busqueda = $_GET["busqueda"];
      
      $eval = "SELECT titulo,texto,precio,fecha,idanunciante FROM anuncio ORDER BY fecha DESC";
      //$eval = "SELECT * FROM anuncio";
      
      $eval .= $busqueda ? " AND CONCAT_WS(titulo,texto,precio) LIKE '%".$busqueda."%'" : null;

      $peticion = $conexion->prepare($eval);
      $peticion->execute();
      $resultado = $peticion->fetchAll(PDO::FETCH_OBJ);
      exit(json_encode($resultado));
    }
    public function subirAvatar() {
    if(is_null(IDUSER)){
      http_response_code(401);
      exit(json_encode(["error" => "Fallo de autorizacion"]));
    }
    if(isset($_FILES['imagen'])) {
      $imagen = $_FILES['imagen'];
      $mime = $imagen['type'];
      $size = $imagen['size'];
      $rutaTemp = $imagen['tmp_name'];
  
      //Comprobamos que la imagen sea JPEG o PNG y que el tamaño sea menor que 400KB.
      if( !(strpos($mime, "jpeg") || strpos($mime, "png")) || ($size > 400000) ) {
        http_response_code(400);
        exit(json_encode(["error" => "La imagen tiene que ser JPG o PNG y no puede ocupar mas de 400KB"]));
      } else {
  
        //Comprueba cual es la extensión del archivo.
        $ext = strpos($mime, "jpeg") ? ".jpg":".png";
        $nombreFoto = "p-".IDUSER."-".time().$ext;
        $ruta = ROOT."images/".$nombreFoto;
  
        //Comprobamos que el usuario no tenga mas fotos de perfil subidas al servidor.
        //En caso de que exista una imagen anterior la elimina.
        $imgFind = ROOT."images/p-".IDUSER."-*";
        $imgFile = glob($imgFind);
        foreach($imgFile as $fichero) unlink($fichero);
        
        //Si se guarda la imagen correctamente actualiza la ruta en la tabla usuarios
        if(move_uploaded_file($rutaTemp,$ruta)) {
  
          //Prepara el contenido del campo imgSrc
          $imgSRC = "http://localhost/".basename(ROOT)."/images/".$nombreFoto;
  
          $eval = "UPDATE anuncio SET fotoanu=? WHERE id=?";
          $peticion = $this->db->prepare($eval);
          $peticion->execute([$imgSRC,IDUSER]);
  
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
    public function eliminarAnuncio() {
    if(IDUSER) {
        

      //Preparamos la peticion de eliminar usuario de la base de datos.
      $eval = "DELETE * FROM anuncio WHERE id=?";
      $peticion = $this->db->prepare($eval);
      $peticion->execute();
      http_response_code(200);
      exit(json_encode("Usuario eliminado correctamente"));
    } else {
      http_response_code(401);
      exit(json_encode(["error" => "Fallo de autorizacion"]));            
    }
  } 
}