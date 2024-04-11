<?php
session_start();

if (!isset($_SESSION['usuari_autenticat']) || $_SESSION['usuari_autenticat'] !== true) {
    header("Location: info.php");
    exit();
}

require 'vendor/autoload.php';
use Laminas\Ldap\Attribute;
use Laminas\Ldap\Ldap;

ini_set('display_errors', 0);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $atribut = $_POST["atribut"];
    $nou_contingut = $_POST["nou_contingut"];
    $uid = $_POST["uid"];
    $unorg = $_POST["unorg"];
    $dn = 'uid='.$uid.',ou='.$unorg.',dc=fjeclot,dc=net';
    
    $opcions = [
        'host' => 'zend-macaig.fjeclot.net',
        'username' => 'cn=admin,dc=fjeclot,dc=net',
        'password' => 'fjeclot',
        'bindRequiresDn' => true,
        'accountDomainName' => 'fjeclot.net',
        'baseDn' => 'dc=fjeclot,dc=net',
    ];
    
    $ldap = new Ldap($opcions);
    $ldap->bind();
    $entrada = $ldap->getEntry($dn);
    if ($entrada){
        Attribute::setAttribute($entrada, $atribut, $nou_contingut);
        $ldap->update($dn, $entrada);
        echo "Atribut modificat";
    } else echo "<b>Aquesta entrada no existeix</b><br><br>";
}
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
    UID: <input type="text" name="uid"><br>
    Unidad Organizativa: <input type="text" name="unorg"><br>
    Nuevo Contenido: <input type="text" name="nou_contingut"><br>
    Atributo: <br>
    <input type="radio" name="atribut" value="uidNumber"> uidNumber<br>
    <input type="radio" name="atribut" value="gidNumber"> gidNumber<br>
    <input type="radio" name="atribut" value="homeDirectory"> Directori personal<br>
    <input type="radio" name="atribut" value="loginShell"> Shell<br>
    <input type="radio" name="atribut" value="cn"> cn<br>
    <input type="radio" name="atribut" value="sn"> sn<br>
    <input type="radio" name="atribut" value="givenName"> givenName<br>
    <input type="radio" name="atribut" value="postalAddress"> PostalAdress<br>
    <input type="radio" name="atribut" value="mobile"> mobile<br>
    <input type="radio" name="atribut" value="telephoneNumber"> telephoneNumber<br>
    <input type="radio" name="atribut" value="title"> title<br>
    <input type="radio" name="atribut" value="description"> description<br>
    <input type="submit" value="MODIFICAR USUARIO">
</form>
<form action="principal.php">
    <input type="submit" value="Volver">
</form>