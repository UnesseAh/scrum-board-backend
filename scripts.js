function addTaskForm(){
    //This function will run each time you click on (ADD TASK)

    //Empty the modal from any values
    // reloadTasks();
   //Display the modal 
    $('.modal').modal('show');
    //Replace the footer of the modal with only the "cancel" & "save" buttons
    //Give the button of SAVE, the function of saveNewTask()
    // document.getElementById("footerModal").innerHTML=`<button type="button" class="btn btn-light text-black border" data-bs-dismiss="modal">Cancel</button>
    // <button onclick="saveNewTask()" type="button" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
    // <button type="submit" name="saveTask" class="btn btn-primary task-action-btn" id="task-save-btn">Save n</button>`
}