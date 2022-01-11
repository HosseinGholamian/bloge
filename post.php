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
                    $view_query = "UPDATE posts SET post_views_count = post_views_count+1 WHERE post_id = {$single_post_id}";
                    $view_result = mysqli_query($connection,$view_query);
                    $query = "SELECT * FROM posts WHERE post_id ={$single_post_id}";
                    $select_all_posts = mysqli_query($connection,$query);
                    $row = mysqli_fetch_assoc($select_all_posts);
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_content = $row['post_content'];
                        $post_image = $row['post_image'];
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
                <?php 
                if(isset($_POST['comment_submit'])){
                    $comment_post_id = $_GET['singlepost'];
                    $comment_author = $_POST['comment_author'];
                    $comment_email = $_POST['comment_email'];
                    $comment_content = $_POST['comment_content'];
                    if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){
                    $comment_date = date('y-m-d');
                    $query  = "INSERT INTO comments(comment_post_id,comment_author,comment_email,comment_content,comment_date,comment_status) VALUES ({$comment_post_id},'{$comment_author}','{$comment_email}','{$comment_content}',now(),'unapproved')";
                    $result = mysqli_query($connection,$query);


                    // $query = "UPDATE posts SET post_comment_count = post_comment_count+1 WHERE post_id = {$single_post_id} ";
                    // $result = mysqli_query($connection , $query);



                }else{
                    echo "<script>alert('please fill all field')</script>";}
                }
                ?>
                
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="POST">
                        <div class="form-group">
                            <label for="comment_author">Author</label>
                           <input class="form-control" type="text" name="comment_author">
                        </div>
                        <div class="form-group">
                        <div class="form-group">
                            <label for="comment_email">Email</label>
                           <input class="form-control" type="email" name="comment_email">
                        </div>
                        <div class="form-group">
                            <label for="comment_content">Content</label>
                            <textarea  name="comment_content" class="form-control" rows="3"></textarea>
                        </div>
                       
                        </div>
                        <button type="submit" name="comment_submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                    <?php 
                    $query = "SELECT * FROM comments WHERE comment_post_id = {$single_post_id} AND comment_status = 'approved' ORDER BY comment_id DESC";
                    $result =  mysqli_query($connection , $query);
                    if(!$result){
                        die("query failed". mysqli_error($connection));
                    }else{
                        while($row = mysqli_fetch_assoc($result)){
                        $comment_show_author = $row['comment_author'];
                        $comment_show_date = $row['comment_date'];
                        $comment_show_content = $row['comment_content'];
                            ?>
                        <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo $comment_show_author ; ?>
                                <small><?php echo  $comment_show_date ; ?></small>
                            </h4><?php echo $comment_show_content ; ?>
                        </div>
                    </div>

                        <?php } } ?>
                <!-- Comment -->
                
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php include "includes/footer.php" ?>