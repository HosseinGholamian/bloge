
<?php 

if(isset($_POST['submit_add_user'])){

$username = sqlInjection($_POST['username']);
$check_query = "SELECT * FROM users WHERE username = '{$username}'";
$result_check = mysqli_query($connection,$check_query);
if(mysqli_num_rows($result_check)>0){?>

<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Error!</strong> That username is taken .Try another.
</div>
<?php
}else{    

$user_firstname = sqlInjection($_POST['user_firstname']);
$user_lastname = $_POST['user_lastname'];
$user_email = sqlInjection($_POST['user_email']);

$user_password = sqlInjection($_POST['user_password']);
$user_confirm_password = sqlInjection($_POST['user_confirmpassword']);
if($user_password == $user_confirm_password){

$user_role = sqlInjection($_POST['user_role']);
if(($_FILES['user_image']['name'])){
$user_image = $_FILES['user_image']['name'];
$user_image_temp = $_FILES['user_image']['tmp_name'];
move_uploaded_file($user_image_temp,"./images/$user_image");
}else{
    $user_image = "profile.png";
}



if(empty($user_firstname) || empty($user_lastname) ||empty($user_email) ||empty($user_password)){
?>
<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Error!</strong> Please Fill All Field
</div>
<?php
}else{
  $query = "SELECT randSalt From users";
  $select_randsalt_query = mysqli_query($connection,$query);
  if(!$select_randsalt_query){
      die("Query Faild oops : ". mysqli_error($connection));
  }
  $row = mysqli_fetch_array($select_randsalt_query);
  $salt = $row['randSalt'];
  $hashed_password = password_hash($user_password,PASSWORD_BCRYPT,array('cost'=>12));
  
$query = " INSERT INTO users(user_firstname, user_lastname , user_email ,user_password , username , user_role , user_image)  ";
$query .= "VALUES('{$user_firstname}', '{$user_lastname}' ,'{$user_email}','{$hashed_password}','{$username}','{$user_role}','{$user_image}') ";
$create_user = mysqli_query($connection, $query);
resultQuery($create_user);
?>
  <div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Done . </strong> You successfully add a new user.
</div>

<?php
}
}else{?>
    <div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Error!</strong> Paswords Not Match!
</div><?php
}}}
?>



<form action="" method="post"  enctype="multipart/form-data">

<div class="form-group">
<label for="title">Firstname</label>
<input type="text" class="form-control" name="user_firstname">
</div>

<div class="form-group">
<label for="title">Lastname</label>
<input type="text" class="form-control" name="user_lastname">
</div>

<div class="form-group">
<label for="author">Email</label>
<input type="text" class="form-control" name="user_email">
</div>


<div class="form-group">
<label for="title">Username</label>
<input type="text" class="form-control" name="username">
</div>

<div class="form-group">
<label for="post_tag">Password</label>
<input type="text" class="form-control" name="user_password">
</div>

<div class="form-group">
<label for="post_tag"> Confirm Password</label>
<input type="text" class="form-control" name="user_confirmpassword">
</div>


<div class="form-group">
<label for="post_category_id">Role</label>
<select class="form-control" name="user_role" id="">
    <option value="Admin">Admin</option>
    <option selected value="Subscriber">Subscriber</option>
</select>
</div>




<div class="form-group">
<label for="user_image">User Image</label>
<input type="file" class="form-control" name="user_image">
</div>


<div class="form-group">
<input type="submit" class="btn btn-success btn-lg" name="submit_add_user" value="Add New User">
</div>


</form>