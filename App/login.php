<?php

  include_once 'mydb.php';
    if(isset($_POST['logbt'])){
            $usern = $_POST['usn'];
            $pas = $_POST['pwd'];

            $sql = "SELECT id,fname,pass FROM users";

        $result = mysqli_query($conn,$sql);
           
           if(mysqli_num_rows($result)>0){
            while($rows = mysqli_fetch_assoc($result)){//LOOP THROUGH ALL USERS UNTIL YOUR USERNAME AND PASSWORD YOU ENTERED ARE DETECTED
                $dfn = $rows['fname'];
                $hash = $rows['pass'];
                $id = $rows['id'];

                if($usern === $dfn && password_verify($pas,$hash)) { //CHECK IF USERNAME AND PASSWORD MATCH TO LOGIN
                	$_SESSION['id'] = $id;
                    header("Location: user4withajax2.php");
                }
                else{
                  echo "<script> alert('You entered Invalid credentials make sure to insert the correct username and passwowd'); document.location='home.php'</script>";
                }

              }
            }else{
               echo "<script> alert('Error Database is empty please Register an Account'); document.location='home.php'</script>";
            }
          }
?>