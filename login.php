<?php
  $email = $_POST['email'];
  $password = $_POST['password'];
  //database connection here
  $con = new mysqli("localhost","root","Deekshith@1","wordpress");
if($con->connect_error){
    die("failed to connect : ".$con->connect_error);
}
else{
    $stmt = $con->prepare("select * from student where email = ?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $stmt_result = $stmt->get_result();
    if($stmt_result->num_rows > 0)
    {
        $data = $stmt_result->fetch_assoc();
        if($data['password'] === $password)
        {
            session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: profilepage.html');
	exit;
}
            
        }
        else{
            echo "<h2>Invalid Email or password</h2>";
        }
    }
    else{
        echo "<h2>Invalid Email or password</h2>";
    }
}
?>