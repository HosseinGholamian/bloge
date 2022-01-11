<table class="table table-hover table-responsive table-striped table-bordered ">
                            <thead>
                                <tr>
                                <th>Id</th>
                                    <th>Author</th>
                                    <th>Comment</th>
                                    <th>Email</th>
                                    <!-- <th>Category</th> -->
                                    <th>Status</th>
                                    <th>In Response to</th>
                                    <th>Date</th>
                                    <th>Approve</th>
                                    <th>Unapprove</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $query = "SELECT * FROM comments ORDER BY comment_id DESC";
                            $comments_result = mysqli_query($connection,$query);
                            while($row = mysqli_fetch_assoc($comments_result)){
                                $comment_id = $row['comment_id'];
                                $comment_post_id = $row['comment_post_id'];
                                $comment_author = $row['comment_author'];
                                $comment_content = $row['comment_content'];
                                $comment_email = $row['comment_email'];
                                // $comment_catrgory = $row['comment_category'];
                                $comment_status = $row['comment_status'];
                                $comment_date = $row['comment_date'];
                                ;?>

                                <tr>
                                    <td><?php echo  $comment_id;     ?></td>
                                    <td><?php echo  $comment_author  ?></td>
                                    <td><?php echo  $comment_content   ?></td>
                                    
                                    
                                    <td><?php echo  $comment_email  ?></td>
                                    <td><?php echo  $comment_status   ?></td>
                                    
                                    <td> 
                                    <?php
                                    $query = "SELECT * FROM posts WHERE post_id = {$comment_post_id}"; 
                                    $post_select_result = mysqli_query($connection,$query);
                                    $post_row = mysqli_fetch_assoc($post_select_result); 
                                    if($post_row == null){
                                        echo "poste deleted";
                                    }else{ 
                                    echo    "<a href='../post.php?singlepost={$post_row['post_id']}'>{$post_row['post_title']}</a>";}
                                    ?>
                                    </td>
                                    <td><?php echo  $comment_date    ?></td>
                                    <td><a href="comments.php?approvecomment=<?php echo $comment_id ?>"><button type='button' class='btn btn-danger col-xs-12'> Approve </button></a></td>
                                    <td><a href="comments.php?unapprovecomment=<?php echo $comment_id ?>"><button type='button' class='btn btn-success col-xs-12'> Unapprove </button></a></td>
                                    <td><a href="comments.php?deletecomment=<?php echo $comment_id ?>"><button type='button' class='btn btn-danger col-xs-12'> Delete </button></a></td>
                                </tr>
                                

                               
                                <?php  } ?>
                            
                        


                        
                               
                            </tbody>
                        </table>



                        <?php 
                        if(isset($_GET['deletecomment'])){
                            $comment_id = $_GET['deletecomment'];
                            $query = "DELETE FROM comments WHERE comment_id ={$comment_id}";
                            $delete_query_result = mysqli_query($connection, $query);
                            header("Location: comments.php");
                        }

                        if(isset($_GET['approvecomment'])){
                            $comment_id = $_GET['approvecomment'];
                            $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$comment_id}";
                            $approve_query_result = mysqli_query($connection, $query);
                            header("Location: comments.php");
                        }

                        if(isset($_GET['unapprovecomment'])){
                            $comment_id = $_GET['unapprovecomment'];
                            $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = {$comment_id}";
                            $unapprove_query_result = mysqli_query($connection, $query);
                            header("Location: comments.php");
                        }
                        
                        
                        ?>