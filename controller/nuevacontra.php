<?php
    require_once("../db/conexion.php");
    $db = new database();
    $conexion = $db->conectar();
    session_start();

    if((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1"))
    {
        $contra = $_POST['cont'];
        echo $contra;
        $clave1= password_hash('sha512',PASSWORD_DEFAULT,["cost"=>12]);


        if ($_POST['cont']=="" || $_POST['conta']=="")
            {
                    echo '<script>alert ("Datos vacios no ingreso la clave");</script>';
                    echo '<script>window.location="../recuperacion.html"</script>';
            }
        else
            {
                $documento = $_SESSION['documento'];
                $clave1= password_hash('sha512',PASSWORD_DEFAULT,["cost"=>12]);
                $contr= $_POST['conta'];
                echo $contr;

                $insertSQL=$conexion->prepare( "UPDATE usuario SET password = '$clave1' WHERE documento = '$documento'");
                $insertSQL->execute();
                    echo '<script>alert ("Cambio de clave exitosa");</script>';
                    echo '<script>window.location="../login.php"</script>';
            }
    }
?>

<?php
    if($_POST["inicio"]){

        $documento = $_POST["documento"];
        
        // sirve para imprimir lo que trae la variable echo $document; //
        $sql=$conexion->prepare("SELECT * FROM usuario WHERE documento = '$documento'");
        $sql->execute();
        $fila=$sql->fetch();

        if($fila){
            $_SESSION['documento']=$fila['documento'];
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>INICIO DE SESION</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/login.css">

</head>

<body>

    <div class="login-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="bg-white shadow rounded">
                        <div class="row">
                            <div class="col-md-7 pe-0">
                                <div class="form-left h-100 py-5 px-5">
                                    <form method="POST" name="form1" id="form1" autocomplete="off">
                                        <h3 class="mb-3">CAMBIO DE CONTRASEÑA</h3>
                                        <div class="col-12">
                                            <label for="usuario">NUEVA CONTRASEÑA<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
                                                <input type="password" name="cont" id="cont" placeholder="Nueva clave" minlength="6" class="form-control" placeholder="Ingrese su documento" maxlength="20" oninput="maxlengthNumber(this);">
                                            </div>
                                        </div>
                                        <br>
                                        

                                        <div class="col-12">
                                            <label for="usuario" > CONFIRMACION DE CONTRASEÑA<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="bi bi-lock-fill"></i></div>
                                                <input type="password" name="conta" id="conta" placeholder="Confirme clave" minlength=8  class="form-control" placeholder="Ingrese su contraseña" maxLength="20" oninput="maxlengthNumber(this);">
                                            </div>
                                        </div>
                                        <br>
                                        


                                        <div class="col-12">
                                            <input type="submit" name="inicio" id="inicio" class="btn btn-warning px-5 " value="cambiar">
                                            <input type="hidden" name="MM_update" value="form1">
                                            <a href="../login.php" class="btn btn-warning px-5 ">Volver pagina principal</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-5 ps-0 d-none d-md-block">
                                <div class="form-right h-100 bg-dark text-white text-center pt-2">
                                    <i class="">Z&#128293;NA ES 8/67</i>
                                    <h2 class="fs-2">BIENVENIDOS</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


        <!-- <html>
            <head>
                <link rel="stylesheet" href="../controller/css/Stylo.css">
                <meta charset="utf-8">
            </head>
            <body>
                <div class="login-box">
                    <!-- crea una caja imaginaria-->            
                    <!--insertamos una imagen -->
                    <>
                        <!--creamos formulario -->
                        <!-- <label for="usuario">Nueva contraseña</label>
                        <input type="password" name="cont" id="cont" placeholder="Nueva clave">
                        <label for="usuario">Confirme contraseña</label>
                        <input type="password" name="conta" id="conta" placeholder="Confirme clave">
                        <input type="submit" name="inicio" id="inicio" value="cambiar">
                        <input type="hidden" name="MM_update" value="form1">
                        <a href="../login.php">Volver pagina principal</a> -->
                    <!-- </form>
                </div>-->

        
    <script>
        // <!-- FUNCION DE JAVASCRIPT QUE PERMITE INGRESAR SOLO EL NUMERO VALORES REQUERIDOS DE ACUERDO A LA LONGITUD MAXLENGTH DEL CAMPO -->


        function maxlengthNumber(obj) {

            if (obj.value.length > obj.maxLength) {
                obj.value = obj.value.slice(0, obj.maxLength);
                alert("Debe ingresar solo el numeros de digitos requeridos");
            }
        }


    </script>        
    </body> 
</html>

    <?php
    }
    else
    {
        echo '<script>alert ("El documento no existe en la base de datos");</script>';
        echo '<script>window.location="../vist/recuperancion.html"</script>';
    }
}

?>