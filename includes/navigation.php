
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Start Bootstrap</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php
                    $query = "SELECT * FROM categories";
                    $select_all_cat = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($select_all_cat)){
                       echo "<li> <a href='cat.php?c-id={$row['cat_id']}'>{$row['cat_title']}</a></li>";
                    }
                    
                    ?>
                    <li>
                        <a href="admin">Admin</a>
                    </li>
                    <li>
                        <a href="registration.php">Registration</a>
                    </li>
                    <li>
                        <a href="cont.php">Contact</a>
                    </li>
                    <?php
                    if(isset($_SESSION["role"])){
                        if(isset($_GET['singlepost'])){
                            $the_post_id = $_GET['singlepost'];
                            ?>
                            <li>
                            <a href="./admin/posts.php?source=editpost&post_id=<?php echo $the_post_id ?>">Edit</a>
                            </li>
                        <?php
                        }
                    }
                    
                    ?>
                  

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>