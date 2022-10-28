<?php
    //INCLUDE DATABASE FILE
    include('database.php');

    //ROUTING
    if(isset($_POST['save']))        saveTask($connect);
    if(isset($_POST['update']))      updateTask();
    if(isset($_POST['delete']))      deleteTask();
    

    function getTasks($connect, $a){
        $sql = "SELECT * FROM tasks where status_id=$a";
        $result = mysqli_query($connect, $sql);

        while($row = mysqli_fetch_assoc($result)){
                echo '
            <button class="bg-white w-100 border-0 border-top d-flex py-2 " >
                <div class="px-2">
                    <i class="${icon}"></i> 
                </div>
                <div class="text-start ">
                    <div class="h6">'.$row["title"].'</div>
                    <div class="text-start">
                        <div class="text-gray">'.$row["id"].' created in '.$row["task_datetime"].'</div>
                        <div title="'.$row["description"].'">'.$row["description"].'</div>
                    </div>
                    <div class="">
                        <span class="btn btn-primary">'.$row["priority_id"].'</span>
                        <span class="btn btn-light text-black">'.$row["type_id"].'</span>
                    
                    </div>
                </div>
                <div class="delete-icon">
                <i" class="py-2 px-2 bi bi-trash"></i>
                </div>
                <div class="edit-icon">
                <i data-bs-toggle="modal" data-bs-target="#modal-task" class="py-2 px-2 bi bi bi-pencil-square"></i>
                </div>
            </button>';
            }
        

    }


    function saveTask($connect) {
        $title = $_POST['title'];
        $type = $_POST['type'];
        $priority = $_POST['priority'];
        $status = $_POST['status'];
        $datetime = $_POST['date'];
        $description = $_POST['description'];

        $sql = "INSERT INTO tasks VALUES (null, '$title', '$type', '$priority', '$status', '$datetime', '$description')";
        //validating use input data
        if(empty($title) || empty($type) || empty($priority) || empty($status) || empty($datetime) || empty($description)){
            echo "Please fill all the fields";
        } else {
            //inserting into database
            $result = mysqli_query($connect, $sql);
            if($result){
                echo "Data inserted successfully";
            //If data is inserted seccessfully go back to the main page
                header('location: index.php');
            }else {
                echo "Data not inserted";
            }
        }
    }

    // function updateTask()
    // {
    //     //CODE HERE
    //     //SQL UPDATE
    //     $_SESSION['message'] = "Task has been updated successfully !";
	// 	header('location: index.php');
    // }

    // function deleteTask()
    // {
    //     //CODE HERE
    //     //SQL DELETE
    //     $_SESSION['message'] = "Task has been deleted successfully !";
	// 	header('location: index.php');
    // }

?>