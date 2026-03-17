<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<link rel="stylesheet" href="../css/header1.css"/>
<style>
.navbar{
 background-color:black;
 border-radius:150px;
 }
 .navbar ul{
  margin:10px 10px;
  overflow:auto;
  }
  .navbar li{
  font-size:15px;
  font-weight:bold;
  font-family:verdana;
  margin-left:10px;
  text-align:center;
  width:135px;
   float:left;
   list-style:none;
   margin:20px 0px;
   
   }
   .navbar li a
   {
    padding:3px 3px;
	text-decoration:none;
	color:white;
	}
	.navbar li a:hover
	{
	 color:red;
	 }
	 .search{
	  float:right;
	  color:white;
	  padding:10px 70px;
	  }
	  .navbar input{
	   border:10px solid black;
	   border-radius:14px;
	   padding:0px 1px;
	   width:150px;
	   }
           </style>
</head>
<body>
<nav class="navbar">
<ul>
  <li><a href="homepage.php">HOME</a></li>
  <li><a href="agroinfo.php">AGRO INFO</a></li>
  <li><a href="about_us.php">ABOUT US</a></li>
  <li><a href="contact_us.php">CONTACT</a></li>
  <li><a href="logout.php">LOGOUT</a></li>
  <li><a href="welcome.php">BACK</a></li>
<!---<div class="search">
 <input type="text" name="search" id="search" placeholder="search this website">
 </div>---></ul></nav>
 <div class="table">
</body>
</html>
