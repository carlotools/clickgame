<?php
$data = file_get_contents("php://input");
file_put_contents("results.txt", $data . "\n", FILE_APPEND);
echo "OK";
?>
