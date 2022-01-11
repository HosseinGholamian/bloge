<?php include "includes/admin_header.php ";?>
    <div id="wrapper">
<?php 

?>




        <!-- Navigation -->
        <?php  include "includes/admin_navigation.php"?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small><?php
                             echo $_SESSION['username'];
                            ?></small>
                        </h1>
                       
                    </div>
                </div>
                <!-- /.row -->
                       
                <!-- /.row -->
                
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">

                    <?php  
                    $query = "SELECT * FROM posts";
                    $result = mysqli_query($connection , $query);
                    $post_count = mysqli_num_rows($result);
                    ?>
                  <div class='huge'><?php echo $post_count ?></div>
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php  
                    $query = "SELECT * FROM comments";
                    $result = mysqli_query($connection , $query);
                    $Comment_count = mysqli_num_rows($result);
                    ?>
                     <div class='huge'><?php echo $Comment_count ?></div>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php  
                    $query = "SELECT * FROM users";
                    $result = mysqli_query($connection , $query);
                    $user_count = mysqli_num_rows($result);
                    ?>
                    <div class='huge'><?php echo $user_count ?></div>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>

            </a>

        </div>

    </div>
    
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php  
                    $query = "SELECT * FROM categories";
                    $result = mysqli_query($connection , $query);
                    $cat_count = mysqli_num_rows($result);
                    ?>
                        <div class='huge'><?php echo $cat_count ?></div>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
                <!-- /.row -->

                <?php  
                    $query1 = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
                    $result1 = mysqli_query($connection , $query1);
                    $Comment_unapproved_count = mysqli_num_rows($result1);
                    
                    
                    $query2 = "SELECT * FROM posts WHERE post_status = 'draft' ";
                    $result2 = mysqli_query($connection , $query2);
                    $post_draft_count = mysqli_num_rows($result2);



                    $query3 = "SELECT * FROM users WHERE user_role = 'Subscriber' ";
                    $result3 = mysqli_query($connection , $query3);
                    $user_Subscriber_count = mysqli_num_rows($result3);
                    

                    $query1 = "SELECT * FROM comments WHERE comment_status = 'approved'";
                    $result1 = mysqli_query($connection , $query1);
                    $Comment_approved_count = mysqli_num_rows($result1);
                    
                    
                    $query2 = "SELECT * FROM posts WHERE post_status = 'publish' ";
                    $result2 = mysqli_query($connection , $query2);
                    $post_publish_count = mysqli_num_rows($result2);



                    $query3 = "SELECT * FROM users WHERE user_role = 'Admin' ";
                    $result3 = mysqli_query($connection , $query3);
                    $user_admin_count = mysqli_num_rows($result3);
                    
                    ?>

                <div class="row">
                <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Count'],
          <?php
            $element_text = ['All Posts', 'Draft posts', 'publish posts' ,'All Comments' , 'Unapproved Comments', 'Approved Comments' ,  'All Users', 'Subscriber User','Admin User' ,'All Categories' ];
           $element_count = [$post_count ,$post_draft_count, $post_publish_count ,$Comment_count , $Comment_unapproved_count,$Comment_approved_count, $user_count, $user_Subscriber_count , $user_admin_count,$cat_count ];

           for($i=0;$i<10;$i++){
               echo "  ['{$element_text[$i]}',{$element_count[$i]}   ], ";
           }
          ?>
          
          
     ]);
        

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
<div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>

                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        <?php include "includes/admin_footer.php" ?>
  
