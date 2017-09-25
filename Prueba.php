<html>
  <head>
    <title>Prueba de PHP</title>
  </head>
  <body>
   <p>K pasa <?php echo $_POST["nombre"];?>, crack.</p>
   <?php
     if ($_POST['genero'] == "Hombre")
     {
       echo '<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fd/Symbol_mars.svg/1200px-Symbol_mars.svg.png" 
             alt="Genero Masculino" style="width:304px;height:300px;">';
     }

     else if ($_POST['genero'] == "Mujer")
     {
       echo '<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/74/Symbol_venus.svg/1200px-Symbol_venus.svg.png" 
             alt="Genero Masculino" style="width:304px;height:400px;">';
     }

     else if ($_POST['genero'] == "Helicoptero Apache de Combate")
     {
       echo '<img src="https://ugc.kn3.net/i/origin/http://www.hunter9999999.narod.ru/images2/AH-64D_Apache_Longbow.jpg" 
             alt="Helicoptero Apache de Combate" style="width:304px;height:228px;">';
     }
   ?>
  </body>
</html>