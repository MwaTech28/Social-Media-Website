<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
		<link href ="main.css" rel = "stylesheet" type="text/css">
      <link href ="users.css" rel = "stylesheet" type="text/css"/>
    </head>
    <body>
    
        
     <header> </header>
        
        <?php

        include_once 'mydb.php';//GET SESSION, SERVER AND DATABASE CONNECTION

        echo "<div class='wrap'>";

        if(isset($_SESSION['id'])){//CHECK IF YOU ARE LOGGED IN

          $Sid = $_SESSION['id'];
		   
		   $sql = "SELECT id,fname,lname,loc,age FROM users WHERE id = ?";
					$statement = mysqli_prepare($conn,$sql);
					mysqli_stmt_bind_param($statement,'s',$Sid);
					mysqli_stmt_execute($statement);
					
					$result = mysqli_stmt_get_result($statement);

 if(mysqli_num_rows($result) > 0){

				$rows = mysqli_fetch_assoc($result);
                $dfn = $rows['fname'];
                $dln = $rows['lname'];
                $location = $rows['loc'];
				$ages = $rows['age'];
                $id = $rows['id'];  
        
                  //GET YOUR PROFILE IMAGE
				  $sql_img = "SELECT status FROM proimg WHERE userid = ?";
					$statementimg = mysqli_prepare($conn,$sql_img);
					mysqli_stmt_bind_param($statementimg,'s',$id);
					mysqli_stmt_execute($statementimg);
					
					$result1 = mysqli_stmt_get_result($statementimg);
					$result2 = mysqli_fetch_assoc($result1);
		            $status = $result2['status'];
					
                    $image;
					if($status === 0){
						 $image = 'pics/Profile'.$id.'.jpg';
					}else{
						$image = 'pics/default.jpg';
					}
						
						echo "<table id='navbar'  >
            <tr><td><table id='table2'  ><tr><td><h3><img src='$image' height='50px' width='50px' align='center'/> $dfn $dln </h3> </td>
            </table></td>
            <td><li class='navbarBtn'><a href='home.php'>home</a><a href='logout.php'>Logout</a></li></td></tr>
        </table>";

                        echo " <div class='timeline'>
						<div id='timelinecover'> </div>
            <img src='$image' height='150' width='150'/>
            <h2>TimeLine</h2>
            
        </div>";
		
		//SET LOCATON AND AGE DETAILS (EDIT)
		$loc = 'location: '.$location;
		$age = 'age: '.$ages;
		
		echo "  

                <div id='details'>
				<center><a href='testupload.php'>Edit</a></center>
            <center><p>$loc</p></center>
            <center><p>$age</p></center>
            <center><p class='pn'>$dfn $dln</p></center>
				</div>

        ";
        
        echo "  

                <div class='welcome'><center><h1 class='tag'>Welcome $dfn $dln</h1></center></div>

        ";
		
		echo "<div id='commentwrapper'> ";
		
		$sql_msg = "SELECT com,id FROM comments WHERE userid = '$Sid' ";

        $result_msg = mysqli_query($conn,$sql_msg);
       if(mysqli_num_rows($result_msg) > 0){//GET ALL YOUR COMMENTS AND DISPLAY THEEM ON YOUR PROFILE PAGE
	     $amount = mysqli_num_rows($result_msg);
	     echo "<center><h1 id='commentssize'> You sent $amount comments </h1><c/enter>";
	        $start = 0;
            while($rows = mysqli_fetch_assoc($result_msg)){//LOOP THROUGH ALL COMMENTS
                $comment = $rows['com'];
                $commentID = $rows['id'];
				
				//CREATE A SPECIAL UNIQUE KEY FOR ALL COMMENTS TO BE ABLE TO DELETE THEM SPECIFICALLY
				$location = $start;
				$classID = 'com'.$location;

		  echo "  
				
				<div id='$classID'> <div class='comment'><center><h1 class='commenttext'>$comment </h1> <button class='deleteBtn' onclick='deleted($commentID,$location,$amount)'> delete </buttom> </center> </div> </div>

          ";
              $start +=1;//INCREASE THE START VARIABLE BY ONE EVRY TIME THERE IS A NEXT COMMENT
			}
			
         }else{
			 echo "<center><h1 id='commentssize'> Your sent 0 comments </h1></center>";
		 }
		 
		 echo "</div>";

                    }

                }else{
					
					echo "<center> <h1> Sorry you are not loged in </h1> </center>";
					
				}
            
			echo "</div>";
        
        ?>
	 
	 <script src="js/jquery.js"/></script>
   <script type="text/javascript" src="js/mediaelement-and-player.min.js"/></script>
   <script type="text/javascript" src="js/ajax.js"/></script>
   <script type="text/javascript" src="js/jquery-1.11.1.js"/></script>
   <script type="text/javascript" src="js/jquery-3.1.1.js"/></script>
   <script type="text/javascript">
   
    var n2 = 0;//DELETED NUMBER HOLDER
	
    function deleted(id_com,num,size){
		//deleting comment;
		var commentsize = document.getElementById('commentssize');
		var n = "com"+num;
		var element = document.getElementById(n);
		
		n2++;//INCREASE THE DELETED NUMBER HOLDER BY ONE EVERY TIME YOU DELETE A COMMENT
	    var new_n = size - n2;//CREATE THE NEW AMOUNT OF AVAILABLE COMMENTS BY SUBTRACTING THE OVERALL COMMENTS BY THE ACCUMULATED DELETED NUMBER HOLDER ABOVE
		
		if(new_n > -1){//MAKE SURE YOU CAN ONLY DELETE A COMMENT IF IT'S AVAILABLE BY CHECKING IF THE NEW AMOUNT IS GREATER THAN ZERO OR NEGATIVE
		
		$.ajax({
                   url:'deleteComment.php',
                   type:'POST',
                   async:false,
                   data:{
                       "id_com":id_com
                   },
                   success: function(data){
					   
						 element.remove();//DELETE COMMENT IN HTML
						 commentsize.innerHTML = "Your sent "+new_n+" comments ";//REPLACE NEW AMOUNT OF AVAILABLE COMMENTS
                   },
                   error: function(){
                       alert("error");
                   }
               });
		}
		
	}

   
   </script>
      
    </body>

</html>