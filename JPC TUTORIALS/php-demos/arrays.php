<?php

echo "<h1>Methods of returning data from arrays</h1>";

$employee1 = array("Michael","Thompson","51687","26000");
$employee2 = array("James","Rasmussen","19875","15000");
$employee3 = array("Henry","Foggett","19810","150000");

$employees = array($employee1,$employee2,$employee3);

echo "<h3>Details of Employee 1 (Manual Method)</h3>";

echo "First name: ".$employee1[0]."<br>";
echo "Surname: $employee1[1]<br>";
echo "Payroll no.: $employee1[2]<br>";
echo "Salary: $ $employee1[3]<br>";
echo "<br>==================<br>";

$count = count($employee1);

echo "<h3>Details of Employee 1 (Loop Method)</h3>";

for ($x=0; $x < $count; $x++) {
    echo $employee1[$x] . "<br>";
}

echo "<br>==================<br>";
echo "<h3>First Name of Employee 1</h3>";
echo $employees[0][0];
echo "<br>==================<br>";

echo "<h2>Details of all Employees (Manual Method)</h2>";
echo "First name: ".$employees[0][0]."<br>";
echo "Surname: ".$employees[0][1]."<br>";
echo "Payroll no.: ".$employees[0][2]."<br>";
echo "Salary: $ ".$employees[0][3]."<br><br>";

echo "First name: ".$employees[1][0]."<br>";
echo "Surname: ".$employees[1][1]."<br>";
echo "Payroll no.: ".$employees[1][2]."<br>";
echo "Salary: $ ".$employees[1][3]."<br><br>";

echo "First name: ".$employees[2][0]."<br>";
echo "Surname: ".$employees[2][1]."<br>";
echo "Payroll no.: ".$employees[2][2]."<br>";
echo "Salary: $ ".$employees[2][3]."<br><br>";

echo "<br>==================<br>";

echo "<h2>Details of all Employees (Double Loop Method)</h2>";

$employee_count = count($employees);

for ($y=0; $y<$employee_count; $y++) {
    echo "<h3>Details of Employee ".($y+1)."</h3>";
    for ($x=0; $x<$count;$x++) {
        echo $employees[$y][$x] . "<br>";
    }
}
?>