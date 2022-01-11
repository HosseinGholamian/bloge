<?php 


?>



<form action="" method="post"  enctype="multipart/form-data">


<?php 



if(isset($_GET['post_id'])){
    $post_id = $_GET['post_id'];
    $query = "SELECT * FROM posts WHERE post_id = {$post_id}";
    $select_post_result = mysqli_query($connection , $query);
    $row = mysqli_fetch_assoc($select_post_result);

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
    $post_content = $row['post_content'];
    if(isset($_POST['submit_edit_post'])){
        $post_title = sqlInjection($_POST['title']);
        $post__category_id = sqlInjection($_POST['post_category_id']);
        $post_author = sqlInjection($_POST['author']);
        $post_status = sqlInjection($_POST['status']);
        if(($_FILES['image']['name'])){
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];
        }
        $post_tag = sqlInjection($_POST['tag']);
        $post_content = sqlInjection($_POST['content']);
        $post_comment_count = 4;
        
        move_uploaded_file($post_image_temp,"../images/$post_image");

        $query = " UPDATE posts SET post_category_id = {$post__category_id} , post_title = '{$post_title}' , post_author = '{$post_author}' , post_image='{$post_image}' , post_content = '{$post_content}' , post_tags='{$post_tag}'  , post_status = '{$post_status}'  WHERE  post_id = {$post_id}";
        $edit_post = mysqli_query($connection, $query);
        resultQuery($edit_post);
        header("Location: posts.php");
        
        }
    
}

?>
<div class="form-group">
<label for="title">Post Title</label>
<input type="text" class="form-control" name="title"  value ="<?php echo  $post_title ?>">
</div>

<div class="form-group">
<label for="post_category_id">Post Category Id</label>
<select class="form-control" name="post_category_id" id="" >
<?php 
$query = "SELECT * FROM categories" ;
$select_category_result = mysqli_query($connection,$query);
while($row = mysqli_fetch_assoc($select_category_result)){
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];
    ?>
    <option   <?php if($post_category_id  == $cat_id  ){echo("selected");}?> value="<?php echo $cat_id ?>"><?php echo $cat_title ?></option>

<?php } ?>



</select>
</div>

<div class="form-group">
<label for="author">Post Author</label>
<input type="text" class="form-control" name="author" value="<?php echo  $post_author ?>">
</div>


<div class="form-group">
<label for="post_status">Post Status</label>
<select class="form-control" name="status" id="">
    <option <?php if( $post_status=='publish' ){echo "selected" ;}?> value="publish">publish</option>
    <option  <?php if( $post_status=='draft' ){echo "selected" ;}?> value="draft">draft</option>
</select>
</div>


<div class="form-group">
<label for="image">Post Image</label>
<input type="file" class="form-control" name="image" value="<?php echo  $post_image ?>">
<img  width="50" src="../images/<?php echo  $post_image ?>" alt="">
</div>

<div class="form-group">
<label for="post_tag">Post Tags</label>
<input type="text" class="form-control" name="tag" value="<?php echo  $post_tags ?>">
</div>


<div class="form-group">
<label for="post_content">Post content</label>
<textarea name="content" id="content" cols="30" rows="10" class="form-control"><?php echo  $post_content ?></textarea>
</div>
<script>
                        ClassicEditor
                                .create( document.querySelector( '#content' ) )
                                .then( editor => {
                                        console.log( editor );
                                } )
                                .catch( error => {
                                        console.error( error );
                                } );
                </script>

<div class="form-group">
<input type="submit" class="btn btn-success btn-lg" name="submit_edit_post" value="Edit Post">
</div>


</form>

