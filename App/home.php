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
	
    </head>
	
	<header> </header>
	
    <body>
      
      <?php

        include_once 'mydb.php';//GET SESSION, SERVER AND DATABASE CONNECTION
		echo "<div class='block1'> </div>";

              if(isset($_SESSION['id'])){//CHECKS TO SEE IF YOU ARE LOGED IN AND FIRES THE STATEMENTS BELOW
					
					$id = $_SESSION['id'];

					$sql = "SELECT fname,lname FROM users WHERE id = ?";
					$statement = mysqli_prepare($conn,$sql);
					mysqli_stmt_bind_param($statement,'s',$id);
					mysqli_stmt_execute($statement);
					
					$result = mysqli_stmt_get_result($statement);

		$rowsUser = mysqli_fetch_assoc($result);
		$nam = $rowsUser['fname'];
                    $lnam = $rowsUser['lname'];

                     $sql2 = "SELECT * FROM proimg WHERE userid='$id'";
                  $imgres = mysqli_query($conn,$sql2);
						
						/*IF SIGNED IN
				  CREATE THE BELLOW TEMPLATE LAYOUT*/
				  
				  echo "<div class='wrap'>";
				 
				 //GET YOUR PROFILE IMAGE
				  $sql_img = "SELECT status FROM proimg WHERE userid = ?";
					$statementimg = mysqli_prepare($conn,$sql_img);
					mysqli_stmt_bind_param($statementimg,'s',$id);
					mysqli_stmt_execute($statementimg);
					
					$result1 = mysqli_stmt_get_result($statementimg);
					$result2 = mysqli_fetch_assoc($result1);
		            $status = $result2['status'];
					
                    $image;
					if($status === 0){//CHECK IF USER UPLOADED A PROFILE IMAGE TO DISPLAY IT OTHERWISE USE THE DEFAULT IMAGE
						 $image = 'pics/Profile'.$id.'.jpg';
					}else{
						$image = 'pics/default.jpg';
					}
		
		echo "<table id='navbar'  >
            <tr><td><table id='table2'  ><tr><td><h3><img src='$image' height='50px' width='50px' align='center'/> $nam $lnam </h3> </td>
            </table></td>
            <td><li class='navbarBtn'><a href='user4withajax2.php'>profile</a><a href='logout.php'>Logout</a></li></td></tr>
        </table>";

                  echo "<div class='home'>
            <center>
            <h1>HOME</h1>
        </center>
         </div>";
		
		 /*CREATE AND STATE NAME OF WEBSITE DISCRIPTION, NUMBER OF SIGNED UP USERS*/
		
		$sqlM = "SELECT * FROM users ";
        $member_result = mysqli_query($conn,$sqlM);
		$memberSize = mysqli_num_rows($member_result);
		echo " <div id ='leftbox'> <div> <table id='tableleft'   >
	   
            <tr><td  class='wel' bgcolor=' white'><h1>Football Lounge</h1><br/><h3>football news, updates and debates</h3></td></tr>
            <tr><th><h2>Members $memberSize</h2></th></tr>
        </table> ";
		
		echo "
        <div id='members'>
        ";
		
        if(mysqli_num_rows($member_result) > 0){
           mysqli_data_seek($member_result, 0);
        while ($rows5 = mysqli_fetch_assoc($member_result)) {//LOOP THROUGH ALL USERS
            
          $id = $rows5['id'];
          $fn = $rows5['fname'];
          $ln = $rows5['lname'];
            if($_SESSION['id'] == $id){
              continue;
              }


            $sql21 = "SELECT status FROM proimg WHERE userid='$id'";
                  $imgres = mysqli_query($conn,$sql21);
                  $rows21 = mysqli_fetch_assoc($imgres);
					  
                   if($rows21['status'] == 0){//CHECK IF USER UPLOADED A PROFILE IMAGE TO DISPLAY IT
        echo "
            <table cellspacing='5' >
              <tr><td><li><img src='pics/Profile".$id.".jpg' height='30' width='30'/>     $fn   $ln</li></td></tr>

            </table>";
      }else{//IF USER DID NOT UPLOAD PROFILE IMAGE USE THE DEFAULT IMAGE
         echo "
            <table cellspacing='5' >
              <tr><td><li><img src='pics/default.jpg' height='30' width='30'/>     $fn   $ln</li></td></tr>

            </table>";
      }

            }
          }
            echo "
        </div>";
		
		echo "</div> </div>";
		
		echo "<div id='rightbox'>";
    
	    //GET ALL COMMENTS FROM SIGNED UP MEMBERS
        $sql5 = "SELECT * FROM comments ORDER BY id DESC ";
        $result5 = mysqli_query($conn,$sql5);
		$amount = mysqli_num_rows($result5);//GET TOTAL AMOUNT OF COMMENTS AND SET IT TO A VARIABLE
		
		echo "<div class='chatcaption'><caption><h2 id='captionAmount'>LETS CHART $amount comments</h2></caption></div>";
		
	    echo "<div id='tableright'><table id='tb4'  cellspacing='20' >
            ";
		
		if(mysqli_num_rows($result5) > 0){
			
        while($rows6 = mysqli_fetch_array($result5)){//LOOP THROUGH ALL THE COMMENTS
        
          $nm = $rows6['com'];
          $idc = $rows6['userid'];

          $sql55 = "SELECT id,fname,lname FROM users WHERE id = '$idc' ";//GET THE ID IN THE USER DATABASE TABLE BELONGING TO THE COMMENT
        $result55 = mysqli_query($conn,$sql55);
		
        $rows66 = mysqli_fetch_array($result55);//GET USER DATABASE INFO
                    $id2 = $rows66['id'];
                    $nam2 = $rows66['fname'];
                    $lnam2 = $rows66['lname'];

            $sql21 = "SELECT * FROM proimg WHERE userid='$id2'";
                  $imgres = mysqli_query($conn,$sql21);
                  while($rows21 = mysqli_fetch_assoc($imgres)){
					  
        if($rows21['status'] == 0){//CHECK IF USER UPLOADED A PROFILE IMAGE TO DISPLAY IT
        echo "
            
           <tr><td id='chattext'><img src='pics/Profile".$id2.".jpg' height='40' width='40' align='left'/><div class='sy'><p><strong>$nam2 $lnam2 Says:</strong> <br/>$nm<p></div></td></tr>
         
        ";
      }else{//IF USER DID NOT UPLOAD PROFILE IMAGE USE THE DEFAULT IMAGE
         echo "
            
           <tr><td id='chattext'><img src='pics/default.jpg' height='40' width='40' align='left'/><div class='sy'><p><strong>$nam2 $lnam2 Says:</strong> <br/>$nm<p></div></td></tr>
         
        ";
      }
    }

        }
			  }else{
				 echo " <center> <div id='chatmsg'> <h1> No available comments yet <br> tap on the pen icon to start chatting </h1> </div> </center> ";
			  }
		echo "</div>";
		
		//GET ALL SIGNED UP MEMBERS
        echo "</table></div>";
          				    
			
			echo "</div>";
			
			//CHART BUTTON AND INPUT TEXT BOX THIS IS HIDDEN BY DEFAULT UNTILL YOU CLICK ON IT
			echo "<div id='chatBtnwrapper'> <div id='chatBtn'> <img src='./pics/editblue.png' width='35px' height='35px' /> </div> <div id='textbox'> <input id='textboxinput' type='text' placeholder='send a text'/> <button id='postBtn' onclick='send($amount)'> send </button></div> </div>";
			
                      }else{
				  echo "<div class='wrap'>";
				  
				  /*IF NOT SIGNED IN
				  CREATE THE BELLOW TEMPLATE LAYOUT*/
		
		echo "<table id='navbar'  >
            <tr><td><table id='table2'  ><tr><td><h3><img src='pics/user.png' height='50px' width='50px' align='center'/> You are not loged in </h3> </td>
            </table></td>
            <td><button id='navbarBtnlogin' onclick='openLogin()'>Login</button></td></tr>
        </table>";

            /*CREATE BODY INCLUDE HOME BAR REGISTRATION, LOGIN SECTIONS*/
            echo "<div class='home'>
            <center>
            <h1>HOME</h1>
        </center>
         </div>";
		 
		 /*CREATE LOGIN FORM*/
		 
         echo " <center>
          <form action='login.php' method='POST'>
            <table class='logtbl' bgcolor='#3f4f4f' cellspacing='15'>
                <caption ><h2>Login</h2></caption>
                <tr><td>Username:</td></tr>
                <tr><td><input type='text' id='un' name='usn'></td></tr>
                <tr><td>Password:</tr>
                 <tr><td><input type='password' id='ps' name='pwd'></td></tr>
                 <tr><td><button type='submit' onclick='log()' name='logbt'>Login</button></td></tr>
				 <tr><td><div id='backBtn'>click this to go back</div></td></tr>
            </table>
              </form>
         </center>";
		 
		 /*CREATE AND STATE NAME OF WEBSITE DISCRIPTION, SIGN UP AND LOGIN BUTTON*/

		echo " <div id ='leftbox'> <div> <table id='tableleft'  >
	   
            <tr><td  class='wel' bgcolor=' white'><h1>Football Lounge</h1><br/><h3>football news, updates and debates</h3></td></tr>
            <tr><td><li id='sign' onclick='openSignIn()'>Sign Up to Register Account</li></td></tr>
            <tr><td><li id='log' onclick='openLogin()'>Login In to User Account</li></td></tr>
        </table> </div> </div>";
		
		/*CREATE OFFLINE LAYOUT, PURPOSE OF CHARTS OR TYPES OF TOPICS TO EXPECTS FROM CHARTS
		YOU CAN CUSTOMISE THIS SECTION BY ADDING YOUR OWN TOPIC AND BRAND IMAGE
		*/
		
		echo "<div id='rightbox'> <div class='rightbox2'> <table id='tableright'  cellspacing='35' >

		<img id='cover' src='./pics/messi2.jpg' width='100%' height='100%' />
            <caption class='about'><h2>ABOUT US</h2></caption>
            <h1 class='descNormal'>This is a simple website designed to register accounts<br/>discuss news, updates and debates of your choice
                <br/><br/>*Click on register to create user account<br/>*Click on Login to access your profile<br/>Note:<br/>You have to be loged in to unlock, view and participate in the chart session</h1>
        </table> </div> </div>";
		
		echo "</div>";
       

                  }
        
        
        ?>

        <script src="js/jquery.js"/></script>
   <script type="text/javascript" src="js/mediaelement-and-player.min.js"/></script>
   <script type="text/javascript" src="js/ajax.js"/></script>
   <script type="text/javascript" src="js/jquery-1.11.1.js"/></script>
   <script type="text/javascript" src="js/jquery-3.1.1.js"/></script>
   <script type="text/javascript">

			 var commentsize = document.getElementById('captionAmount');
			 var n = 0;//SENT NUMBER HOLDER
			 function send(num){
				 n++;//INCREASE THE SENT NUMBER HOLDER BY ONE EVERY TIME YOU SEND A COMMENT
				 var new_n = n + num;//CREATE THE NEW AMOUNT OF AVAILABLE COMMENTS BY ADDING THE OVERALL COMMENTS BY THE ACCUMULATED SENT NUMBER HOLDER ABOVE
               var comment = $('#textboxinput').val();

               //GET ALL COMMENTS FROM PHP SCRIPT COM.PHP
               $.ajax({
                   url:'com.php',
                   type:'POST',
                   async:false,
                   data:{
                       "comm":comment
                   },
                   success: function(data){//RETURN THE NEW COMMENT DATA CREATED FROM THE COM.PHP FILE
					   commentsize.innerHTML = "LETS CHART "+new_n+" comments ";
					   $('#chatmsg').css('display','none');
                       $('#tb4').prepend(data);//INSERT NEW COMMENT DATA INTO THE THE COMMENT DIV WRAPPER
                         $('#textboxinput').val('');
                   },
                   error: function(){
                       alert("error");
                   }
               });
		   }

  function openLogin(){//CREATE LOGIN POP UP ANIMATION AND LOGIN TO AN ACCOUNT
	  
	$('.block1').css('display','inline-block');
  $('.logtbl').fadeIn(700,function(){
       $('.logtbl').css('z-index','9');
       $('#lb').click(function(){
    $('body').css('background','#ff4136');
    $('body').css('opacity','.9');
  $('.logtbl').css('display','none');
});
  });
  
  }

function openSignIn(){//OPEN THE SIGN IN URL TO SIGN UP AN ACCOUNT
	var path = '/MwaSocialMedia/sign_in.php' //ADD THE PATH WHERE YOU SAVED YOUR SIGN IN PHP FILE FOR THIS TO WORK EG IF YOU ARE USING WAMP WWW/MWASOCIALMEDIA/SIGN_IN.PHP
	window.location.pathname = path;
	
}

$('#backBtn').click(function(){//CLOSE OR REMOVE LOGIN POP UP ANIMATION
	$('.block1').css('display','none');
  $('.logtbl').fadeOut(400);
});

var open = false;

 $('#chatBtn').click(function(){//CREATE A CHART TEXT INPUT SLIDE POP UP ANIMATION
	 if(open === false){
	$('#textboxinput').css('padding','10px');
    $('#textbox').animate({'width':'250px'},500);
	 open = true;
	 }else{
		 $('#textbox').animate({'width':'0px'},500,function(){
			$('#textbox').css('padding','0'); 
			$('#textboxinput').css('padding','0');
			open = false;
		 });
		 
	 }
   
});

 </script>
    </body>
        <footer>
  
 </footer>


</html>
