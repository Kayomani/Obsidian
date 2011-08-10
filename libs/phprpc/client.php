
<?php
include ("phprpc_client.php");
$client = new PHPRPC_Client('http://129.0.0.1/work/obsidian/libs/phprpc/server.php');
$client->setTimeout(5);
$client->setEncryptMode(3);
try {
$out = $client->HelloWorld();
echo $out;
}
catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

?>
