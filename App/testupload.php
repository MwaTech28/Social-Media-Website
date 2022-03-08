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
        
    </head>

    <?php
        include_once 'mydb.php';

        if(isset($_SESSION['id'])){

          $Sid = $_SESSION['id'];

           $sql = "SELECT * FROM users ";

        $result = mysqli_query($conn,$sql);
 if(mysqli_num_rows($result) > 0){
            while($rows = mysqli_fetch_assoc($result)){
                $dfn = $rows['fname'];
                $dln = $rows['lname'];
                $dos = $rows['pass'];
                $id = $rows['id'];  

          if($Sid == $id){
                echo "

                  <center><h1>Edit your Profile</h1></center>
				<center>  
        <h1>Upload Profile Photo</h1>
  <form action='img.php' method='Post' enctype='multipart/form-data'>
    
     <input type='file' name='fl'>
     <button type='submit' name='subbtn'>Upload</button>
 </form>


  <h1>Reset Your Personal Details</h1>
 <form action='reset.php' method='Post' enctype='multipart/form-data'>
    <div> <input type='text' name='ps' placeholder='change password'> </div>
	<div><input type='text' name='name' placeholder='change first name' > </div>
	<div><input type='text' name='lname' placeholder='change last name' > </div>
	<div><input type='text' name='loc' placeholder='change location'> </div>
	<div><input type='text' name='age' placeholder='change you age'> </div>
     <button type='submit' name='subbtn2'>change</button>
 </form>
 
 </center>
                ";
}
              }
            }
          }
        
        ?>
    <body>
 
        
    </body>
</html>