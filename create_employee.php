<?php

include_once 'config/Database.php';
include_once 'models/Employee.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// pass connection to model
$employee = new Employee($db);

$page_title = "Create Employee";
include_once "header.php";
 
echo "<div class='right-button-margin float-lg-right'>";
    echo "<a href='index.php' class='btn btn-primary'>See Employees</a>";
echo "</div>";
 
?>

 <?php 

if($_POST){
 
    
    $employee->employee_name = $_POST['emp_name'];
    $employee->employee_monthly_salary = $_POST['salary'];
 
    
    if($employee->create()){
        header("Location:index.php?message=Employee added successfully"); /* Redirect browser */
        echo "<div class='alert alert-success'>Employee added successfully.</div>";
    }
 
    
    else{
        echo "<div class='alert alert-danger'>Could not create Employee.</div>";
    }
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
 
    <table class='table table-hover table-sm table-bordered'>
 
        <tr>
            <td>Employee Name</td>
            <td><input type='text' name='emp_name' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Monthly Salary</td>
            <td><input type='number' name='salary' class='form-control' lang="en" /></td>
        </tr>
 
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Add Employee</button>
            </td>
        </tr>
 
    </table>
</form>
<?php
 ?>
