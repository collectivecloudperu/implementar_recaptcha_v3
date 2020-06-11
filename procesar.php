<?php

  if($_SERVER["REQUEST_METHOD"] === "POST")
    {

    // Colocamos la clave secreta de reCAPTCHA v3 
    define("SECRET_KEY", 'TU-SECRET-KEY'); 

    $token = $_POST['token'];
    $action = $_POST['action'];
     
    // Mediante CURL hago un Post a la api de reCaptcha 
    $datos = curl_init();
    curl_setopt($datos, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
    curl_setopt($datos, CURLOPT_POST, 1);
    
    // En el Post a la api de reCaptcha envio la Secret Key y el Token generado en la vista HTML
    curl_setopt($datos, CURLOPT_POSTFIELDS, http_build_query(
      array(
        'secret' => SECRET_KEY, 
        'response' => $token
      )
    ));

    // Obtengo una respuesta de reCaptcha y los datos obtenidos los decodifico para poder verificarlos 
    curl_setopt($datos, CURLOPT_RETURNTRANSFER, true); 
    $respuesta = curl_exec($datos);    
    curl_close($datos);
    $datos_respuesta = json_decode($respuesta, true);
    
     
    // Verificamos los datos 
    if($datos_respuesta["success"] == '1' && $datos_respuesta["action"] == $action && $datos_respuesta["score"] >= 0.4) {

      // Si no es un robot hago una redirección con un mensaje 
      $puntaje = "<p><span style=color:green;font-weight:bold;>Puntaje: </span>".json_encode($datos_respuesta["score"])."</p>";
      $mensaje = "<p><span style=color:green;font-weight:bold;>Resultado: </span>No eres un robot. </p>";
      header("Location: index.php?mensaje=$mensaje&puntaje=$puntaje");

    } else {

      // Si es un robot hago una redirección con un mensaje 
      $puntaje = "<p> <span style=color:red;font-weight:bold;>Puntaje: </span>".json_encode($datos_respuesta["score"])."</p>";
      $mensaje = "<p> <span style=color:red;font-weight:bold;>Resultado: </span>Tú eres un robot. </p>";
      header("Location: index.php?mensaje=$mensaje&puntaje=$puntaje");

    }

  }  
