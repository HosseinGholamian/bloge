<?php include "./db.php" ?>
<?php session_start() ?>
<?php 
if(isset($_POST['login'])){
$username = mysqli_real_escape_string($connection , $_POST['username']);
$password = mysqli_real_escape_string($connection , $_POST['user_password']);
if(empty($username) || empty($password)){
    header("Location: ../admin/index.php");
}

$query = "SELECT * FROM users WHERE username = '{$username}'";
$select_user_query = mysqli_query($connection , $query);
if(!$select_user_query){
    die("QUERY FAILED".mysqli_error($connection));

}
while($row = mysqli_fetch_assoc($select_user_query)){
$db_user_id = $row['user_id'];
$db_user_password = $row['user_password'];
$db_user_firstname = $row['user_firstname'];
$db_user_lastname = $row['user_lastname'];
$db_username = $row['username'];
$db_user_role = $row['user_role'];

}

// $password = crypt($password,$db_user_password);




if($username == $db_username && password_verify($password,$db_user_password) && $db_user_role=='Admin'){
    $_SESSION['id'] = $db_user_id;
    $_SESSION["username"] = $db_username;
    $_SESSION["firstname"] = $db_user_firstname;
    $_SESSION["lastname"] = $db_user_lastname;
    $_SESSION["role"] = $db_user_role;
    print_r($_SESSION) ;
    header("Location: ../admin/");
}else{
    header("Location: ../index.php");
}
}




?> 