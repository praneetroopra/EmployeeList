<?php
if(!empty($_GET['message'])) {
    $message = $_GET['message'];
    echo "<div class='alert alert-success'>$message</div>";

}

echo "<form role='search' action='search.php'>";
    echo "<div class='input-group col-md-4 float-left mr-3'>";
        $search_value=isset($search_term) ? "value='{$search_term}'" : "";
        echo "<input type='text' class='form-control' placeholder='Type the name of your employee...' name='s' id='srch-term' required {$search_value} />";
        echo "<div class='input-group-append'>";
            echo "<button class='btn btn-primary' type='submit'><i class='fa fa-search' aria-hidden='true'></i></button>";
        echo "</div>";
    echo "</div>";
echo "</form>";
 
echo "<div class='right-button-margin float-lg-right'>";
    echo "<a href='create_employee.php' class='btn btn-primary'>";
        echo "<i class='fa fa-plus' aria-hidden='true'></i> Add Employee";
    echo "</a>";
echo "</div>";


if($total_rows>0){
 
    echo "<table class='table table-hover table-sm table-bordered'>";
        echo "<tr>";
            echo "<th>Employee ID</th>";
            echo "<th>Employee Name</th>";
            echo "<th>Monthly Salary</th>";
            echo "<th>Action</th>";
        echo "</tr>";
 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 
            extract($row);
 
            echo "<tr>";
                echo "<td>{$emp_id}</td>"; 
                echo "<td><a href='single_emp.php?emp_id={$emp_id}'>{$employee_name}</a></td>";
                echo "<td>&#8377; {$employee_monthly_salary}</td>";
                echo "</td>";
 
                echo "<td>";
                echo "<a href='update_emp.php?emp_id={$emp_id}' class='btn btn-info editBtn'>
                    <i class='fa fa-edit' aria-hidden='true'></i> Edit
                </a>
                 
                <a href='#' delete-id='{$emp_id}' class='btn btn-danger delete-object delBtn'>
                    <i class='fa fa-trash' aria-hidden='true'></i> Delete
                </a>";
                echo "</td>";
 
            echo "</tr>";
 
        }
 
    echo "</table>";
 
    include_once 'paging.php';
}
 
else{
    echo "<div class='alert alert-danger notAdded'>No Employees found. Start Adding Your Employees</div>";
}
?>