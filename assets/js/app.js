//Targeted the three divs (to do task, in progress task, and done task) and put them into variables for easy access
const toDoTask = document.querySelector("#to-do-tasks");
const inProgress = document.querySelector("#in-progress-tasks");
const doneTask = document.querySelector("#done-tasks");

//Targeted the three spans that represent the number of how many tasks in each div 
const counterToDo = document.querySelector("#to-do-tasks-count");
const counterInProgress = document.querySelector("#in-progress-tasks-count");
const counterDone = document.querySelector("#done-tasks-count");

/*********************************************************************************************************************/
/*/////////////////////////////////////////////  Display Function  //////////////////////////////////////////////////*/
/*********************************************************************************************************************/


function afficherData() { 
    //Empty my divs from any HTML elements
    toDoTask.innerHTML = "";
    inProgress.innerHTML = "";
    doneTask.innerHTML = "";

    //Declare a variable that its value changes depending on the status of the task (if status == "To Do" then temp = ToDoTask)
    let temp;

    //Declare three counters that get incremented each iteration of the loop
    let tdo = 0, prog = 0, done = 0;

    //Loop through the objects in the array
    for(let i = 0; i < tasks.length; i++){

        let icon, desc;

        //The value of the three variables temp, icon and (tdo, prog, done) change each iteration of the loop
        if(tasks[i].status === "To Do"){temp = toDoTask ; icon = "bi bi-question-circle text-green" ; tdo++} 
        else if (tasks[i].status === "In Progress"){temp = inProgress ; icon = "fa fa-circle-notch text-green"; prog++} 
        else if (tasks[i].status === "Done") {temp = doneTask; icon = "bi bi-check-circle text-green"; done++} 

        //Cuts the long description into a short one
        (tasks[i].description.length > 50) ? desc = tasks[i].description.substring(0,50) : desc = tasks[i].description;

        //Injected the task into HTML depending on the value of temp (and the icon changes too with each new button created)
        temp.innerHTML += 
        `<button class="bg-white w-100 border-0 border-top d-flex py-2 " >
            <div class="px-2">
                <i class="${icon}"></i> 
            </div>
            <div class="text-start ">
                <div class="h6">${tasks[i].title}</div>
                <div class="text-start">
                    <div class="text-gray">#${i+1} created in ${tasks[i].date}</div>
                    <div title="${tasks[i].description}">${desc}...</div>
                </div>
                <div class="">
                    <span class="btn btn-primary">${tasks[i].priority}</span>
                    <span class="btn btn-light text-black">${tasks[i].type}</span>
                
                </div>
            </div>
            <div class="delete-icon">
            <i onclick="deleteTask(${i})" class="py-2 px-2 bi bi-trash"></i>
            </div>
            <div class="edit-icon">
            <i data-bs-toggle="modal" data-bs-target="#modal-task" onclick="updateTask(${i})" class="py-2 px-2 bi bi bi-pencil-square"></i>
            </div>
        </button>`;
   
    }
    // Put the final value of the counters into the span 
    counterToDo.innerText = tdo;
    counterInProgress.innerText = prog;
    counterDone.innerText = done;
}
/*********************************************************************************************************************/
/*/////////////////////////////////////////////  Save New Task Function  ////////////////////////////////////////////*/
/*********************************************************************************************************************/


function saveNewTask(){
    //Grab the value inside each input of the modal and put it in a variable
    const title = document.querySelector("#Title").value;
    const type = document.querySelector("input[name='type']:checked").value;
    const priority = document.querySelector("#Priority").value;
    const status = document.querySelector("#Status").value;
    const date = document.querySelector("#Date").value;
    const description = document.querySelector("#Description").value;

    //Declara a variable 'task' and store an object in it with the values from the variables you declared above
    let task = {
        title: title,
        type: type,
        priority: priority,
        status: status,
        date:  date,
        description: description,
    }
    //Add the new 'task' you created in your array
    tasks.push(task);
    //Re-display your new version of the array so the new task you added is shown too with them
    afficherData();
    //Empty the inputs of the modal, so the next time its shown without the infomation of the previous task
    reloadTasks();
}

