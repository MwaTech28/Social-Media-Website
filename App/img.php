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
    <body>
  
        <?php
        session_start();
        include_once 'mydb.php';

        if(isset($_POST['subbtn'])){
              

            if(isset($_SESSION['id'])){
               $Sid = $_SESSION['id'];

               $sql = "SELECT * FROM users where id = '$Sid'";
        $result = mysqli_query($conn,$sql);
		
            $fileinfo = $_FILES['fl'];
            
            $fname =  $fileinfo['name'];
            $ftype =  $fileinfo['type'];
            $fsize =  $fileinfo['size'];
            $ferror =  $fileinfo['error'];
            $ftemp = $fileinfo['tmp_name'];

            $Extn = explode('.', $fname);
            $Rextn = strtolower(end($Extn));

            $listOfextn = array('png','jpg','jpeg');
          while($rows = mysqli_fetch_assoc($result)){

                if($Sid = $rows['id']){
 
            if(in_array($Rextn, $listOfextn)){
                if($ferror === 0){
                     if($fsize < 100000000){
                         $inqName = "Profile".$Sid.'.'.$Rextn;
                         $dest = 'pics/'.$inqName;
                         move_uploaded_file( $ftemp, $dest);
                         $sql3 = "UPDATE proimg SET status = 0 WHERE userid='$Sid';";
                         $result3 = mysqli_query($conn,$sql3);
                         echo "<script> alert('image has succesfully been posted'); document.location='user4withajax2.php'</script>";
                         
                     }else{
                        echo "file is too big";
                     }

                }else{
                  echo "there was an error uploading";
                }
            }
        }
         continue;
        }
}
        }
        
        ?>
    </body>
</html>