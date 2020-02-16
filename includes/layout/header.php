<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RadioCast</title>
    <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.0/normalize.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" href="css/styleApp.css">
</head>
<body>
<header>
   <div class ="titleBar">
        <nav>
            <a href ="#">
                <img style ="max-width: 8rem; padding: 1rem; "src= "img/logo.png" alt="logo">
            </a>    
            <h1>RadioCast</h1>
            <ul>
                <li class="menuItem"><a href="#">Proximas transmisiones</a></li>
                <li class="menuItem"><a href="#">Crea tu propia transmision!</a></li>
            </ul>
            <form action ="includes/functions/logout.inc.php" method="post">
                <button type="submit" name="logout-submit">Logout</button>
            </form>
        </nav>
    </div>   

</header>