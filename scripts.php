<?php
    //INCLUDE DATABASE FILE
    include('database.php');

    //ROUTING
    if(isset($_POST['save']))        saveTask($connect);
    if(isset($_POST['update']))      updateTask();
    if(isset($_POST['delete'])){
        deleteTask();
    };
    

    function getTasks($connect, $a){
        $sql = "SELECT * FROM tasks JOIN types ON tasks.type_id=types.id_t JOIN priorities ON tasks.priority_id=priorities.id_p WHERE status_id=$a";
        $result = mysqli_query($connect, $sql);

        while($row = mysqli_fetch_assoc($result)){
            $id = $row['id'];
                echo '
            <form action="form.php" method="post" >
            <button type="submit"  class="bg-white w-100 border-0 border-top d-flex py-2 " >
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
                        <span class="btn btn-primary">'.$row["name_p"].'</span>
                        <span class="btn btn-light text-black">'.$row["name_t"].'</span>
                    
                    </div>
                </div>
                
              
                <input type="hidden" name="task-id" value="'.$id.'">
            </button>
            </form>'
            ;
            }

    }


    function saveTask($connect) {
        $title = $_POST['title'];

        $type = $_POST['type'];
        if($type == 'Feature'){
            $types = 1;
        }else $types = 2;
        $priority = $_POST['priority'];
        $status = $_POST['status'];
        $datetime = $_POST['date'];
        $description = $_POST['description'];

        $sql = "INSERT INTO tasks VALUES (null, '$title', '$types', '$priority', '$status', '$datetime', '$description')";
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

    function updateTask(){
        global $connect;
        $formid=$_POST["form_id"];
        $title = $_POST['title'];
        $type = $_POST['type'];
        if($type == 'Feature'){
            $types = 1;
        }else $types = 2;
        $priority = $_POST['priority'];
        $status = $_POST['status'];
        $datetime = $_POST['date'];
        $description = $_POST['description'];
        
 
        $sql = "UPDATE tasks set title = '$title', type_id = '$types' , priority_id = '$priority' , status_id = '$status' , task_datetime = '$datetime' , description = '$description' WHERE id ='$formid'";
        $result = mysqli_query($connect, $sql);

        //CODE HERE
        //SQL UPDATE
		header('location: index.php');
    }

    function deleteTask()
    {
        global $connect;

        $formid=$_POST["form_id"];
			
		$sql = "DELETE FROM tasks WHERE id='$formid'";
        mysqli_query($connect,$sql);
		header('location:index.php');
        //CODE HERE
        //SQL DELETE
		
    }

    function countTask($num){
        global $connect;

        $sql="SELECT * FROM tasks where status_id=$num";
        if ($result=mysqli_query($connect,$sql)){
        $rowcount=mysqli_num_rows($result);
        printf("%d",$rowcount);
        }
    }


?>