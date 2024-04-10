<?php
    require 'vendor/autoload.php';
    use Laminas\Ldap\Attribute;
    use Laminas\Ldap\Ldap;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    ini_set('display_errors', 0);

    $uid = $_POST['uid'];
    $unorg = $_POST['unitat_organitzativa'];
    $num_id = $_POST['uidNumber'];
    $grup = $_POST['gidNumber'];
    $dir_pers = $_POST['directori_personal'];
    $sh = $_POST['shell'];
    $cn = $_POST['cn'];
    $sn = $_POST['sn'];
    $nom = $_POST['givenName'];
    $mobil = $_POST['mobile'];
    $adressa = $_POST['postalAddress'];
    $telefon = $_POST['telephoneNumber'];
    $titol = $_POST['title'];
    $descripcio = $_POST['description'];
    $objcl = array('inetOrgPerson','organizationalPerson','person','posixAccount','shadowAccount','top');

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
    $nova_entrada = [];
    Attribute::setAttribute($nova_entrada, 'objectClass', $objcl);
    Attribute::setAttribute($nova_entrada, 'uid', $uid);
    Attribute::setAttribute($nova_entrada, 'uidNumber', $num_id);
    Attribute::setAttribute($nova_entrada, 'gidNumber', $grup);
    Attribute::setAttribute($nova_entrada, 'homeDirectory', $dir_pers);
    Attribute::setAttribute($nova_entrada, 'loginShell', $sh);
    Attribute::setAttribute($nova_entrada, 'cn', $cn);
    Attribute::setAttribute($nova_entrada, 'sn', $sn);
    Attribute::setAttribute($nova_entrada, 'givenName', $nom);
    Attribute::setAttribute($nova_entrada, 'mobile', $mobil);
    Attribute::setAttribute($nova_entrada, 'postalAddress', $adressa);
    Attribute::setAttribute($nova_entrada, 'telephoneNumber', $telefon);
    Attribute::setAttribute($nova_entrada, 'title', $titol);
    Attribute::setAttribute($nova_entrada, 'description', $descripcio);
    $dn = 'uid='.$uid.',ou='.$unorg.',dc=fjeclot,dc=net';
    if($ldap->add($dn, $nova_entrada)) echo "USUARI CREAT";
}
?>


<style>
form {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    width: 300px; 
}

form input[type="text"] {
    width: 30%;
    padding: 7px;
    margin: 5px 0;
    box-sizing: border-box;
	width: 100%;
    margin-bottom: 10px; 
}

form input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

form input[type="submit"]:hover {
    opacity: 0.8;
}


</style>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"><br>
    uid: <input type="text" name="uid"><br>
    unitat organitzativa: <input type="text" name="unitat_organitzativa"><br>
    uidNumber: <input type="text" name="uidNumber"><br>
    gidNumber: <input type="text" name="gidNumber"><br>
    Directori personal: <input type="text" name="directori_personal"><br>
    Shell: <input type="text" name="shell"><br>
    cn: <input type="text" name="cn"><br>
    sn: <input type="text" name="sn"><br>
    givenName: <input type="text" name="givenName"><br>
    PostalAdress: <input type="text" name="postalAddress"><br>
    mobile: <input type="text" name="mobile"><br>
    telephoneNumber: <input type="text" name="telephoneNumber"><br>
    title: <input type="text" name="title"><br>
    description: <input type="text" name="description"><br>
    <input type="submit">
</form>
