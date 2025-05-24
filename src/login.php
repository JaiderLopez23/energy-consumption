<?php 

   include('config/database.php');

     $email = $_POST['e_mail'];
     $pass  = $_POST['p_ass'];

     // INCRIPTAR CONTRASEÑA
    // $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

     $sql = "
     SELECT
       u.id ,
       COUNT(u.id) as total
     FROM usuarios u
     WHERE 
     email = '$email' and
     password = '$hashed_password'
     group by id
     ";
     $res = pg_query($conn, $sql);
     if($res){
         $row = pg_fetch_assoc($res);
         if($row['total'] > 0){
            header('Location: http://localhost/energy-consumption/src/inicio.html');
         }else{
             echo "login failed !!!";
         }
     }
     ?>