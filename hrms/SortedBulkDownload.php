<?php

// Database Connection

$host="localhost";
$uname="root";
$pass="";
$database = "hr_db_emkay"; 

$connection=mysql_connect($host,$uname,$pass); 

echo mysql_error();

//or die("Database Connection Failed");
$selectdb=mysql_select_db($database) or 
die("Database could not be selected"); 
$result=mysql_select_db($database)
or die("database cannot be selected <br>");

// Fetch Record from Database

$output = "";
$table = "employees"; // Enter Your Table Name 
$sql = mysql_query("select e.ID,e.EmpID,e.FirstName,c.Name AS Company,e.JoiningDate,e.Department,e.Designation,e.FatherName,l.Name AS Location,e.Salary,s.Name AS Schedule,e.DOB,e.Status,e.EmpType,e.CNICNumber,e.CNICIssueDate,e.CNICExpiration,e.EmailAddress,e.Gender,e.MobileNumber,e.Religion,e.AccountNumber,e.MaritalStatus from employees e LEFT JOIN companies c ON e.CompanyID = c.ID LEFT JOIN locations l ON e.Location = l.ID LEFT JOIN schedules s ON e.ScheduleID = s.ID Where 1");
$columns_total = mysql_num_fields($sql);

// Get The Field Name

for ($i = 0; $i < $columns_total; $i++) {
$heading = mysql_field_name($sql, $i);
$output .= '"'.$heading.'",';
}
$output .="\r\n";

// Get Records from the table

while ($row = mysql_fetch_array($sql)) {
for ($i = 0; $i < $columns_total; $i++) {
$output .='"'.$row["$i"].'",';
}
$output .="\r\n";
}

// Download the file

$filename = "Employees.csv";
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);

echo $output;
exit;

?>