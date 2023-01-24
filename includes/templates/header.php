<?php
    if(!isset($_SESSION)){
        session_start();
    }
    $auth = $_SESSION['login'] ?? false ;
    $perfil = $_SESSION['perfil'] ?? null;
    $sesion = $_SESSION['nombre'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales TIC</title>
    <link rel="stylesheet" href="/SalesTIC/css/app.css">
    <link rel="icon" type="image/JPG" href="/SalesTIC/img/icons/Logo.jpg">
</head>

<body>
    <header>
        <div class="container container-header">
            <a href="/SalesTIC"><h1><span>Ventas</span>TIC</h1></a>
            <nav class="nav-principal">
                <?php if(!$auth): ?>
                    <a href="/SalesTIC/login.php"><span>Iniciar Sesión</span></a>
                    <p><img loading="lazy" src="/SalesTIC/img/icons/iconUsers.svg" alt="icono Login"></p>
                <?php endif; ?>
                <?php if($auth): ?>
                    <p><?php echo $sesion ?></p>
                <?php if($perfil==1): ?>
                    <a href="/SalesTIC/admin/sales.php">Ventas</a>
                    <a href="/SalesTIC/admin/users.php">Usuarios</a>
                <?php endif; ?>
                    <a href="/SalesTIC/admin">Equipos</a>
                    <a href="/SalesTIC/logout.php">Cerrar Sesión</a>
                <?php endif; ?>
            </nav>
        </div>
    </header> 