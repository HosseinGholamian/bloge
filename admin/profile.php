<?php include "includes/admin_header.php ";?>
   <?php 
   if(isset($_SESSION["username"])){
       echo $_SESSION["username"];
        $username =$_SESSION['username'];
        $query = "SELECT * FROM users WHERE username = '{$username}'";
        $select_user_result = mysqli_query($connection , $query);
        $row = mysqli_fetch_assoc($select_user_result);
        $user_id = $row['user_id'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_password = $row['user_password'];
        $user_confirm_password = $user_password;
        
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];


        if(isset($_POST['update_profile'])){
            $new_username = sqlInjection($_POST['username']);
            $check_query = "SELECT * FROM users WHERE username = '{$new_username}'";
            $result_check = mysqli_query($connection,$check_query);
            if($new_username !=  $username && mysqli_num_rows($result_check)>0){ ?>        
                    <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Error!</strong> That username is taken .Try another.
                    </div>
                    <?php
            }else{    
                $user_firstname = sqlInjection($_POST['user_firstname']);
                $user_lastname = sqlInjection($_POST['user_lastname']);
                $user_email = sqlInjection($_POST['user_email']);
                $submit_user_password = sqlInjection($_POST['user_password']);
                $user_confirm_password = sqlInjection($_POST['user_confirmpassword']);
    
                if($submit_user_password == $user_confirm_password){ 
                    $user_role = sqlInjection($_POST['user_role']);
                    if(($_FILES['user_image']['name'])){
                        $user_image = $_FILES['user_image']['name'];
                        $user_image_temp = $_FILES['user_image']['tmp_name'];
                        move_uploaded_file($user_image_temp,"./images/$user_image");
                    }
                    
                    
                    
                    if(empty($user_firstname) || empty($user_lastname) ||empty($submit_user_password) ||empty($user_password)){
                        ?>
                        <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Error!</strong> Please Fill All Field
                        </div>
                        <?php
                    }else{
                        if($submit_user_password==$user_password){
                            $hashed_password=$user_password;
                           }else{
                            $hashed_password = password_hash($submit_user_password,PASSWORD_BCRYPT,array('cost'=>12));}


                        $query_add_user =" UPDATE users SET user_firstname = '{$user_firstname}' , user_lastname = '{$user_lastname}' , user_email = '{$user_email}' , user_password='{$hashed_password}' ,  user_image='{$user_image}' , username='{$new_username}'  WHERE  user_id = {$user_id} ";
                        $add_user = mysqli_query($connection, $query_add_user);
                        resultQuery($add_user);
                        ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Done . </strong> You successfully Edit your profile.
                        </div>
                        
                        <?php  header("Location: users.php");
                    }
                }else{?>
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Error!</strong> Paswords Not Match!
                    </div><?php
            }}}
   }
   
   
   ?>
   
   
   
    <div id="wrapper">

        <!-- Navigation -->
        <?php  include "includes/admin_navigation.php"?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Profile
                            <small>   <?php echo $_SESSION["firstname"] ?></small>
                        </h1>

        <div class="">
            <div class="">
                <a href="#">
                <img class="media-object center-block" width="300" src="./images/<?php echo $user_image ?>" alt="...">
                </a>
            </div>
            <br>
            <div class="">
                <h2 class="media-heading text-center">Welcome <?php echo  $user_firstname." ".$user_lastname   ?></h2>
            </div>
        </div>
        <br>
        <hr>
        

        <h1>Edit Profile</h1>
<form action="" method="POST"  enctype="multipart/form-data">
<div class="form-group">
<label for="title">Firstname</label>
<input type="text" class="form-control" value="<?php echo $user_firstname  ?>" name="user_firstname">
</div>

<div class="form-group">
<label for="title">Lastname</label>
<input type="text" class="form-control" value="<?php echo $user_lastname  ?>" name="user_lastname">
</div>

<div class="form-group">
<label for="author">Email</label>
<input type="text" class="form-control" value="<?php echo $user_email  ?>" name="user_email">
</div>


<div class="form-group">
<label for="title">Username</label>
<input type="text" class="form-control" value="<?php echo $username  ?>" name="username">
</div>

<div class="form-group">
<label for="post_tag">Password</label>
<input type="password" class="form-control" value="<?php echo $user_password  ?>" name="user_password">
</div>

<div class="form-group">
<label for="post_tag"> Confirm Password</label>
<input type="password" class="form-control" value="<?php echo $user_confirm_password  ?>" name="user_confirmpassword">
</div>







<div class="form-group">
<label for="user_image">User Image</label>
<input type="file" class="form-control" name="user_image">
<img  width="50" src="./images/<?php echo  $user_image ?>" alt="">
</div>


<div class="form-group">
<input type="submit" class="btn btn-success btn-lg" name="update_profile" value="Update Profile">
</div>


</form>


                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        <?php include "includes/admin_footer.php" ?>
  
