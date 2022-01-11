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

                $count_query = "SELECT * FROM posts";
                $result_query_count = mysqli_query($connection,$count_query);
                $count = mysqli_num_rows($result_query_count);
                $count = ceil($count/5);
                echo "<h1>{$count}</h1>";

                if(isset($_GET['page'])){
                    $page  = $_GET['page'];
                }else{
                    $page = 1;
                }
                $page_1 =($page*5)-5;
                


                $query = "SELECT * FROM posts WHERE post_status = 'publish' ORDER BY post_id DESC LIMIT {$page_1} , 5";
                $select_all_posts = mysqli_query($connection,$query);
                $num_rows = $select_all_posts->num_rows;
                
                if( $num_rows==0 ){
                    echo "<h1> No Result </h1>";
                }
                
                while($row = mysqli_fetch_assoc($select_all_posts)){
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_content = substr( $row['post_content'],0,200);
                    $post_image = $row['post_image'];
                    $post_id =$row['post_id'];
                    $post_status = $row['post_status'];
                    ?>
                    <h2>
                    <a href="post.php?singlepost=<?php echo $post_id ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="./author_post.php?author=<?php echo $post_author;?>&singlepost=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <a href="post.php?singlepost=<?php echo $post_id ?>">
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                </a>
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?singlepost=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
               <?php } ?>


              
                <!-- Pager -->
                <ul class="pager">
                    <?php 
                    for ($i=1; $i<=$count  ; $i++) { ?>
                        <li>
                        <a class="<?php if($page ==$i){echo 'activepager';} ?>" href="index.php?page=<?php echo $i?> "><?php echo $i ?></a>
                        </li>
                        <?php
                    }
                    ?>
                    
                    
                </ul>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php include "includes/footer.php" ?>