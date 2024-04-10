<?php
require 'vendor/autoload.php';
use Laminas\Ldap\Ldap;

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adminDn = 'cn=admin,dc=fjeclot,dc=net';
    $adminPassword = $_POST['adminpass'];
    
    $opcions = [
        'host'                   => 'zend-macaig',
        'username'               => $adminDn,
        'password'               => $adminPassword,
        'bindRequiresDn'         => true,
        'accountDomainName'      => 'fjeclot.net',
        'baseDn'                 => 'dc=fjeclot,dc=net',
    ];
    
    $ldap = new Ldap($opcions);
    
    try {
        $ldap->bind();
        setcookie('logok', 'true', time() + 86000, '/');
        
        $_SESSION['usuari_autenticat'] = true;
        header("Location: principal.php");
        exit();
    } catch (\Laminas\Ldap\Exception\LdapException $e) {
        echo "Error d'autenticació: " . $e->getMessage();
    }
    
}
?>