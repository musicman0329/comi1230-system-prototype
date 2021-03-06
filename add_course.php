<html>
	<head>
		<meta charset="utf-8" />
		<title>Syllabi Content Management</title>
		<link href="input.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<header>
			<h1>View content on this page!</h1>
			<img src="ccri_logo.png"/>
			
			<nav>
				<a href="view.php">View Content<alt="View Content" /></a>
				<a href="input_faculty.php">Add Faculty<alt="Add Faculty" /></a>
				<a href="input_course.php">Add Course<alt="Add Course" /></a>
				<a href="input_course_section.php">Add Course Section<alt="Add Course Section" /></a>
				<a href="input_syllabus.php">Upload Syllabus<alt="Upload Syllabus" /></a>
			</nav>
		</header><br>
		
		<!-- Create new record based on user-entered data -->
		<?php
			
			// Define variables to save user-entered data, resolve to null if blank. 
			$Subject = $_POST["Subject"] ?? null;
			$Course_Num = $_POST["Course_Num"] ?? null;
			$Department = $_POST["Department"] ?? null;
			$Title = $_POST["Title"] ?? null;
			$Credits = $_POST["Credits"] ?? null;
			
			// Combine $Subject and $Course_Num so we can store them in the same table column
			$Course_Num = $Subject . $Course_Num;
			
			// Define database connection details
			$servername = "127.0.0.1";
			$username = "root";
			$password = "";
			$dbname = "system_prototype";

			// Attempt to connect to database and insert new records into table
			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
				// set the PDO error mode to exception
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "INSERT INTO course (Course_Num, Department, Title, Credits) 
				VALUES ('$Course_Num','$Department','$Title','$Credits')";
				// use exec() because no results are returned
				$conn->exec($sql);
				
				//Display confirmation message to user
				echo "New record created successfully!";
			}
			// If attempt fails, then display an error message.
			catch(PDOException $e)
				{
				echo $sql . "<br>" . $e->getMessage();
				}

			$conn = null;
		?>
		<br>
		<br>
		<a href="input_course.php">Return to the add course page<alt="View Content" /></a>
	</body>
</html>