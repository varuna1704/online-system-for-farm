<?php
include __DIR__ . '/../includes/header_fert.php';
?>
<!DOCTYPE html>

<html>
<head>
<meta charset="utf-8">

<title>index</title>
<style>
    input[type="submit"]
    {
        padding:10px 200px;
        font-size:20px;
        
         width:6em;
        height:4em;
    }
    
    td{
        padding:0px 80px;
        
    }
    td h4{
        color:black;
    }
</style>
</head>
<body>
    <?php
include __DIR__ . '/../includes/con_pg.php';
 $query="SELECT * FROM cvfimg1";
$res=pg_query($con, $query) or die (pg_last_error($con)); 
echo "<table cellspacing=2>";
//echo "<tr><td>pno</td><td>pname</td><td></td></tr>";

echo"<tr><td>";
while($row=pg_fetch_array($res))
{

//echo "<td>".$row[0]."</td>";
//echo "<td>".$row[1]."</td>";
$row[1]= pg_fetch_result ($res, 'photo');
$unes_image=pg_unescape_bytea ($row[1]);
     
echo"<img src=$unes_image width=390 height=300/>";
 
    $row[3]= pg_fetch_result($res,'photo');
    $unes_image= pg_unescape_bytea($row[3]);
   
    echo "<td><center><h1>".$row[1]."</h1><br><h3>".$row[3]."</h3><br><h4>".$row[3]."</center></td>";
    echo "<td><input type='submit' name='book' value='BOOK TICKET'/></td></tr>";  

 echo "<td><input type='submit' name='book' value='BOOK TICKET'/></td></tr>";
} 
echo"</td></tr>";
echo "</table>";
pg_close($con);
?>
    <?php
   include __DIR__ . '/../includes/footer.php';
    ?>
</body>
</html>


