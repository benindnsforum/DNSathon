<?php
  require_once "../model/Db_Handler.php";
  $db=new Db_Handler();
  $error1=false ;
  $error2=false ;
  $error=false;
  $errorsms="";
  $errorsms1="";
  $errorsms2="";
  $email;
  $pass;
  if ($_SERVER['REQUEST_METHOD'] =="POST" && $_POST['login'] == "Se connecter") {
  	
  if(!empty($_POST["email"])){
     $email=$_POST["email"];
     $email=filter_var($email,FILTER_SANITIZE_STRING);

    }
    else{
     $error1=true;
     $errorsms1="Vous devez entrer un surnom";
    }
    if(!empty($_POST["pass"])){
     $pass=$_POST["pass"];
     $pass=filter_var($pass,FILTER_SANITIZE_STRING);
    }
    else{
     $error2=true;
     $errorsms2="Vous devez entrer un mot de passe";
    }
     
     if(!$error1 && !$error2){
      $response=$db->isLoginUser($email,$pass);
      //include('connectbd.php');
      //       $bdd_select = $db->prepare('SELECT * from users');
      //       $bdd_select->execute();
      //       while ($row = $bdd_select->fetch()) {
      //         if ($row['login'] == $email && $row['psw'] == $pass) {
      //           $response = true;
      //          }
      //         } 
      if($response){
            $_SESSION["userlogin"]=$email;
            $_SESSION["userpass"]=$pass;
            header("Location: dashboard.php");
          }else{
        $error=true;
        $errorsms="ID ou mot de passe inconnu";
        $_SESSION['errorsms'] = $errorsms;
        $_SESSION['error'] = $error;
      }
      

     }       

  }
?>