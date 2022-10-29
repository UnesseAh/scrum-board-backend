
<!DOCTYPE html>
<html lang="en" >
<head>
	<meta charset="utf-8" />
	<title>YouCode | Scrum Board</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
<!-- ================== BEGIN core-css ================== -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" >
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<link href="assets/css/vendor.min.css" rel="stylesheet" />
	<link href="assets/css/default/app.min.css" rel="stylesheet" />
	<link href="assets/css/style.css" rel="stylesheet" />
	<!-- ================== END core-css ================== -->



<?php
    include 'database.php';

    $id = $_GET['id'];
    $sql = "SELECT * FROM tasks WHERE id ='$id'";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);

    $title = $row['title'];
    $type = $row['type_id'];
    $priority = $row['priority_id'];
    $status = $row['status_id'];
    $date = $row['task_datetime'];
    $description = $row['description'];

	echo '
    <button data-bs-toggle="#modal-task" id="form" data-bs-target="modal" class="btn btn-success rounded-pill"></a>
    <script>form.click();</script>
    <div class="modal fade " id="modal-task" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
					
				<div class="modal-header">
					<h5 class="modal-title">Add Task</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				
				<form action="scripts.php" method="POST">
				<div class="modal-body">
					<div class="mb-3">
						<label for="recipient-name" class="col-form-label">Title</label>
						<input value="'.$title.'" type="text" class="form-control" id="title" name="title" required>
					</div>
					<div class="mb-3">
						<label for="" class="col-form-label">Type</label>
						<div class="form-check ms-3">
							<input value="feature" class="form-check-input" type="radio" name="type" id="ft" checked>
							<label class="form-check-label" for="flexRadioDefault1">
							Feature
							</label>
						</div>
						<div class="form-check ms-3">
							<input value="bug" class="form-check-input" type="radio" name="type" id="bug">
							<label class="form-check-label" for="flexRadioDefault2">
								Bug
							</label>
						</div>
					</div>
					<div class="mb-3">
						<label for="Priority" class="col-form-label">Priority</label>
						<select class="form-select" aria-label="Default select example" id="Priority" name="priority" required>
							<option selected disabled>Please select</option>
							<option value="Low">Low</option>
							<option value="Medium">Medium</option>
							<option value="High">High</option>
							<option value="Critical">Critical</option>

						</select>
					</div>
					<div class="mb-3">
						<label for="Status" class="col-form-label">Status</label>
						<select class="form-select" aria-label="Default select example" id="Status" name="status" required>
							<option selected disabled>Please select</option>
							<option value="1">To Do</option>
							<option value="2">In Progress</option>
							<option value="3">Done</option>
						</select>
					</div>
					<div class="mb-3">
						<label for="Date" class="col-form-label">Date</label>
						<input value="'.$date.'" type="datetime-local" class="form-control" id="Date" name="date" required>
					</div>
					<div class="mb-3">
						<label for="message-text" class="col-form-label">Description</label>
						<textarea class="form-control" id="Description" name="description" required>'.$description.'</textarea>
					</div>
				</div>
				<div class="modal-footer" id="footerModal">
						<button href="#" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="delete" class="btn btn-danger task-action-btn" id="task-delete-btn">Delete</button>
                        <button type="submit" name="update" class="btn btn-warning task-action-btn" id="task-update-btn">Update</button>
				</div>
				</form>
			</div>
		</div>
	</div>';
?>
</html>
<script src="assets/js/vendor.min.js"></script>
	<script src="assets/js/app.min.js"></script>
	<!-- <script src="assets/js/data.js"></script> -->
	<!-- <script src="assets/js/app.js"></script> -->
	<script src="scripts.js"></script>
