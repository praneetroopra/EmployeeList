<?php
$id = isset($_GET['emp_id']) ? $_GET['emp_id'] : die('ERROR: missing ID.');
 
include_once 'config/Database.php';
include_once 'models/Employee.php';
 
$database = new Database();
$db = $database->getConnection();
 
$employee = new Employee($db);
 
$employee->emp_id = $id;
 
$employee->readOne();
$page_title = "Update Employee Detail";
include_once "header.php"; 

echo "<div class='right-button-margin float-lg-right'>";
    echo "<a href='index.php' class='btn btn-primary'>Employees List</a>";
echo "</div>";
?>
<?php 
if($_POST){
 
    $employee->employee_name = $_POST['employee_name'];
    $employee->employee_monthly_salary = $_POST['salary'];
    if($employee->update()){
        echo "<div class='alert alert-success alert-dismissable'>";
            echo "employee Details Updated.";
        echo "</div>";
    }
 
    else{
        echo "<div class='alert alert-danger alert-dismissable'>";
            echo "Unable to update employee.";
        echo "</div>";
    }
}
?>
 
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?emp_id={$employee->emp_id}");?>" method="post">
    <table class='table table-hover table-sm table-bordered'>
 
        <tr>
            <td>Employee Name</td>
            <td><input type='text' name='employee_name' value='<?php echo $employee->employee_name; ?>' class='form-control' /></td>
        </tr>
 
        <tr>
            <td>Monthly Salary</td>
            <td><input type='number' name='salary' value='<?php echo $employee->employee_monthly_salary; ?>' class='form-control' /></td>
        </tr>
 
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Update</button>
            </td>
        </tr>
 
    </table>
</form>

<?php

 

 
 
?>