<form action=""  method="POST">
                        <?php 
                        if(isset($_GET['edit'])){
                             $cat_id =$_GET['edit'];
                             $query = "SELECT * FROM categories WHERE cat_id = {$cat_id}";
                             $result =  mysqli_query($connection,$query);
                             $row = mysqli_fetch_assoc($result);
                             $cat_title =$row['cat_title'];
                             if (isset($_POST['update'])){
                                 $cat_title = $_POST['update_input'];
                              
                                 $update_query = "UPDATE categories SET cat_title = '{$cat_title}' WHERE cat_id = {$cat_id}";
                                 $update_result =  mysqli_query($connection,$update_query);
                                 header("Location: categories.php");
                             }
                        ?>
                        <div class="form-group">
                        <label for="cat_title">Edit Categories</label>
                            <input type="text" class="form-control" name="update_input" value = "<?php if(isset($cat_title)){echo $cat_title;} ?>">
                            </div>
                            <div class="form-group">
                            <input class="btn btn-success" type="submit" name="update"  value="Update category">
                            </div>


                            <?php }?> 
                            </form>