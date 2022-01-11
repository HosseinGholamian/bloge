<table class="table table-hover table-responsive table-striped table-bordered ">
                            <thead>
                                <tr>
                                <th>Id</th>
                                    <th>Username</th>
                                    <th>First name</th>
                                    <th>Last name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $query = "SELECT * FROM users ";
                            $users_result = mysqli_query($connection,$query);
                            while($row = mysqli_fetch_assoc($users_result)){
                                $user_id = $row['user_id'];
                                $username = $row['username'];
                                $user_password = $row['user_password'];
                                $user_firstname = $row['user_firstname'];
                                $user_lastname = $row['user_lastname'];
                                $user_email = $row['user_email'];
                                $user_image = $row['user_image'];
                                $user_role = $row['user_role'];
                                ;?>

                                <tr>
                                    <td><?php echo  $user_id;     ?></td>
                                    <td>
                                    <div class="">
                                    <div class="">
                                        <a href="#">
                                        <img class="media-object center-block" width="50" src="./images/<?php echo $user_image ?>" alt="...">
                                        </a>
                                    </div>
                                    <br>
                                    <div class="">
                                        <p class="media-heading text-center"><?php echo  $username  ?></p>
                                    </div>
                                    </div>
                                    </td>
                                    <td><?php echo  $user_firstname   ?></td>
                                    
                                    
                                    <td><?php echo  $user_lastname  ?></td>
                                    <td><?php echo  $user_email   ?></td>
                                    
                                   
                                    <?php
                                    // $query = "SELECT * FROM posts WHERE post_id = {$comment_post_id}"; 
                                    // $post_select_result = mysqli_query($connection,$query);
                                    // $post_row = mysqli_fetch_assoc($post_select_result); 
                                    // if($post_row == null){
                                    //     echo "poste deleted";
                                    // }else{ 
                                    // echo    "<a href='../post.php?singlepost={$post_row['post_id']}'>{$post_row['post_title']}</a>";}
                                    ?>
                                   
                                    <td><?php echo  $user_role    ?></td>
                                    <td><a href="users.php?admin=<?php echo $user_id ?>"><button type='button' class='btn btn-danger col-xs-12'> Admin </button></a></td>
                                    <td><a href="users.php?sub=<?php echo $user_id ?>"><button type='button' class='btn btn-success col-xs-12'> Subscriber </button></a></td>
                                    <td><a href="users.php?deleteuser=<?php echo $user_id ?>"><button type='button' class='btn btn-danger col-xs-12'> Delete </button></a></td>
                                    <td><a href="users.php?user_id=<?php echo $user_id ?>&source=edit_user"><button type='button' class='btn btn-success col-xs-12'> Edit </button></a></td>

                                </tr>
                                

                               
                                <?php  } ?>
                            
                        


                        
                               
                            </tbody>
                        </table>



                        <?php 
                        if(isset($_GET['deleteuser'])){
                            $user_id = $_GET['deleteuser'];
                            $query = "DELETE FROM users WHERE user_id ={$user_id}";
                            $delete_query_result = mysqli_query($connection, $query);
                            header("Location: users.php");
                        }

                        if(isset($_GET['admin'])){
                            $user_id = $_GET['admin'];
                            $query = "UPDATE users SET user_role = 'Admin' WHERE user_id = {$user_id}";
                            $admin_query_result = mysqli_query($connection, $query);
                            header("Location: users.php");
                        }

                        if(isset($_GET['sub'])){
                            if(isset($_SESSION['role'])){
                                if($_SESSION['role']=='Admin'){
                            $user_id = mysqli_real_escape_string($connection,$_GET['sub']);
                            $query = "UPDATE users SET user_role = 'Subscriber' WHERE user_id = {$user_id}";
                            $sub_query_result = mysqli_query($connection, $query);
                            header("Location: users.php");
                        }}}
                        
                        
                        ?>