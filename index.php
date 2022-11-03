<?php 
	include('scripts.php');
?>

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
</head>
<body>
	<!-- BEGIN #app -->
	<div id="app" class="app-without-sidebar">
		<!-- BEGIN #content -->
		<div id="content" class="app-content main-style">
			<div class="nav d-flex justify-content-between">
				<div>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
						<li class="breadcrumb-item active">Scrum Board </li>
					</ol>
					<!-- BEGIN page-header -->
					<h1 class="page-header">
						Scrum Board 
					</h1>
					<?php if (isset($_SESSION['message'])): ?>
					<div class="alert alert-green alert-dismissible fade show">
					<strong>Success!</strong>
					<?php 
						echo $_SESSION['message']; 
						unset($_SESSION['message']);
					?>
					<button type="button" class="btn-close" data-bs-dismiss="alert"></span>
				</div>
				<?php endif ?>
                	
                    
                
					<!-- END page-header -->
				</div>
				
				<div class="">
					<button class="btn btn-success rounded-pill" onclick="addTaskForm()"><i class="bi bi-plus-lg"></i> Add Task</a>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-4 col-md-6 col-sm-12">
					<div class="card">
						<div class="card-header bg-dark  py-1">
						<h4 class="text-white m-0">To do (<span id="to-do-tasks-count"><?php countTask(1) ?></span>)</h4>
						</div>
						<div class="" id="to-do-tasks">
							<!-- TO DO TASKS HERE -->
							<?php
						
							getTasks(1);
							?>

						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12">
					<div class="card">
						<div class="card-header bg-dark py-1">
							<h4 class="text-white m-0">In Progress (<span id="in-progress-tasks-count"><?php countTask(2); ?></span>)</h4>

						</div>
						<div class="" id="in-progress-tasks">
							<!-- IN PROGRESS TASKS HERE -->
							<?php
							getTasks(2);
							?>
							
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12">
					<div class="card">
						<div class="card-header bg-dark py-1">
							<h4 class="text-white m-0">Done (<span id="done-tasks-count"><?php countTask(3); ?></span>)</h4>

						</div>
						<div class="" id="done-tasks">
							<!-- DONE TASKS HERE -->
							<?php
							getTasks(3);
							?>
							
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END #content -->
		
		
		<!-- BEGIN scroll-top-btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
		<!-- END scroll-top-btn -->
	</div>
	<!-- END #app -->
	
	<!-- TASK MODAL -->
	<div class="modal fade " id="modal-task" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
					
				<div class="modal-header">
					<h5 class="modal-title">Add Task</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				
				<form id="formModal" action="scripts.php" method="POST">
				<div class="modal-body">
					<div class="mb-3">
						<label for="recipient-name" class="col-form-label">Title</label>
						<input  type="text" class="form-control" id="title" name="title" required>
					</div>
					<div class="mb-3">
						<label for="" class="col-form-label">Type</label>
						<div class="form-check ms-3">
							<input value="feature" class="form-check-input" type="radio" name="type" value="type" id="ft" checked>
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
							<option selected disabled value="">Please select</option>
							<option value="1">Low</option>
							<option value="2">Medium</option>
							<option value="3">High</option>
							<option value="4">Critical</option>

						</select>
					</div>
					<div class="mb-3">
						<label for="Status" class="col-form-label">Status</label>
						<select class="form-select" aria-label="Default select example" id="Status" name="status" required>
							<option selected disabled value="">Please select</option>
							<option value="1">To Do</option>
							<option value="2">In Progress</option>
							<option value="3">Done</option>
						</select>
					</div>
					<div class="mb-3">
						<label for="Date" class="col-form-label">Date</label>
						<input type="datetime-local" class="form-control" id="Date" name="date" required>
					</div>
					<div class="mb-3">
						<label for="message-text" class="col-form-label">Description</label>
						<textarea class="form-control" id="Description" name="description" required></textarea>
					</div>
				</div>
				<div class="modal-footer" id="footerModal">
						<button href="index.php" class="btn btn-white" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="save" class="btn btn-primary task-action-btn" id="task-save-btn">Save</button>
				</div>
				</form>
			</div>
		</div>
	</div>
	
	<!-- ================== BEGIN core-js ================== -->
	<script src="assets/js/vendor.min.js"></script>
	<script src="assets/js/app.min.js"></script>
	<!-- <script src="assets/js/data.js"></script> -->
	<!-- <script src="assets/js/app.js"></script> -->
	<script src="scripts.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!-- ================== END core-js ================== -->	

	
</body>
</html>