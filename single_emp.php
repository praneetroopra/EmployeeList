<?php
$id = isset($_GET['emp_id']) ? $_GET['emp_id'] : die('ERROR: missing ID.');
 
include_once 'config/Database.php';
include_once 'models/Employee.php';
 
$database = new Database();
$db = $database->getConnection();
 
$employee = new Employee($db);
 
$employee->emp_id = $id;
 
$employee->readOne();
$page_title = "Employee Detail";
include_once "header.php";
 
echo "<div class='right-button-margin float-lg-right'>";
    echo "<a href='index.php' class='btn btn-primary'>";
        echo "<i class='fa fa-list'></i> Employees List";
    echo "</a>";
echo "</div>";

echo "<table class='table table-hover table-sm table-bordered'>";
 
    echo "<tr>";
        echo "<td>Employee Name</td>";
        echo "<td>{$employee->employee_name}</td>";
    echo "</tr>";
 
    echo "<tr>";
        echo "<td>Salary</td>";
        echo "<td>&#8377; {$employee->employee_monthly_salary}</td>";
    echo "</tr>";
 
echo "</table>";
 
include_once "footer.php";
?>