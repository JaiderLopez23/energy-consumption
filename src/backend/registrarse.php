<?php 
   include('../config/database.php');
  // lopcal
  
   $nom   = $_POST['n_om'];
   $ape   = $_POST['a_pe'];
   $tel   = $_POST['t_el'];
   $email = $_POST['e_mail'];
   $pass  = $_POST['p_ass'];
   
   // INCRIPTAR CONTRASEÑA
   $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
   
   $sql_validate_email ="
       select
         COUNT(id) as total
       from
         usuarios
       where email = '$email'
       and status = true
   ";
   $ans = pg_query($conn, $sql_validate_email);

   if($ans){
    $row = pg_fetch_assoc($ans);
    if($row['total'] > 0){
      echo "User already exists !!!";  
    }else{
        $sql = "INSERT INTO usuarios
        (nombre, apellido, telefono, email, password)
        VALUES ('$nom','$ape','$tel','$email','$hashed_password')
        ";
    $ans = pg_query($conn, $sql);
    if($ans){
     echo "<script>alert('User has created. Go to registrarse')";
     header('Refresh:0;URL=http://localhost/energy-consumption/src/login.html');
     
    }else{
        echo "Error";
    }    
    }
   }else{
    echo "Query error"; 
   }
?>