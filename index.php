<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	</head>
	<body>
		<div style="margin: 50px 0px 0px 0px; text-align: center;"><h1>Task Scheduler</h1></div>
		<div style="margin: 10px 50px 50px 50px">
			<div style="text-align: right;"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">ADD Task</button></div>
			<table id="example" class="display table table-striped table-bordered table-hover" style="width:100%">
		        <thead>
		            <tr>
		            	<th>ID</th>
		                <th>Title</th>
		                <th>Description</th>
		                <th>Deadline Date</th>
		                <th>Priority</th>
		                <th>Assign Person</th>
		                <th>Action</th>
		            </tr>
		        </thead>
		        <tfoot>
		            <tr>
		                <th>ID</th>
		                <th>Title</th>
		                <th>Description</th>
		                <th>Deadline Date</th>
		                <th>Priority</th>
		                <th>Assign Person</th>
		                <th>Action</th>
		            </tr>
		        </tfoot>
		    </table>
		</div>
	</body>
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>	
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
		    $('#example').DataTable( {
		        "processing": true,
		        "searching":false,
		        "order": [[ 0, "desc" ]],
		        "ajax": "server.php?request=get_data"
		    } );
		} );
	</script>
	<script>
		$(document).ready(function () {
            var startDate = new Date();
            startDate.setDate(startDate.getDate());
            
            $('.datepicker').datepicker({ 
            	format: 'dd-mm-yyyy',
                startDate: startDate,
				autoclose: true
            });
        });
  	</script>
	<script>
		$(document).ready(function() { 
			$("#frmSetTask").submit(function(e){
				$.ajax({
					type: "POST",
					url: "server.php?request=set_task",
					data: $("#frmSetTask").serialize(),
					success:function(data){
						var task = jQuery.parseJSON(data);
						if(task["error"]==true){
							$("#divError").html(task["msg"]);
							$("#divError").fadeIn('fast').delay(6000).fadeOut('slow');
						}
						else{
							$("#divSuccess").html(task["msg"]);
							$("#divSuccess").fadeIn('fast').delay(6000).fadeOut(function(){
									location.reload();
								}
							);                            
						}
					}
				});e.preventDefault();
			});
		});
	</script>
	<script type="text/javascript">
		function setTaskId(task_id){
			$('#task_id').val(task_id);
		}
		function setEmp(employee_id,task_id){
			$.ajax({
				type: "POST",
				url: "server.php?request=assign_emp&employee_id="+employee_id+"&task_id="+task_id,
				success:function(data){
					var task = jQuery.parseJSON(data);
					if(task["error"]==true){
						$("#divAssignError").html(task["msg"]);
						$("#divAssignError").fadeIn('fast').delay(6000).fadeOut('slow');
					}
					else{
						location.reload();                            
					}
				}
			});
		}
	</script>
	<!-- Modal -->
	<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	    	<form id="frmSetTask">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalCenterTitle">Create New Task</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	<div id="divSuccess" style="display: none;" class="alert alert-success" role="alert"></div>
		      	<div id="divError" style="display: none;" class="alert alert-danger" role="alert"></div>
			    <div class="form-group">
				    <input type="text" class="form-control" id="title" name="title" aria-describedby="titleHelp" required="true" placeholder="Title"><!-- 
				    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
				</div>
			    <div class="form-group">
				    <textarea class="form-control" id="description" name="description" aria-describedby="descriptionHelp" required="true" placeholder="Description"></textarea><!-- 
				    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
				</div>
			    <div class="form-group">
				    <input type="text" class="form-control datepicker" id="deadline" name="deadline" aria-describedby="deadlineHelp" required="true" placeholder="Deadline Date"><!-- 
				    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
				</div>
			    <div class="form-group">
				    <!-- <label for="exampleInputDeadline">Select Task Priority</label> -->
				    <select class="form-control" id="priority_id" name="priority_id" required="true">
				    	<option value="">Select Task Priority</option>
				    	<?php require 'priority.php';
				    	echo $priority; ?>
				    </select><!-- 
				    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
				</div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		        <button type="submit" class="btn btn-primary">Save</button>
		      </div>
			</form>
	    </div>
	  </div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="editModal" data-backdrop="static" tabindex="-1"role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
	    <div class="modal-content">
	    	<form id="frmAssign">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalCenterTitle">Assign New Employee</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	<div id="divAssignError" style="display: none;" class="alert alert-danger" role="alert"></div>
			    <div class="form-group">
				    <input type="hidden" id="task_id" name="task_id"/>
				    <!-- <label for="exampleInputDeadline">Select Task Priority</label> -->
				    <select class="form-control" id="priority_id" name="priority_id" required="true" onchange="setEmp(this.value,task_id.value)">
				    	<option value="">Select Employee</option>
				    	<?php require 'emp_list.php';
				    	echo $string; ?>
				    </select><!-- 
				    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
				</div>
		      </div>
		      <div class="modal-footer">
		        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="submit" class="btn btn-primary">Save changes</button> -->
		      </div>
			</form>
	    </div>
	  </div>
	</div>
</html>