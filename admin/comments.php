<?php include "includes/admin_header.php ";?>
    <div id="wrapper">

        <!-- Navigation -->
        <?php  include "includes/admin_navigation.php"?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Posts
                            <small>View Posts</small>
                        </h1>
                        <?php
                        if(isset($_GET['source'])){
                            $source = $_GET['source'];
                        }else{
                            $source='';
                        }


                        switch ($source) {
                            case "addposts":
                                include "./includes/add_post.php";
                                break;
                            case "post_comments":
                                include "./includes/post_comments.php";
                                break;
                            case "editpost":
                                include "./includes/admin_edit_post.php";
                                break;
                            
                            default:
                                include "./includes/admin-view-all-comments.php";
                                break;
                        }
                        
                        
                        
                        ?>
                      
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        <?php include "includes/admin_footer.php" ?>
  
