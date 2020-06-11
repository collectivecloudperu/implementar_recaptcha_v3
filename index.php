  
  <?php
    include '../top.php'; 
  ?>

  <?php
    // Datos 
    $tpb = "Demo: Como implementar reCAPTCHA v3 de Google en un Formulario HTML";
    $pb = "https://blog.nubecolectiva.com/como-implementar-recaptcha-v3-de-google-en-un-formulario-html/";
    $gh = "https://github.com/collectivecloudperu/implementar_recaptcha_v3/";
  ?>

  <title><?php echo $tpb ?></title>

  <style type="text/css">
    .ghbmd {
      /* display: none!important; */
    }

  </style>

  <?php
    include '../topb.php'; 
  ?>

  <?php
    include '../pub.php'; 
  ?>

    <main role="main">

        <div class="container mt-5">

          <!-- Contenido -->

          <div class="row">

            <div class="col-md-12 text-center">

                <h1 style="font-size: 28px;" class="mb-4"><?php echo $tpb ?> </h1>

                <p>
                  <strong>NOTA:</strong> El sistema reCAPTCHA v3 trabaja con una puntuación minima de 0.0 y máxima de 1.0
                </p>
                <p>
                  Por ejemplo si la puntuación es mayor o igual que 0.4 "no es un Robot" y si la puntuación es menor o igual que 0.5 "si es un robot"
                </p>

                <div class="fad text-center">
                  <?php
                    include '../fad.php'; 
                  ?> 
                </div>

                <?php
                  include '../mbtodt.php'; 
                ?>                

            </div>

          </div> 

          <div class="row">

            <div class="col-md-10">

              <form id="formulario" name="formulario" method="post" action="procesar.php" role="form" onsubmit="enviarFormulario();">

              	<div class="resultado_validacion mb-4">

              		<?php echo $_GET["mensaje"]; ?>

                	<?php echo $_GET["puntaje"]; ?>
              		
              	</div>               
                

                <div class="form-group">
                  <label for="nya" class="negrita2">Nombres y Apellidos:</label>
                  <input type="text" class="form-control" id="nya" name="nya" placeholder="Ingresa tus Nombres y Apellidos" required>
                </div>
                <div class="form-group">
                  <label for="telefono" class="negrita2">Ingresa tu Número de Telefono o Celular:</label>
                  <input type="phone" class="form-control" id="telefono" name="telefono" placeholder="Ingresa tu Número" required>
                </div>
                <div class="form-group">
                  <label for="email" class="negrita2">Email:</label>
                  <input type="email" class="form-control" id="email" id="email" placeholder="Ingresa tu Correo" required>
                </div>
                <div class="form-group">
                  <label for="asunto" class="negrita2">Asunto:</label>
                  <input type="text" class="form-control" id="asunto" id="asunto" placeholder="Ingresa el Asunto de tu Mensaje" required>
                </div>
                <div class="form-group">
                  <label for="mensaje" class="negrita2">Asunto:</label>
                  <textarea class="form-control" id="mensaje" id="mensaje" placeholder="Ingresa  tu Mensaje" required></textarea>
                </div>

                <!-- Campos oculto para el token y action -->
                <input type="hidden" id="token" name="token">
                <input type="hidden" id="action" name="action" value="procesar">

                <input type="submit" class="btn btn-primary" value="Aceptar" id="btnenviar" name="btnenviar">

              </form>           
              
            </div>

            <div class="col-md-2 mtga">

              <?php
                include '../pub2.php'; 
              ?>

            </div>

            
          </div> 

          <!-- Fin Contenido -->     

          <?php
           include '../hab.php'; 
          ?>           
          
        </div>

    </main>


    <?php
      include '../bottom.php'; 
    ?>

    <script src="https://www.google.com/recaptcha/api.js?render=TU-SITE-KEY"></script> 

    <script>
      function enviarFormulario() {
        
        grecaptcha.ready(function() {
          grecaptcha.execute('TU-SITE-KEY', 
            {
              // Defino el valor del action o la acción, este valor también lo coloqué en el input oculto 'action'
              action: 'procesar' 
            }).then(function(token) {              

              // Antes de procesar el formulario, le asigno el token al input oculto 'token' 
              document.getElementById('token').value = token; 

              // Procesamos el formulario 
              document.getElementById("formulario").submit();
          });
        });

      }
    </script>
    
  </body>
</html> 
