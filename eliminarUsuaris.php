<?php
require 'vendor/autoload.php';
use Laminas\Ldap\Ldap;

ini_set('display_errors', 0);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    if ($ldap->exists($dn)){
        $ldap->delete($dn);
        echo "Usuario eliminado";
    } else echo "<b>Este usuario no existe</b><br><br>";
}
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
    UID: <input type="text" name="uid"><br>
    Unidad Organizativa: <input type="text" name="unorg"><br>
    <input type="submit">
</form>
