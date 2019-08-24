<?php
include_once 'config/core.php';
 
include_once 'config/Database.php';
include_once 'models/Employee.php';
 
$database = new Database();
$db = $database->getConnection();
 
$employee = new Employee($db);
 
$search_term=isset($_GET['s']) ? $_GET['s'] : '';
 
$page_title = "You searched for \"{$search_term}\"";
include_once "header.php";
 
$stmt = $employee->search($search_term, $from_record_num, $records_per_page);
 
$page_url="search.php?s={$search_term}&";
 
$total_rows=$employee->countAll_BySearch($search_term);
 
include_once "template.php";
 
include_once "footer.php";
?>