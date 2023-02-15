<?php
if(isset($_POST['login'])){
    session_start();
    $errmsg_arr = array();
    $errflag = false;
    // configuration
    $dbhost     = "localhost";
    $dbname     = "your database name";
    $dbuser     = "your username";

    // database connection
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("SET CHARACTER SET utf8mb4");
    // new data

    $user = $_POST['your name '];
  

    if($user == '') {
        $errmsg_arr[] = 'You must enter your Username';
        $errflag = true;
    }
  

    // query
    $result = $conn->prepare("SELECT * FROM login WHERE username= :u AND password= :p");
    $result->bindParam(':u', $user);
    $result->execute();
    $rows = $result->fetch(PDO::FETCH_NUM);
    if($rows > 0) {
        $_SESSION['username'] = $user;
        header("location: ./pages/home.php");
    }
    else{
        $errmsg_arr[] = 'Username and Password are not found';
        $errflag = true;
    }

}
?>