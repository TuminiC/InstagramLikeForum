<?php
include 'sql_connect.php';

session_start();


$stmt = $conn->prepare("insert into post (creator, title, content) values(?,?,?); ");
$stmt->bind_param("iss",
    $_SESSION['id'],
    $title,
    $content);
    $title=($_POST['title']);
    $content=($_POST['content']);
 
    $stmt->execute();

    $stmt1=$conn->prepare("select user.username, post.content, post.title from post inner join user on user.id=post.creator where content like ?");
    $stmt1->bind_param("s",
    $place_query);
   $place_query = "%".$_POST['content']."%";
    $stmt1->execute();
    $result = $stmt1->get_result();
    
    $places= array();
    while($row=$result->fetch_assoc()){
    	$row['title']=htmlspecialchars($row['title']);
    	$row['content']=htmlspecialchars($row['content']);
    	$row['username']=htmlspecialchars($row['username']);
    	array_push($places, $row);
    	}
    	print(json_encode($places));
?>