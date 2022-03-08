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
        <link href ="sign.css" rel = "stylesheet" type="text/css">
    </head>
    <body>
  
    <center>
        <div class="wrapfrm">
        <form class="fm" method="post" action="mydb.php">
            <h1>Sign Up to Register Account</h1>
            <table border="0" cellspacing="15" cellpadding="10" bgcolor="#3f4f4f">
                <tr><td class="ask">FirstName</td><td class="ask">LastName</td></tr>
                <tr><td ><input class="fld" type="text" name="fname" placeholder="Enter First Name.."></td></d><td><input  class="fld" type="text" name="lname" placeholder="Enter Last Name.."></td></d></tr>
                <tr><td class="ask">Email</td><td class="ask">Password</td></tr>
                <tr><td><input class="fld" type="text" name="email" placeholder="Enter Your mail.."></td></d><td><input  class="fld" type="password" name="pass" placeholder="Enter Your Password.."></td></d></tr>
            </table>
            <button class="signbt" type="submit" name="sub">SignUp</button>
        </form>
   
    </div>
     </center>
        <?php
        
        ?>
    </body>
</html>
