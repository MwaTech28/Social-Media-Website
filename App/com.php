

<?php
        include_once 'mydb.php';

              if(isset($_SESSION['id'])){
				  
				  $id = $_SESSION['id'];
        $sql = "SELECT id,fname,lname FROM users WHERE id ='$id' ";
        $result = mysqli_query($conn,$sql);
				  
                      $rows = mysqli_fetch_assoc($result);
                        
                    $fn = $rows['fname'];
                    $ln = $rows['lname'];
                    $comnt = mysqli_escape_string($conn,$_POST['comm']);

                      $sql2 = "INSERT INTO comments(userid,com) values('$id','$comnt')";
                    
                      mysqli_query($conn,$sql2);

                         $sql21 = "SELECT status FROM proimg WHERE userid='$id'";
                  $imgres = mysqli_query($conn,$sql21);
                  $rows21 = mysqli_fetch_assoc($imgres);
                   if($rows21['status'] == 0){
					   
					   //CREATE NEW COMMENT LAYOUT AND SENDING
              echo "

            <tr><td id='chattext' ><img src='pics/Profile".$id.".jpg' height='40' width='40' align='left'/><div class='sy'><p><strong>$fn $ln Says:</strong> <br/>".$comnt."<p></div></td></tr>
            
               ";
      
    }else{
		
		//CREATE NEW COMMENT LAYOUT AND SENDING
      echo "

            <tr><td id='chattext' ><img src='pics/default.jpg' height='40' width='40' align='left'/><div class='sy'><p><strong>$fn $ln Says:</strong> <br/>".$comnt."<p></div></td></tr>
            
       ";

    }


              }
          

?>

