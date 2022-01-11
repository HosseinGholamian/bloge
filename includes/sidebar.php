<div class="col-md-4">
<?php
                  
                    ?>
                <!-- Blog Search Well -->
                <div class="well">

                    <h4>Blog Search</h4>
                    <form action="search.php" method="POST">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit" name="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    </form>
                    <!-- /.input-group -->
                </div>
                <!-- Blog Login Well -->
                <div class="well">

                    <h4>Blog Login</h4>
                    <form action="./includes/login.php" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Enter Username">
                    </div>
                    <div class="input-group">
                        <input type="password" class="form-control" name="user_password"  placeholder="Enter Password">
                        <span class="input-group-btn">
                            <button class="btn btn-primary " type="submit" name="login">
                                Login
                        </button>
                        </span>
                    </div>
                    </form>
                    <!-- /.input-group -->
                </div>


                

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                            <?php
                            $query = "SELECT * FROM categories";
                            $select_cat_sidebar = mysqli_query($connection,$query);
                            while($row = mysqli_fetch_assoc($select_cat_sidebar)){
                                $cat_title = $row['cat_title'];
                                $cat_id = $row['cat_id'];
                                echo "<li> <a href='cat.php?c-id={$cat_id}'>{$cat_title}</a></li>";
                            }
                            ?>
                            </ul>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
            <?php include "widget.php" ?>

            </div>