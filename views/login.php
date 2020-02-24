<?php
    session_start();
    if(isset($_SESSION['user_id'])){
        header("location: ../index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LogIn</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

     
    <div class="titleBar bgBlack">
        <h1>RadioCast</h1>
    </div>

    <div class="containerLogIn shadow" >
        <div class="bgWhite logIn" id ="logIn">
            <h2 class="greenText">Inicia sesión</h2>
            <p class="greenText comment">Por favor pon tus credenciales</p>
        
            <form class="inputsLog" action="../controllers/login.inc.php" method="post">
                <div class="input">
                    <label class = "greenText" for="user">Usuario</label>
                    <input 
                    type="text" 
                    name="user"
                    placeholder="Usuario o correo electrónico"
                    value = "<?php echo(isset($_GET['user']))?$_GET['user']:'';?>"       
                    >
                </div><br>
                <div class="input">
                    <label class = "greenText" for="password">Contraseña</label>
                    <input 
                    class = "passLoginInput"
                    type="password"  
                    name="password"
                    placeholder="Contraseña"
                    >
                    <i class="fas fa-eye passlogineye"></i>   
                </div><br>
                <div class="input btnContainerLogIn">
                    <input class ="btn btnLogIn" type="submit" name = "login-submit" value="Iniciar sesión">
                </div>   
                
                <p class="comment greyText">¿No tienes una cuenta?
                <a href="signup.php" class ="btnChangeToSignIn comment greenText" style="text-decoration: none;">Regístrate</a>
                </p> 
            </form>
            
            <?php 

            if(isset($_GET['error'])){
                if($_GET['error'] == "emptyuser"){
                    echo '<p class="notification error">Por favor usa tu usuario o email</p>';
                } elseif($_GET['error'] == "emptypassword"){
                    echo '<p class="notification error">Por favor escribe tu contraseña</p>';
                } elseif($_GET['error'] == "sqlerror"){
                    echo '<p class="notification error">Hay un error en la comunicación con el servidor,<br>Favor de reportar al administrador del sistema</p>';
                } elseif($_GET['error'] == "wrongpassword"){
                    echo '<p class="notification error">La contraseña es incorrecta</p>';
                } elseif($_GET['error'] == "usernofound"){
                    echo '<p class="notification error">No existe un usuario con esas credenciales</p>';
                }
            }

            if(isset($_GET['signIn'])){
                if($_GET['signIn'] == "success"){
                    echo '<p class="notification successful">Usuario registrado <br> ¡Inicia sesión!</p>';
                } 
            }

            ?>
        </div>
    </div>
    <footer class = "whiteText">
    &copy; Leon A.G.A.
    </footer>
    <script src="../includes/functions/logger.js"></script>
</body>
</html>
