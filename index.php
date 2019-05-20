<!DOCTYPE html>
<html>
<head>
	<title>Submission Satu Ea</title>
	<!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

	<h1 style="text-align: center">Register Here</h1>

	<form method="POST" action="index.php" class="col-5 mx-auto">
	  <div class="form-group">
	    <label for="nama">Nama</label>
	    <input type="text" class="form-control" id="name" name="name" placeholder="Nama">
	  </div>
	  <div class="form-group">
	    <label for="email">Email</label>
	    <input type="text" class="form-control" id="email" name="email" placeholder="Email">
	  </div>
	  <div class="form-group">
	  	<label class="form-check-label" for="job">Job</label>
	    <input type="text" class="form-control" id="job" name="job" placeholder="Pekerjaan">
	  </div>
	  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
	  <button type="submit" name="load_data" class="btn btn-success">Load Data</button>
	</form>

 <?php
    $host = "asrulwebserver.database.windows.net";
    $user = "asrul";
    $pass = "Password123";
    $db = "asruldb";
    try {
        $conn = new PDO("sqlsrv:server = $host; Database = $db", $user, $pass);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    } catch(Exception $e) {
        echo "Failed: " . $e;
    }
    if (isset($_POST['submit'])) {
        try {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $job = $_POST['job'];
            $date = date("Y-m-d");
            // Insert data
            $sql_insert = "INSERT INTO Registration (name, email, job, date)
                        VALUES (?,?,?,?)";
            $stmt = $conn->prepare($sql_insert);
            $stmt->bindValue(1, $name);
            $stmt->bindValue(2, $email);
            $stmt->bindValue(3, $job);
            $stmt->bindValue(4, $date);
            $stmt->execute();
        } catch(Exception $e) {
            echo "Failed: " . $e;
        }
        echo "</br>";
        echo "<h3 style='text-align: center'>Your're registered!</h3>";
    } else if (isset($_POST['load_data'])) {
        try {
            $sql_select = "SELECT * FROM Registration";
            $stmt = $conn->query($sql_select);
            $registrants = $stmt->fetchAll();
            if(count($registrants) > 0) {
		    	echo "</br>";
                echo "<h2 style='text-align: center'>People who are registered:</h2>";
		    	echo "<div class='col-8 mx-auto'>";
                echo "<table class='table'>";
		    	echo "<thead class='thead-dark'>";
                echo "<tr><th scope='col'>Name</th>";
                echo "<th scope='col'>Email</th>";
                echo "<th scope='col'>Job</th>";
                echo "<th scope='col'>Date</th></tr>";
		    	echo "</thead>";
                foreach($registrants as $registrant) {
                    echo "<tr><td>".$registrant['name']."</td>";
                    echo "<td>".$registrant['email']."</td>";
                    echo "<td>".$registrant['job']."</td>";
                    echo "<td>".$registrant['date']."</td></tr>";
                }
                echo "</table>";
		    	echo "</div>";
            } else {
            	echo "</br>";
                echo "<h3 style='text-align: center'>No one is currently registered.</h3>";
            }
        } catch(Exception $e) {
            echo "Failed: " . $e;
        }
    }
 ?>

</body>
</html>
