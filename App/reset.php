<?php
  include_once 'mydb.php';

       if(isset($_POST['subbtn2'])){
        if(isset($_SESSION['id'])){
       	$id = $_SESSION['id'];
		$name = $_POST['name'];
		$lname = $_POST['lname'];
       	$loc = $_POST['loc'];
		$age = $_POST['age'];
       	$ps = $_POST['ps'];
        $hps = password_hash($ps,PASSWORD_BCRYPT);//ALWAYS HASH THE PASSWORDS TO PREVENT THEM FROM BEING HACKED

        if($name != ''){//RESET OR UPDATE FIRST NAME
        $sql = "UPDATE users SET fname='$name' WHERE id='$id'";
        $result = mysqli_query($conn,$sql);
		}
		
		if($lname != ''){//RESET OR UPDATE LAST NAME
        $sql = "UPDATE users SET lname='$lname' WHERE id='$id'";
        $result = mysqli_query($conn,$sql);
		}

        if($ps != ''){//RESET OR UPDATE PASSWORD
        $sql = "UPDATE users SET pass='$hps' WHERE id='$id'";
        $result = mysqli_query($conn,$sql);
		}
		
		if($loc != ''){//RESET OR UPDATE YOUR LOCATION
        $sql = "UPDATE users SET loc='$loc' WHERE id='$id'";
        $result = mysqli_query($conn,$sql);
		}
		
		if($age != ''){//RESET OR UPDATE YOUR AGE
        $sql = "UPDATE users SET age='$age' WHERE id='$id'";
        $result = mysqli_query($conn,$sql);
		}

        if(!$result){

		echo "<script> alert('update error'); document.location='testupload.php'</script>";
	}else{
			echo "<script> alert('successfully updated'); document.location='user4withajax2.php'</script>";

	}
     }
    }

?>