
<?php

    $correo = $_POST['correo'];
    $paracorreo = $correo;
    $titulo ="Recuperacion de contraseña";
    $msj = "Para cambiar tu contraseña da click en el siguiente link: http://localhost/gym_fit/vist/recuperancion.html";
    $tucorreo="From: jfcalderona16@gmail.com";
    if(mail($paracorreo, $titulo, $msj, $tucorreo))
    {
        echo'<script>alert("Correo enviado con exito");</script>';
        echo '<script> window.location="login.php"</script>';
        exit();
    }
    else{
        echo'<script>alert("ERROR, intentelo nuevamente");</script>';
        echo '<script> window.location="login.php"</script>';
        exit();
    }

?>
