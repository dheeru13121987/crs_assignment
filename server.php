<?php
require 'server_connection.php';

$request = $_REQUEST['request'];
$task = array();
$response = array();

switch ($request) {
	case 'get_data':
		$sql = "SELECT task.id, task.title, task.description, task.deadline, priority.type, employee.name FROM priority, task LEFT JOIN employee
		ON task.employee_id = employee.id WHERE task.priority_id = priority.id";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    $task = $result->fetch_all();
		    $arr = array();
		    foreach ($task as $key => $value) {
		    	array_push($value,'<a onclick=setTaskId('.$value[0].') href="#" class="btn btn-success" role="button"  data-toggle="modal" data-target="#editModal">Schedule</a>');
		    	$value[3]=date("d-m-Y", strtotime($value[3]));
		    	$arr[]=$value;
		    }
		}
		$results = array("sEcho" => 1,"iTotalRecords" => count($arr),"TotalDisplayRecords" => count($arr), "aaData"=>$arr);
		echo json_encode($results);
		break;
	case 'set_task':
		$title=$_REQUEST['title'];
		$description=$_REQUEST['description'];
		$deadline = date("y-m-d", strtotime($_REQUEST['deadline']));
		$priority_id=$_REQUEST['priority_id'];
		$employee_id = 0;
		$create_date = $update_date = date("y-m-d H:i:s");

		$stmt = $conn->prepare("INSERT INTO task(title, description, deadline, priority_id, employee_id, create_date, update_date) VALUES(?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("sssiiss",$title, $description, $deadline, $priority_id, $employee_id, $create_date, $update_date);
			$result = $stmt->execute();
			//$result=true;
			$stmt->close();
			
			if ($result) {
				$response['error']=false;
				$response['msg']="New Task Created!";
			} else {				
				$response['error']=true;
				$response['msg']="Network error, Try again!";
			}
			echo json_encode($response);
		break;
	case 'assign_emp':
		$id=$_REQUEST['task_id'];
		$employee_id=$_REQUEST['employee_id'];
		$update_date = date("y-m-d H:i:s");

		$stmt = $conn->prepare("UPDATE task SET employee_id=? , update_date=? WHERE id=?");
			$stmt->bind_param("isi",$employee_id, $update_date, $id);
			$result = $stmt->execute();
			//$result=true;
			$stmt->close();
			
			if ($result) {
				$response['error']=false;
				$response['msg']="New Employee Assign!";
			} else {				
				$response['error']=true;
				$response['msg']="Network error, Try again!";
			}
			echo json_encode($response);
		break;
	default:
		$response['error']=true;
		$response['msg']= "Wrong option given";
		echo json_encode($response);
		break;
}
$conn->close();
?>