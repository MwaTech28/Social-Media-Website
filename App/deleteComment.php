<?php

   include_once 'mydb.php';

	   $id = $_POST['id_com'];
		
		$sql = "DELETE FROM comments WHERE id = ?";
		$statementimg = mysqli_prepare($conn,$sql);
					mysqli_stmt_bind_param($statementimg,'s',$id);
					mysqli_stmt_execute($statementimg);


?>