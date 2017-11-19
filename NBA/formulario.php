<!DOCTYPE HTML>
<html>
<head>
    <style>
        .error {color: #FF0000;}
    </style>
</head>
<body>
    <?php
    /*

    $nameErr= "";
    $name= "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = test_input($_POST["name"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                $nameErr = "Only letters and white space allowed";
            }
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

        */?>
    <form action = "index.php<?php /* echo htmlspecialchars($_SERVER["PHP_SELF"]); */?>" method="post">
        <p>Nombre del equipo</p>
        <br/>
        <input type ="text" name="nombreEquipo" <!--value="<?/*php echo $name;*/?> -->"/>
        <!--<span class="error">* <?/*php echo $nameErr;*/?></span>-->
        <br/>
        <p>Numero de jugadores</p>
        <br/>
        <input type ="text" name="numeroJugadores"/>
        <br/>
        <br/>
        <input type ="submit" value="Crear"/>
    </form>

</body>
</html>