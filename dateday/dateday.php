<?php
include("db/db2.php");
header('Access-Control-Allow-Origin: *');


if($_SERVER['REQUEST_METHOD']=='GET'){
    if (isset($_GET['id'])){
        $query="select * from dateday where id=".$_GET['id'];
        $result=methodGet($query);
        echo json_encode($result->fetch(PDO::FETCH_ASSOC));
    }
    else{
        $query="select * from dateday";
        $result=methodGet($query);
        echo json_encode($result->fetchAll()); 
    }
    header("HTTP/1.1 200 OK");
    exit();
}
 
if($_POST['METHOD']=='POST'){
    unset($_POST['METHOD']);
    $day=$_POST['day'];
    $place=$_POST['place'];
    $query="insert into dateday(day, place) values ('$day', '$place')";
    $queryAutoIncrement="select MAX(id) as id from dateday";
    $result=methodPost($query, $queryAutoIncrement);
    echo json_encode($result);
    header("HTTP/1.1 200 OK");
    exit();
}
if($_POST['METHOD']=='PUT'){
    unset($_POST['METHOD']);
    $id=$_GET['id'];
    $day=$_POST['day'];
    $place=$_POST['place'];
    $query="UPDATE dateday SET day='$day', place='$place' WHERE id='$id'";
    $result=methodPut($query);
    echo json_encode($result);
    header("HTTP/1.1 200 OK");
    exit();
}

if($_POST['METHOD']=='DELETE'){
    unset($_POST['METHOD']);
    $id=$_GET['id'];
    $query="DELETE FROM dateday WHERE id='$id'";
    $result=methodDelete($query);
    echo json_encode($result);
    header("HTTP/1.1 200 OK");
    exit();
}

header("HTTP/1.1 400 Bad Request");
?>