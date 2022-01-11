<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>

    <!-- Navigation -->
    <?php include "includes/navigation.php" ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

            

                <!-- First Blog Post -->
                <?php
                if(isset($_GET['singlepost'])){
                    $single_post_id = $_GET['singlepost'];
                    $post_author = $_GET['author'];
                    $query = "SELECT * FROM posts WHERE post_author = '{$post_author}'";
                    $select_all_posts = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($select_all_posts)){
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_content = substr($row['post_content'],0,200);
                        $post_image = $row['post_image'];}
                        ?>
                        <h1>
                        <a href="#"><?php echo $post_title; ?></a>
                    </h1>
                    <p class="lead">
                        by <a href="index.php"><?php echo $post_author; ?></a>
                    </p>
                    <hr>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                    <hr>
                    <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                    <hr>
                    <p class="lead"><?php echo $post_content; ?></p>
                    <a class="btn btn-primary" href="index.php">Home <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>
               <?php } ?>


              
                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>
                    
                <!-- Comments Form -->
              
                
              

                <hr>

               
              
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

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php include "includes/footer.php" ?>