/*********************************************************************************************************************/
/*/////////////////////////////////////////////  Delete a Task Function  ////////////////////////////////////////////*/
/*********************************************************************************************************************/

function deleteTask(i){
    //In the parameter I pass the index (the position of the object in the array)
    //The value of "i" is assigned when a task is first created
    tasks.splice(i,1) // Go to the position of the object (i) in the array and delete it
    afficherData(); // Redisplay the new version of the array with the task deleted this time
}

/*********************************************************************************************************************/
/*/////////////////////////////////////////////  Edit Function  /////////////////////////////////////////////////////*/
/*********************************************************************************************************************/

function editTask(i){
    //Update a task (This function will run when you click on the button UPDATE)

    //The value of 'i' is assinged when the button is first displayed
    //Select the value of of each of your inputs and put it in a variable
    const title = document.querySelector("#Title").value;
    const type = document.querySelector("input[name='type']:checked").value;
    const priority = document.querySelector("#Priority").value;
    const status = document.querySelector("#Status").value;
    const date = document.querySelector("#Date").value;
    const description = document.getElementById("Description").value;
    //Create an object 'task' and store the values of the inputs you modified
    let task = {
      title: title,
      type: type,
      priority: priority,
      status: status,
      date:  date,
      description:description
    }
    //Reassign the inputs of the task you first clicked with the values of the new task you modified
    tasks[i]=task;
    //Hide the modal
    $('#modal-task').modal('hide');
    //Redisplay the new version of the array
    afficherData();
    //Empty the modal
    reloadTasks();
}

/*********************************************************************************************************************/
/*/////////////////////////////////////////////  Update Function ////////////////////////////////////////////////////*/
/*********************************************************************************************************************/


function addTaskForm(){
    //This function will run each time you click on (+ ADD TASK)

    //Empty the modal from any values
    reloadTasks();
   //Display the modal 
    $('#modal-task').modal('show');
    //Replace the footer of the modal with only the "cancel" & "save" buttons
    //Give the button of SAVE, the function of saveNewTask()
    document.getElementById("footerModal").innerHTML=`<button type="button" class="btn btn-light text-black border" data-bs-dismiss="modal">Cancel</button>
    <button onclick="saveNewTask()" type="button" class="btn btn-primary" data-bs-dismiss="modal">Save</button>`
}

/**********************************************************************************************************************/
/*/////////////////////////////////////////////  Reset Function  /////////////////////////////////////////////////////*/
/**********************************************************************************************************************/


function reloadTasks() {
    //This function resets the modal

    //Empty your inputs from any existing value
    document.getElementById("Title").value='';
    document.querySelector("input[name='type']:checked").value="";
    document.getElementById("Priority").value="";
    document.getElementById("Status").value="";
    document.getElementById("Date").value="";
    document.getElementById("Description").value="";
}

/*********************************************************************************************************************/
/*/////////////////////////////////////////////  Update Function  ///////////////////////////////////////////////////*/
/*********************************************************************************************************************/

function updateTask(i){
    //This function will run each time you click on the edit icon 

    //Display the modal
    $('#modal-task').modal('show');
    //Show the footer of the modal with only the "Cancel" & "Update" buttons
    //Give the button of UPDATE the function editTask()
    document.getElementById("footerModal").innerHTML=`<button type="button" class="btn btn-light text-black border" data-bs-dismiss="modal">Cancel</button>
    <button onclick="editTask(${i})"  type="button" class="btn btn-primary" data-bs-dismiss="modal">Update</button>`
    
    //Fill this modal with the information of the task[i] ('i' is assigned when the icon is created)
    document.getElementById("Title").value = tasks[i].title;
    if(tasks[i].type=="Feature"){
        document.getElementById("ft").checked = true
    }else{
        document.getElementById("bug").checked = true
    }
    document.querySelector("input[name='type']:checked").value = tasks[i].type;
    document.getElementById("Priority").value = tasks[i].priority;
    document.getElementById("Status").value = tasks[i].status;
    document.getElementById("Date").value = tasks[i].date;
    document.getElementById("Description").value=tasks[i].description;
}



afficherData();

