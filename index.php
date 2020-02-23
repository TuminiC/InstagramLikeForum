<!DOCTYPE html>
<?php
session_start();
?>
<html>
   <head>
      <meta charset = "utf-8">
      <style type = "text/css">
         body{ 
         	border-style: solid;
         	border-width: 5px; }
         #content{
         	width: 100%;
         }
         .parent{
         	font-weight: normal;
         	border-style:groove;
         	border-width: 1px;
         	padding-right: 10px;
         	padding-left: 10px;
         	border-width: thin;
         	font-size: large;
         	margin: 10px;
         }
         #input{
         	margin: 10px;
         	font-size: 20px;
         	font-weight: normal;
         	padding-top: 10px;
         }
         #post{
         	margin:10px;
         }
         #no_post{
         	margin:10px;
         }
        
         
      </style>
   </head>
<body>
    <?php include 'menu.html';?>
    <?php include 'sql_connect.php';?>
    <h1 id="post" >Posts<h1>
    
   <?php 
     $stmt =$conn->prepare("select post.title, post.content ,user.username from post inner join user on user.id=post.creator");
        $stmt->execute();
        $result = $stmt->get_result();
        $style="hidden";
        
        if($result->num_rows==0){
        	$style="";
        }
        while($row = $result->fetch_assoc()) {
            print('<p class= "parent"><strong> Title: '.htmlspecialchars($row['title']).'</strong> <br /> By: '.htmlspecialchars($row['username']).'<br />'.htmlspecialchars($row['content']).'<br /></p> ');
        }
    ?>
    <p id="no_post"<?php echo $style; ?> > No posts available</p>
    <div id ="div"></div> 
  
    <?php
    $style1="";
  		if(!isset($_SESSION['username'])) {
  			$style1="hidden";
      		print('You need to log in to make a post');
    	}
    ?>
    <p id="input"<?php echo $style1;?>>
  				<strong>Create a post as <?php echo htmlspecialchars($_SESSION['username'])?></strong><br/>
    			Title: <input type="text" id="title"/><br/>
    			Content:<br/> <textarea type="text" id="content" cols="20" rows="10"></textarea>
    			<button type="submit" id="submit">Submit post</button>
    			</p>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
           $(document).ready(function(){
           $('#submit').click(function(){ 
            if($('#title').val().length==0){
                alert("add title");
             } else if($('#content').val().length==0){
                alert("add content");
             } else{
                    var title_str=$('#title').val();
                    var content_str=$('#content').val();
                                 
                    $.ajax({
                    method:"post",
                    dataType: "JSON",
                    url:"do_add.php",
                    data:{ title: title_str, content: content_str}
                    })
                    .done(function(response){
                        $('#title').val('');
                        $('#content').val('');
                        appendResponse(response);
                    })
                    .fail(function(jqXHR){
                    	alert(jqXHR.statustext+ jqXHR.status);
                    	});
        	}
   		})
    })
    function appendResponse(data){
    	var html='';
    	html+='<p class= "parent">';
    	html+='<strong>Title: ';
    	html+=data[0]['title'];
    	html+='</strong><br/> By: ';
    	html+=data[0]['username'];
    	html+='<br />';
    	html+=data[0]['content'];
    	html+='</p>';
    	$('#no_post').remove();
    	$('#div').append(html);
	}
    
  </script>
  
</body>
</html>