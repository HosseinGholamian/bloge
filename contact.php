<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>
<?php
if(isset($_POST['submit2'])){
$to ="gholamianhossein96@gmail.com";
$subject =$_POST['subject'];
$email =$_POST['email'];
$body =$_POST['body'];
if(!empty($username) && !empty($email) && !empty($password)){

    mail($to,$subject,$body,$email);
}}

?>

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact</h1>
                    <form role="form" action="" method="post" id="login-form" autocomplete="off">
                    <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email"  class="form-control" placeholder="Enter email">
                        </div>
                         <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" name="subject"  class="form-control" placeholder="Enter Subject">
                        </div>
                         <div class="form-group">
                            <textarea name="body" class="form-control" id="" cols="50" rows="10"></textarea>
                        </div>
                
                        <input type="submit" name="submit2"  class="btn btn-custom btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>