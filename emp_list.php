<?php
require 'server_connection.php';
$sql = "SELECT id, name, designation FROM employee";
$result = $conn->query($sql);
$task = array();
$string = "";

if ($result->num_rows > 0) {
    $task = $result->fetch_all();
    foreach ($task as $key => $value) {
    	$string .= "<option value='$value[0]'>$value[1] ($value[0],$value[2])</option>";
    }
}
$conn->close();
?>