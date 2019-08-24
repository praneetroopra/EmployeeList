<?php

include_once 'config/core.php';
 

include_once 'config/Database.php';
include_once 'models/Employee.php';
 

$database = new Database();
$db = $database->getConnection();
 
$employee = new Employee($db);
 
$page_title = "Employees List";
include_once "header.php";
 

$stmt = $employee->readAll($from_record_num, $records_per_page);
 

$page_url = "index.php?";
 

$total_rows=$employee->countAll();
 

include_once "template.php";
 

include_once "footer.php";

?>