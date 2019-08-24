<?php
class Employee{
 
    // database connection and table name
    private $conn;
    private $table_name = "employee";
 
    // model properties
    public $emp_id;
    public $employee_name;
    public $employee_monthly_salary;
    public $timestamp;
 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // create employee
    function create(){
 
        // query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    employee_name=:employee_name, employee_monthly_salary=:employee_monthly_salary,
                    created=:created";
 
        $stmt = $this->conn->prepare($query);
 
        // posted values
        $this->employee_name=htmlspecialchars(strip_tags($this->employee_name));
        $this->employee_monthly_salary=htmlspecialchars(strip_tags($this->employee_monthly_salary));
 
        // to get time-stamp for 'created' field
        $this->timestamp = date('Y-m-d H:i:s');
 
        // bind values 
        $stmt->bindParam(":employee_name", $this->employee_name);
        $stmt->bindParam(":employee_monthly_salary", $this->employee_monthly_salary);
        $stmt->bindParam(":created", $this->timestamp);
 
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
 
    }


    function readAll($from_record_num, $records_per_page){
 
    $query = "SELECT
                emp_id, employee_name, employee_monthly_salary
            FROM
                " . $this->table_name . "
            ORDER BY
                created ASC
            LIMIT
                {$from_record_num}, {$records_per_page}";
 
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
 
    return $stmt;
  }


  // paging
    public function countAll(){
     
        $query = "SELECT emp_id FROM " . $this->table_name . "";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
     
        $num = $stmt->rowCount();
     
        return $num;
    }



        function readOne(){
     
        $query = "SELECT
                    emp_id , employee_name, employee_monthly_salary
                FROM
                    " . $this->table_name . "
                WHERE
                    emp_id = ?
                LIMIT
                    0,1";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->emp_id);
        $stmt->execute();
     
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $this->emp_id = $row['emp_id'];
        $this->employee_name = $row['employee_name'];
        $this->employee_monthly_salary = $row['employee_monthly_salary'];
        
    }



        function update(){
     
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    employee_name = :employee_name,
                    employee_monthly_salary = :employee_monthly_salary
                WHERE
                    emp_id = :emp_id";
     
        $stmt = $this->conn->prepare($query);
     
        // posted values
        $this->employee_name=htmlspecialchars(strip_tags($this->employee_name));
        $this->employee_monthly_salary=htmlspecialchars(strip_tags($this->employee_monthly_salary));
        $this->emp_id=htmlspecialchars(strip_tags($this->emp_id));
     
        // bind parameters
        $stmt->bindParam(':employee_name', $this->employee_name);
        $stmt->bindParam(':employee_monthly_salary', $this->employee_monthly_salary);
        $stmt->bindParam(':emp_id', $this->emp_id);
     
        // execute the query
        if($stmt->execute()){
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
         
    }


    // delete employee
    function delete(){
     
        $query = "DELETE FROM " . $this->table_name . " WHERE emp_id = ?";
         
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->emp_id);
     
        if($result = $stmt->execute()){
            return true;
        }else{
            return false;
        }
    }


    //  search term
public function search($search_term, $from_record_num, $records_per_page){
 
    // select query
    $query = "SELECT
                *
            FROM
                " . $this->table_name . " 
            WHERE
                employee_name LIKE ? 
            ORDER BY
                created ASC
            LIMIT
                ?, ?";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind variable values
    $search_term = "%{$search_term}%";
    $stmt->bindParam(1, $search_term);
    $stmt->bindParam(2, $from_record_num, PDO::PARAM_INT);
    $stmt->bindParam(3  , $records_per_page, PDO::PARAM_INT);
 
    // execute query
    $stmt->execute();
 
    // return values from database
    return $stmt;
}
 
public function countAll_BySearch($search_term){
 
    // select query
    $query = "SELECT
                COUNT(*) as total_rows
            FROM
                " . $this->table_name . " 
            WHERE
                employee_name LIKE ?";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind variable values
    $search_term = "%{$search_term}%";
    $stmt->bindParam(1, $search_term);
 
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    return $row['total_rows'];
}
}
?>