<?php
    //INCLUDE DATABASE FILE
    include('database.php');

    //SESSSION IS A WAY TO STORE DATA TO BE USED ACROSS MULTIPLE PAGES
    session_start();

    //ROUTING
    if(isset($_POST['save']))        saveTask();
    if(isset($_POST['update']))      updateTask();
    if(isset($_POST['delete']))      deleteTask();
    
/*********************************************************************************************************************/
/*/////////////////////////////////////////////  Display Function  //////////////////////////////////////////////////*/
/*********************************************************************************************************************/

    function getTasks($status)
    {
        global $connect;

        $sql = "SELECT * FROM tasks 
        INNER JOIN types ON tasks.type_id=types.id_t 
        INNER JOIN priorities ON tasks.priority_id=priorities.id_p 
        WHERE status_id=$status";
        
        $result = mysqli_query($connect, $sql);
        $count = 0;
        while($row = mysqli_fetch_assoc($result)){
            $count++;
            if($status == 1){
                $status = "bi bi-question-circle text-green";
            }else if($status == 2){
                $status = "fa fa-circle-notch text-green";
            }else if($status == 3) {
                $status = "bi bi-check-circle text-green" ;
            }

            (strlen($row["description"]) > 50) ? $desc = substr($row["description"],0,50).'...' : $desc = $row["description"];

            echo
            '<form action="form.php" method="post">
                <button type="submit" class="bg-white w-100 border-0 border-top d-flex py-2 " >
                    <div class="px-2">
                        <i class="'.$status.'"></i> 
                    </div>
                    <div class="text-start ">
                        <div class="h6">'.$row["title"].'</div>
                        <div class="text-start mb-1">
                            <div class="text-gray">'.$count.' created in '.$row["task_datetime"].'</div>
                            <div title="'.$row["description"].'">'.$desc.'</div>

                        </div>
                        <div class="">
                            <span class="btn btn-primary">'.$row["name_p"].'</span>
                            <span class="btn btn-light text-black">'.$row["name_t"].'</span>
                        
                        </div>
                    </div>
                    <input type="hidden" name="task-id" value="'.$row["id"].'">
                </button>
            </form>';
        }
    }

/*********************************************************************************************************************/
/*/////////////////////////////////////////////  Save New Task Function  ////////////////////////////////////////////*/
/*********************************************************************************************************************/

    function saveTask() {
        global $connect;

        //Store the values from the inputs of the form into variables
        $title = $_POST['title'];
        $type = $_POST['type'];
        if($type == "feature"){
            $types = 1;
        }else{$types = 2;} 
        $priority = $_POST['priority'];
        $status = $_POST['status'];
        $datetime = $_POST['date'];
        $description = $_POST['description'];

    
        $sql = "INSERT INTO tasks VALUES (null, '$title', '$types', '$priority', '$status', '$datetime', '$description')";
        mysqli_query($connect, $sql);
        //variable sessions 
        $_SESSION['message'] = "Task has been added successfully !";
        header('location: index.php');
    }

 
        
/*********************************************************************************************************************/
/*/////////////////////////////////////////////  Update Function  ///////////////////////////////////////////////////*/
/*********************************************************************************************************************/

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
        $result = mysqli_query($connect, $sql); /// return result of execution or bolean

        $_SESSION['message'] = "Task has been updated successfully !";
		header('location: index.php');
    }

/*********************************************************************************************************************/
/*/////////////////////////////////////////////  Delete Function  ///////////////////////////////////////////////////*/
/*********************************************************************************************************************/

    function deleteTask()
    {
        global $connect;

        $formid = $_POST["form_id"];
		$sql = "DELETE FROM tasks WHERE id='$formid'";
        mysqli_query($connect,$sql);

        $_SESSION['message'] = "Task has been deleted successfully !";
        header('location:index.php');

    }

/*********************************************************************************************************************/
/*/////////////////////////////////////////////  Task Counter Function  /////////////////////////////////////////////*/
/*********************************************************************************************************************/

    function countTask($num){
        global $connect;

        $sql = "SELECT * FROM tasks where status_id = $num";
        if ($result = mysqli_query($connect,$sql)){
        $rowcount = mysqli_num_rows($result);
        printf("%d", $rowcount);
        }
    }

?>