<?php
function user_online(){
    global $connection;
    $session = session_id();
$time = time();
$time_out_in_seconds = 60;

$time_out = $time - $time_out_in_seconds;
$query = "SELECT * FROM  users_online WHERE session = '$session'";
$send_query = mysqli_query($connection, $query);
$count = mysqli_num_rows($send_query);
if(!$send_query){
    die("<br>  QUERY FAILED  1   :  ".mysqli_error($connection));}
if($count == NULL){
    $result_insert = mysqli_query($connection,"INSERT INTO users_online(session,time) VALUES ('{$session}', {$time}) ");
    if(!$result_insert){
        die("<br>  QUERY FAILED  2  :  ".mysqli_error($connection));}

}else{
    $result_update = mysqli_query($connection,"UPDATE users_online SET time = {$time} WHERE session = '{$session}'  ");
    if(!$result_update){
        die(" <br>  QUERY FAILED 3 :    ".mysqli_error($connection));}
}

$online_query ="SELECT * FROM users_online WHERE time > {$time_out} ";
$online_result = mysqli_query($connection,$online_query);
if(!$online_result){
    die(" <br>  QUERY FAILED 4 :    ".mysqli_error($connection));}
return mysqli_num_rows($online_result);

}


function CategoryTable(){
    global $connection;
    $query = "SELECT * FROM categories";
    $select_cat_admin = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($select_cat_admin)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td>";
        echo "<a href='categories.php?delete={$cat_id}'><button type='button' class='btn btn-danger col-xs-12'>Delete</button></a></td><td>";
        echo "<a  class='' href='categories.php?edit={$cat_id}'><button type='button' class='btn btn-success col-xs-12'> Edit </button></a>";
        echo " </td>";
        echo "</tr>";
    }
    }
function deletCat(){
    global $connection;
    if(isset($_GET['delete'])){
        $get_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$get_cat_id}";
        $delete_result = mysqli_query($connection , $query);
        header("Location: categories.php");
    }
}
function addCat(){
    global $connection;
    if(isset($_POST['submit'])){
        $cat_title = $_POST['cat_title'];
        if($cat_title=="" || empty($cat_title)){
            echo "This field should not be empty";
            }else{
            $query = "INSERT INTO categories(cat_title)  ";
            $query .= " VALUES('{$cat_title}')";

            $create_category_query =  mysqli_query($connection ,$query);
            if(!$create_category_query){
            die('QUERY FAILED'.mysqli_error($connection));
            }
        }

    }

}

function sqlInjection($query){
    global $connection;
    return mysqli_real_escape_string($connection,$query);
}



function resultQuery($resualt){if(!$resualt){

    global $connection;
    die("QUERY FAILED".mysqli_error($connection));
}}
