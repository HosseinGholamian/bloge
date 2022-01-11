<?php 
if(isset($_POST["checkBoxArray"])){
    $bulk_options = $_POST["bulk_options"];
   foreach ($_POST["checkBoxArray"] as $postValue_id) {
       switch ($bulk_options) {
           case 'publish':
               $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValue_id} ";
               $update_to_publish = mysqli_query($connection , $query);
               break;
            case 'draft':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValue_id} ";
                $update_to_draft = mysqli_query($connection , $query);
                break;
            case 'delete':
                $query = "DELETE FROM posts WHERE  post_id = {$postValue_id} ";
                $delet_check_box = mysqli_query($connection , $query);
                break;
            case 'clone':
                $query = "SELECT * FROM posts WHERE post_id ={$postValue_id}";
                $clone_query_result = mysqli_query($connection, $query);
                while($row = mysqli_fetch_array($clone_query_result)){
                    $post_id = $row['post_id'];
                    $post_category_id = $row['post_category_id'];
                    $post_author = $row['post_author'];
                    $post_title = $row['post_title'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_comments= $row['post_comment_count'];
                    $post_date = $row['post_date'];
                    $post_content = $row['post_content'];
                    $post_status = $row['post_status'];
                    $query = " INSERT INTO posts(post_category_id, post_title , post_author ,post_date , post_image , post_content , post_tags ,post_comment_count , post_status)  ";
                    $query .= "VALUES({$post_category_id}, '{$post_title}' ,'{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}',{$post_comments},'{$post_status}') ";
                    $copy_query_result = mysqli_query($connection,$query);}
            break;
            
           
           default:
               # code...
               break;
       }
   }
}



?>

<form action="" method="POST">
<table class="table table-hover table-responsive table-striped table-bordered ">

<div id="bulkOptionsContainer" class="col-xs-4" style="
    padding: 0;
">
<select name="bulk_options" id="" class="form-control">
    <option  value="">Select Options</option>
    <option value="publish">Publish</option>
    <option value="draft">Draft</option>
    <option value="delete">Delete</option>
    <option value="clone">clone</option>
</select>
</div>
<div class="col-xs-4">
    <input type="submit" class="btn btn-success" value="Apply">
    <a href="posts.php?source=addposts" class="btn btn-primary">Add post</a>
</div>
                            <thead>
                                <tr>
                                    <th><input id="selectAllBoxes" type="checkbox"></th>
                                <th>Id</th>
                                    <th>Author</th>
                                    
                                    <th>Title</th>
                                    <th>Category</th>
                                    <!-- <th>Category</th> -->
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Tags</th>
                                    <th>Comments</th>
                                    <th>Views</th>
                                    <th>Date</th>
                                    <th>Delete</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $query = "SELECT * FROM posts ORDER BY post_id DESC";
                            $posts_result = mysqli_query($connection,$query);
                            while($row = mysqli_fetch_assoc($posts_result)){
                                $post_id = $row['post_id'];
                                $post_category_id = $row['post_category_id'];
                                $post_author = $row['post_author'];
                                $post_title = $row['post_title'];
                                // $post_catrgory = $row['post_category'];
                                $post_status = $row['post_status'];
                                $post_image = $row['post_image'];
                                $post_tags = $row['post_tags'];
                                $post_comments= $row['post_comment_count'];
                                $post_date = $row['post_date'];
                                $post_views_count = $row['post_views_count']
                                
                                ;?>

                                <tr>
                                    <td><input class="checkBoxes" name="checkBoxArray[]" value="<?php echo $post_id ?>" type="checkbox"></td>
                                    <td><?php echo  $post_id;     ?></td>
                                    <td><?php echo  $post_author  ?></td>
                                    <td><?php echo  "<a href='../post.php?singlepost={$post_id}'>{$post_title}</a>" ?></td>
                                    <!-- <td><?php // echo  $post_catrgory?></td> -->
                                    <td><?php
                                    $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}"; 
                                    $cat_select_result =mysqli_query($connection,$query);
                                    $cat_row = mysqli_fetch_assoc($cat_select_result); 
                                    if($cat_row == null){
                                        echo "category deleted";
                                    }else{
                                        $cat_title = $cat_row['cat_title'];
                                        $cat_id =  $cat_row['cat_id'];
                                        echo "<a href='../cat.php?c-id={$cat_id}'>{$cat_title}</a>";
                                     }
                                    ?></td>
                                    
                                    <td><?php echo  $post_status  ?></td>
                                    <td><img class="img-responsive" width="100" src="../images/<?php echo  $post_image   ?>" alt="<?php echo  $post_image   ?>"></td>
                                    <td><?php echo  $post_tags   ?></td>
                                    
                                    <?php
                                    $query = "SELECT * FROM comments WHERE comment_post_id = {$post_id}";
                                    $send_comment_query = mysqli_query($connection,$query);
                                    // $row =  mysqli_fetch_array($send_comment_query);
                                    //  if($row){
                                    // $comment_id = $row['comment_id'];}
                                    $count_comment = mysqli_num_rows($send_comment_query);
                                    
                                    ?> 
                                    <td><a href="comments.php?source=post_comments&id=<?php echo $post_id ?>"><?php echo  $count_comment?></a></td>



                                    <td><a href="posts.php?reset=<?php echo $post_id ?>"><?php echo  $post_views_count  ?></a></td>
                                    <td><?php echo  $post_date    ?></td>
                                    <?php
                                    echo "<td><a onclick=\"javascript: return confirm('Are you Sure')\"  href='posts.php?delete={$post_id} '><button type='button' class='btn btn-danger col-xs-12'> Delete </button></a></td>" ?>
                                    <td><a href="posts.php?source=editpost&post_id=<?php echo $post_id ?>"><button type='button' class='btn btn-success col-xs-12'> Edit </button></a></td>
                                </tr>
                                

                               
                                <?php  } ?>
                            
                             


                        
                               
                            </tbody>
                        </table>
                        </form>


                        <?php 
                        if(isset($_GET['delete'])){
                            $post_id = $_GET['delete'];
                            $query = "DELETE FROM posts WHERE post_id ={$post_id}";
                            $delete_query_result = mysqli_query($connection, $query);
                            header("Location: posts.php");
                        }
                        if(isset($_GET['reset'])){
                            $post_id = $_GET['reset'];
                            $query = "UPDATE posts SET post_views_count = 0 WHERE post_id = {$post_id}";
                            $reset_query_result = mysqli_query($connection, $query);
                            header("Location: posts.php");
                        }
                       
                        
                        
                        ?>