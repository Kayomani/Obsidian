
<?php
include ("phprpc_server.php");
function HelloWorld() {
    return 'Hello World!';
}
$server = new PHPRPC_Server();
$server->add('HelloWorld');
$server->start();
?>