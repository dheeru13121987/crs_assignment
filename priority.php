<?php
require 'server_connection.php';
$sql = "SELECT id, type, detail FROM priority";
$result = $conn->query($sql);
$task = array();
$priority = "";

if ($result->num_rows > 0) {
    $task = $result->fetch_all();
    foreach ($task as $key => $value) {
    	$priority .= "<option value='$value[0]'>$value[1]</option>";
    }
}
$conn->close();
?>