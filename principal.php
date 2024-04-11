<?php
session_start();

if (!isset($_SESSION['usuari_autenticat']) || $_SESSION['usuari_autenticat'] !== true) {
    header("Location: info.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Menú</title>
</head>
<body>
    <h1>Menú</h1>
    <ul>
        <li><a href="cercarUsuari.php">Cercar Usuari</a></li>
        <li><a href="formulari.php">Crear Usuari</a></li>
        <li><a href="eliminarUsuaris.php">Eliminar Usuari</a></li>
        <li><a href="modificarUsuari.php">Modificar Usuari</a></li>
    </ul>
    <form action="logout.php" method="post">
        <button type="submit" name="logout">Logout</button>
    </form>
</body>
</html>
