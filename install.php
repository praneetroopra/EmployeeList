<?php
$servername = "localhost";
$username = "root";
$password = "";

$user='praneet';
$pass='passit123#';
$db="employees"; 

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //$sql = "CREATE DATABASE IF NOT EXISTS employees";
    $conn->exec("CREATE DATABASE `$db`;
                CREATE USER '$user'@'localhost' IDENTIFIED BY '$pass';
                GRANT ALL ON `$db`.* TO '$user'@'localhost';
                FLUSH PRIVILEGES;");
    $sql = "use employees";
    $conn->exec($sql);
    $sql = "CREATE TABLE IF NOT EXISTS EMPLOYEE (
                emp_id int(11) AUTO_INCREMENT PRIMARY KEY,
                employee_name varchar(30) NOT NULL,
                employee_monthly_salary decimal(19,2) NOT NULL default 0,
                created datetime NOT NULL,
                modified timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP)";
    $conn->exec($sql);
     header("Location:index.php?message= Database installed successfully");
}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}
?>

