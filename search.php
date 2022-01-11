<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>

    <!-- Navigation -->
    <?php include "includes/navigation.php" ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <?php
                  if(isset($_POST['submit'])){
                    $search = $_POST['search'];
                    $search = mysqli_real_escape_string($connection,$search);
                    $query = "SELECT * FROM posts WHERE post_status = 'publish'  AND  post_tags LIKE '%$search%'";
                    $search_query = mysqli_query($connection,$query);
                    
                
                    if(!$search_query){
                        die(" ".mysqli_error($connection));
                    }
                    $count = mysqli_num_rows($search_query);
                    if($count == 0){
                        echo "<h1> No Result </h1>";
                    } else{
                        while($row = mysqli_fetch_assoc($search_query)){
                            $post_title = $row['post_title'];
                            $post_author = $row['post_author'];
                            $post_date = $row['post_date'];
                            $post_content = substr( $row['post_content'],0,200);
                            $post_image = $row['post_image'];
                            ?>
                            <h2>
                            <a href="post.php?singlepost=<?php echo $post_id ?>"><?php echo $post_title; ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $post_author; ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                        <hr>
                        <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                        <hr>
                        <p><?php echo $post_content; ?></p>
                        <a class="btn btn-primary" href="post.php?singlepost=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
        
                        <hr><?php
                    }
                }

                } ?>


              
                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php include "includes/footer.php" ?>