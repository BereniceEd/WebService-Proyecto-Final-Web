<?php
  require 'datos/ConexionBD.php';
  require 'controladores/usuarios.php';
  require 'vistas/vistaJson.php';
  require 'utils/exceptionApi.php';

$vista = new VistaJson();

// Manejador de excepciones 
set_exception_handler(
  function ($excepcion) use ($vista) {
    $body = array(
      "estado"=> $excepcion->estado,
      "mensaje"=>$excepcion->getMessage()
    );
    //Comprobamos que exista un estado, de lo contrario asignamos 500
    if ($excepcion->getCode()) {
      $vista->estado = $excepcion->getCode();
    } else {
      $vista->estado = 500;
    }
    //Generamos el json son el cuerpo de la excepción.
    $vista->imprimir($body);
  }
);
// Comprobamos si la variable PATH_INFO tiene datos para extraerlos, 
// de lo contrario generamos una excepción
if (isset($_GET['PATH_INFO'])) {
  $peticion = explode('/', $_GET['PATH_INFO']);
} else {
  throw new ExceptionApi(ESTADO_URL_INCORRECTA,
      "Solicitud incorrecta");
}

//Obtener el recurso del servicio web
$recurso = array_shift($peticion);

//Solo tenemos el recurso de alumnos
$recursos_disponibles = array('usuarios');


//Validamos si el recurso existe, si no existe generamos una excepción
if (!in_array($recurso,$recursos_disponibles)) {
  throw new ExceptionApi(
    "ESTADO_RECURSO_INEXISTENTE",
    "No se encuentra el recurso solicitado");
}

//Obtenemos el método de solicitud puede ser GET, POST, PUT, DELETE
$metodo = strtolower($_SERVER['REQUEST_METHOD']);
//Comparamos el metodo requerido
switch ($metodo) {
  case 'get':
    $vista->imprimir(usuarios::get($peticion));
    break;
  case 'post':
    $vista->imprimir(usuarios::get($peticion));
    break;
  case 'put':
  case 'delete':   
  default:
    $vista->estado = 405;
    $cuerpo = [
        "estado"=>"METODO NO PERMITIDO",
        "mensaje"=>"Método no permitido"
      ];
      $vista->imprimir($cuerpo);
}
//print $_GET['PATH_INFO'];







?>
