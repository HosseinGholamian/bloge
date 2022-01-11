
<?php 

if(isset($_POST['submit_add_post'])){
$post_title = sqlInjection($_POST['title']);
$post__category_id = $_POST['post_category_id'];
$post_author = sqlInjection($_POST['author']);
$post_status = sqlInjection($_POST['status']);

$post_image = $_FILES['image']['name'];
$post_image_temp = $_FILES['image']['tmp_name'];

$post_tag = sqlInjection($_POST['tag']);
$post_content = sqlInjection($_POST['content']);
$post_date = date('d-m-y');
$post_comment_count = 0;

move_uploaded_file($post_image_temp,"../images/$post_image");
$query = " INSERT INTO posts(post_category_id, post_title , post_author ,post_date , post_image , post_content , post_tags ,post_comment_count , post_status)  ";
$query .= "VALUES({$post__category_id}, '{$post_title}' ,'{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tag}',{$post_comment_count},'{$post_status}') ";
$create_post = mysqli_query($connection, $query);
resultQuery($create_post);?>
<div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Done . </strong> You successfully add a new Post.
                    </div>
<?php } ?>




<form action="" method="post"  enctype="multipart/form-data">

<div class="form-group">
<label for="title">Post Title</label>
<input type="text" class="form-control" name="title">
</div>

<div class="form-group">
<label for="post_category_id">Post Category Id</label>
<select class="form-control" name="post_category_id" id="">
<?php 
$query = "SELECT * FROM categories" ;
$select_category_result = mysqli_query($connection,$query);
while($row = mysqli_fetch_assoc($select_category_result)){
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];
    ?>
    <option value="<?php echo $cat_id ?>"><?php echo  $cat_title ?></option>

<?php } ?>



</select>
</div>

<div class="form-group">
<label for="author">Post Author</label>
<input type="text" class="form-control" name="author">
</div>


<div class="form-group">
<label for="post_status">Post Status</label>
<select class="form-control" name="status" id="">
    <option value="publish">publish</option>
    <option selected value="draft">draft</option>
</select>

</div>


<div class="form-group">
<label for="image">Post Image</label>
<input type="file" class="form-control" name="image">
</div>

<div class="form-group">
<label for="post_tag">Post Tags</label>
<input type="text" class="form-control" name="tag">
</div>

<div class="form-group">
<label for="post_content">Post content</label>
<div >
<textarea name="content" id="content" cols="30" rows="10" class="form-control">

</textarea>
<script>
    CKFinder.SetupCkEdi
    ClassicEditor
	.create( document.querySelector( '#content' ), {
		ckfinder: {
			uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
		},
		toolbar: [ 'ckfinder', 'imageUpload', '|', 'heading', '|', 'bold', 'italic', '|', 'undo', 'redo' ]
	} )
    .then( editor => {
            console.log( editor );
                } )
	.catch( error => {
		console.error( error );
	} );
                </script>
</div>
</div>

<div class="form-group">
<input type="submit" class="btn btn-success btn-lg" name="submit_add_post" value="Add post">
</div>


</form>