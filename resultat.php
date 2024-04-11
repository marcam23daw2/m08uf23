<?php
    session_start();

    if (!isset($_SESSION['usuari_autenticat']) || $_SESSION['usuari_autenticat'] !== true) {
        header("Location: info.php");
        exit();
    }

    require 'vendor/autoload.php';
    use Laminas\Ldap\Ldap;

    ini_set('display_errors', 0);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $uid = $_POST["uid"];
        $unorg = $_POST["unorg"];

        $domini = 'dc=fjeclot,dc=net';
        $opcions = [
            'host' => 'zend-macaig.fjeclot.net',
            'username' => "cn=admin,$domini",
            'password' => 'fjeclot',
            'bindRequiresDn' => true,
            'accountDomainName' => 'fjeclot.net',
            'baseDn' => 'dc=fjeclot,dc=net',
        ];  
        $ldap = new Ldap($opcions);
        $ldap->bind();
        $dn = 'uid='.$uid.',ou='.$unorg.',dc=fjeclot,dc=net';
        $entrada = $ldap->getEntry($dn);

        if ($entrada) {
            echo "Datos del usuario:<br>";
            echo "UID: " . $entrada["uid"][0] . "<br>";
            echo "Unidad Organizativa: " . $unorg . "<br>";
            echo "UID Number: " . $entrada["uidnumber"][0] . "<br>";
            echo "GID Number: " . $entrada["gidnumber"][0] . "<br>";
            echo "Directorio Personal: " . $entrada["homedirectory"][0] . "<br>";
            echo "Shell: " . $entrada["loginshell"][0] . "<br>";
            echo "CN: " . $entrada["cn"][0] . "<br>";
            echo "SN: " . $entrada["sn"][0] . "<br>";
            echo "Given Name: " . $entrada["givenname"][0] . "<br>";
            echo "Postal Address: " . $entrada["postaladdress"][0] . "<br>";
            echo "Mobile: " . $entrada["mobile"][0] . "<br>";
            echo "Telephone Number: " . $entrada["telephonenumber"][0] . "<br>";
            echo "Title: " . $entrada["title"][0] . "<br>";
            echo "Description: " . $entrada["description"][0] . "<br>";
        } else {
            echo "No se encontró el usuario";
        }
    }
?>

<button onclick="location.href='principal.php'">Volver</button>
