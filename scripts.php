<?php
    //INCLUDE DATABASE FILE
    include('database.php');

    //ROUTING
    if(isset($_POST['save']))        saveTask($connect);
    if(isset($_POST['update']))      updateTask();
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        deleteTask($id);
    };
    

    function getTasks($connect, $a){
        $sql = "SELECT * FROM tasks WHERE status_id=$a";
        $result = mysqli_query($connect, $sql);

        while($row = mysqli_fetch_assoc($result)){
            $id = $row['id'];
                echo '
            <button onclick="addTaskForm()" class="bg-white w-100 border-0 border-top d-flex py-2 " >
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
                <a  href="index.php?id='.$id.'"><i class="py-2 px-2 bi bi-trash"></i></a>
                </div>
                <div class="edit-icon">
                <a href="form.php?id='.$id.'"><i class="py-2 px-2 bi bi bi-pencil-square"></i></a>
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

    function updateTask()
    {
        //CODE HERE
        //SQL UPDATE
        $_SESSION['message'] = "Task has been updated successfully !";
		header('location: index.php');
    }

    function deleteTask($id)
    {
       /*  $id = $_GET['id']; */
        $sql = "DELETE FROM tasks WHERE id='$id'";
        global $connect;
        $result = mysqli_query($connect, $sql);
    
        if(isset($result)){
            header('location:index.php');
        }
        // //CODE HERE
        // //SQL DELETE
        // $_SESSION['message'] = "Task has been deleted successfully !";
		// header('location: index.php');
    }

?>