<!DOCTYPE html>
<html>
<head>
<title>GAME-RENT LOGIN</title>
</head>
<body background="img/bg.jpg">
<?php
session_start();
function verificar_login($user,$password) {
	include_once "conexion.php";
    $sql = "SELECT count(usuario) as similitudes FROM usuarios WHERE pass='".$password."' AND usuario = '".$user."' group by pass having count(usuario) > 0";
    $rec = pg_query($sql);
	if($row = pg_fetch_array($rec)){
		if($row["similitudes"] > 0){
			return 1;
		}
	}
		return 0;
} 

if(!isset($_SESSION['userid'])) 
{
    if(isset($_POST['login'])) 
    { 
        if(verificar_login($_POST['user'],$_POST['password'])) 
        {
			$_SESSION['userid'] = $_POST['user'];
			header("location:main.php");
        }
        else 
        { 
            echo '<div class="error">Su usuario es incorrecto, intente nuevamente.</div>';
        } 
    } 
?> 
<style type="text/css"> 
*{ 
    font-size: 14px; 
} 
body{ 
background-color: #FFF; 
} 
form.login { 
    background: none repeat scroll 0 0 #F1F1F1; 
    border: 1px solid #DDDDDD; 
    font-family: sans-serif; 
    margin: 0 auto; 
    padding: 10px; 
    width: 460px; 
    box-shadow:0px 0px 20px black; 
    border-radius:10px; 
} 
form.login div { 
    margin-bottom: 20px; 
    overflow: hidden; 
} 
form.login div label { 
    display: block; 
    float: left; 
    line-height: 25px; 
} 
form.login div input[type="text"], form.login div input[type="password"] { 
    border: 1px solid #DCDCDC; 
    float: right; 
    padding: 4px 25px;


} 
form.login div input[type="submit"] { 
    background: none repeat scroll 0 0 #DEDEDE; 
    border: 1px solid #C6C6C6; 
    float: right; 
    font-weight: bold; 
    padding: 4px 20px; 
}
form.login div img { 
    float: left;
    font-weight: bold; 
    padding: 4px 20px; 
}
.error{ 
    color: red; 
    font-weight: bold; 
    margin: 10px; 
    text-align: center; 
} 
</style> 

<form action="" method="post" class="login"> 
	<div><label><img src="img/ubb_logo.png"/></label></div>
    <div><label>Username : </label><input name="user" type="text" ></div> 
    <div><label>Password : </label><input name="password" type="password"></div> 
    <div><input name="login" type="submit" value="login"></div> 
</form> 
<?php 
} else { 
    echo 'Click para salir de la aplicacion';
	session_destroy();
    echo '<a href="index.php">Logout</a>';
} 
?> 
</body>
</html>