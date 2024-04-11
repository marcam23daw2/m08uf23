<?php
session_start();

if (!isset($_SESSION['usuari_autenticat']) || $_SESSION['usuari_autenticat'] !== true) {
    header("Location: info.php");
    exit();
}
?>

<form method="post" action="resultat.php">
    UID: <input type="text" name="uid"><br>
    Unidad Organizativa: <input type="text" name="unorg"><br>
    <input type="submit" value="BUSCAR USUARIO">
</form>
<form action="principal.php">
    <input type="submit" value="Volver">
</form>
