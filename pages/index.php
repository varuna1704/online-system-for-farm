<?php
include __DIR__ . '/../includes/header.php';
?>
<?php
include __DIR__ . '/../includes/auth.php';
?>
 <!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title> WELCOME HOME </title>
<style>
    .box{
        width:1000px;
        height: 500px;
        font-family:sans-serif;
        
    }
     body{
        background-color:#C0C0C0; 
    }
    h1{
        color: darkmagenta;
      
    }
    h3{
        color: green;
        margin-left: 420px;
        font-size: 50px;
    }
    
</style>
<link rel="stylesheet" href="homepage.php"/>
</head>
<body>
    <table>
<div class="box">
    <marquee><h1><b>WELCOME TO ONLINE SYSTEM FOR FARM</b><h1></marquee>
   <?php echo htmlspecialchars($_SESSION["user_name"] ?? ""); ?>

<a href="homepage.php"><h3>HOMEPAGE</h3></a>
</div>
        
    </table>
</body>
<?php
include __DIR__ . '/../includes/footer_agri.php';
?>
</html>

