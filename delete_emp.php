<?php

if($_POST){
 
    
    include_once 'config/Database.php';
    include_once 'models/Employee.php';
 
    
    $database = new Database();
    $db = $database->getConnection();
 
    
    $employee = new Employee($db);
     
    
    $employee->emp_id = $_POST['object_id'];
     
    
    if($employee->delete()){
        echo "Employee deleted.";
    }
     
    
    else{
        echo "Unable to delete Employee.";
    }
}
?>