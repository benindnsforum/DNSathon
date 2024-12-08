<?php
  require_once "/model/Db_Handler.php";
  $db=new Db_Handler();
class dns
{
	
	private $conn;
	private $racine;
	private $racine1;
	function __construct()
	{
	require_once ('Db_Connect.php');
	$db=new Db_Connect();
	$this->conn=$db->connect();	
	}


    public  function dnsExist(){
     if (isset($_POST['submit'])) {
     	
     }
	
    }


    
    
}

?>