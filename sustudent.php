<?php
require_once("dbconnect.php"); 
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Swansea University</title>
  </head>
  <body> 
	 <div class="headImage">
   		<img src="SUmenubar.png" width="100%" height="26" alt=""/>
	<!-- </div> -->
    <div class="header">
      <h1>
        Student Record Card
      </h1>
    </div>
    <div class="search">
      <form action="sustudent.php" method="POST">
        <b>Query by student id #: <input type="text" name = "ID"/> <input type=
        "submit" value="Submit" /><b>
      </form>
    </div>
    
    <div class="personal">
      <p>
       <b>Personal Details<b>
      </p>
<?php
	$sid = $_POST["ID"];
	$queryForTable1 = "SELECT * FROM stud where sid = '$sid';"; 
	$resultForTable1 = mysqli_query($conn, $queryForTable1);
	echo "<table width='100%' border='1' align = 'left' rules = 'none' frame = 'box'>";
	while ($row = mysqli_fetch_array($resultForTable1))
	{
		if($sid === $_POST["ID"]){
			echo "<tr>";
			echo "<td>" . "Student ID". "</td>";
			echo "<td>" .$row["sid"]."</tr>";
			echo "<td>" . "Title". "</td>";
			echo "<td>" .$row["title"]."</tr>";
			echo "<td>" . "Full Name". "</td>";
			echo "<td>" .$row["firstname"].str_repeat('&nbsp;', 1).$row["lastname"]."</tr>";
			echo "<td>" . "Date of Birth". "</td>";
			echo "<td>" .$row["dob"]."</tr>";
			echo "<td>" . "Gender". "</td>";
			echo "<td>" .$row["gender"]."</tr>";
			echo "</tr>";
		}
	}
	echo "</table>";
?>

		
    </div>
    <div class="course">
      <p>
        Course Details
      </p>
<?php
	$sid = $_POST["ID"];
	$queryForTable2 = "SELECT *from prog, enrl where sid = '$sid' and enrl.pid = prog.pid group by sid;"; 
	$resultForTable2 = mysqli_query($conn, $queryForTable2);
	echo "<table width='100%' border='1' align = 'left' rules = 'none' frame = 'box'>";
	while ($row = mysqli_fetch_array($resultForTable2))
	{
		if($sid === $_POST["ID"]){ 
			echo "<tr>";
			echo "<td>" . "UCAS Code". "</td>";
			echo "<td>" .$row["pid"]."</tr>";
			echo "<td>" . "Degree Scheme". "</td>";
			echo "<td>" .$row["paward"].str_repeat('&nbsp;', 1).$row["ptitle"]. str_repeat('&nbsp;', 1)."of". str_repeat('&nbsp;', 1).$row["length"]."yrs". str_repeat('&nbsp;', 1)."</tr>";
			echo "<td>" . "Department". "</td>";
			echo "<td>" .$row["ptitle"]."</tr>";
			echo "</tr>";
		}
	}
	echo "</table>";
?>    
 
    </div>
    <div class="enrolment">
      <p>
        Enrolment and Progress
      </p>
<?php
	$sid = $_POST["ID"];
	$queryForTable3 = "SELECT ayr,status,ptitle,lvl from enrl,prog where sid = '$sid' and enrl.pid = prog.pid order by ayr DESC;";
	$resultForTable3 = mysqli_query($conn, $queryForTable3);
	echo "<table width='100%' border='1' align = 'center' rules = 'none' frame = 'box'>";
	echo "<tr>";
	echo "<th>"."Academic Year"."</th>";
			echo "<th>" . "Enrolment Status". "</th>";
			echo "<th>" . "Course Details". "</th>";
			echo "<th>" . "Academic Year". "</th>";
		echo "</tr>";
	while ($row = mysqli_fetch_array($resultForTable3)) 
	{
		if($sid === $_POST["ID"]){ 
			echo "<tr align = 'center'>";
				echo "<td>" .$row["ayr"]."</td>";
				echo "<td>" .$row["status"]."</td>";
				echo "<td>" .$row["ptitle"]."</td>";
				echo "<td>" .$row["lvl"]."</td>";
			echo "</tr>";
		}
	}
	echo "</table>";
?>	
    </div>
    <div class="module">
      <p>
        <b>Module Selection</b>
      </p>
<?php
	$sid = $_POST["ID"];
	$query = "SELECT distinct sid,ayr from mods,smod where sid = '$sid' and smod.mid = mods.mid order by ayr DESC;";
	$result = mysqli_query($conn, $query);
	echo "<table width = '100%' border = '1' rules = 'none' >";
	$ayr = $row["ayr"];
	
	while ($row = mysqli_fetch_array($result)) 
	{
		$ayr = $row["ayr"];
		echo "<tr bgcolor = '#e6e6ff'>";
		echo "<td>";
		echo "</td>";
		echo "<td>";
		echo "<b>"."<center>".$ayr."<center>"."</b>";
		echo "</td>";
		echo "<td>";
		echo  "</td>";
		echo "<td>";
		echo "</td>";
		echo "<td>";
		echo "</td>";
		echo "<td>";
		echo "</td>";
		echo "</tr>";
			
		$sid = $_POST["ID"];
		$newQuery = "SELECT * from mods,smod where sid = '$sid' and smod.mid = mods.mid order by ayr DESC;";
		$newResult = mysqli_query($conn, $newQuery);
		$addCredits = 0;
		while($row = mysqli_fetch_array($newResult))
		{
			$numOfCredits = $row["credits"];
			
			
			if ($ayr === $row["ayr"]){
				echo "<tr>";
				echo "<td>". $row["mid"]."</td>";
				echo "<td>" .$row["mtitle"]."</td>";
				echo "<td>";
				echo "</td>";
				echo "<td>";
				echo "</td>";
				echo "<td align = 'right'>";
				echo "<td>".$row["credits"]."</td>"."</td>";
				$addCredits = $addCredits + $numOfCredits;
				echo "</tr>";
			}
		}
		echo "<tr>";
		echo "<td>";
		echo "</td>";
		echo "<td>";
		echo "</td>";
		echo "<td>";
		echo "</td>";
		echo "<td>";
		echo "</td>";
		echo "<td align = 'right'>";
		echo "<b>"."Total Credits:".str_repeat('&nbsp;', 1).$addCredits."</b>";
		echo "</td>";
		echo "<td>";
		echo "</td>";
		echo "</tr>";
		
	}
	echo "</table>";
?>
</div>
	<div class="footImage">
    	<img src="SUlogo.png" width="100%" height="123" alt=""/> 
	</div>
</body>
</html>
