<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mobile Admin Panel</title>
<style type="text/css">body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #000000;
}
body {
	background-color: #f4f4f4;
	}
a:link {
	color: #0000FF;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #0000FF;
}
a:hover {
	text-decoration: none;
	color: #000000;
}
a:active {
	text-decoration: none;
	color: #0000FF;
}
table {
	
}
td {
	padding: 5px;
	border: 1px solid #000000;
}
#content{
	width:900px;
	margin-left:auto;
	margin-right:auto;
	margin-top:10px;
	padding:10px;
	border:1px solid #0000CC;
}
</style>

</head>

<body>
<div id="mainWrapper">
	<div id="content">
<?php
$id = $_POST['id'];

include ("db_connection.php");

$result = mysql_query ("SELECT * FROM content where id ='$id'");
					
$existCount = mysql_num_rows($result); // count the row nums
if ($existCount == 0) { // evaluate the count
	 echo 'That information is incorrect, try again <a href="index.php">Click Here</a>';
	 exit();
} else
{
echo "You are logged in";
}

while ($row = mysql_fetch_array ($result)){

	$id = $row ['id'];
	$text = $row ['text'];

}




?>

<table width="100%">
 <tr>
 	<td><form action="edit_page.php" method="post">
            <input type="submit" value="Service" style="width:190px; border:1px solid #CCCCCC; color:#666666;"/>
            <input type="hidden" name="id" value="1" />
            </form></td>
    <td><form action="edit_page.php" method="post">
            <input type="submit" value="Why Choose Us" style="width:190px; border:1px solid #CCCCCC; color:#666666;"/>
            <input type="hidden" name="id" value="2" />
            </form></td>
    <td><form action="edit_page.php" method="post">
            <input type="submit" value="Price Guide" style="width:190px;border:1px solid #CCCCCC; color:#666666;"/>
            <input type="hidden" name="id" value="3" />
            </form></td>
    <td> <form action="edit_page.php" method="post">
            <input type="submit" value="Contact Us" style="width:190px; border:1px solid #CCCCCC; color:#666666;"/>
            <input type="hidden" name="id" value="4" />
            </form></td>
    <td align="right"> 
    
            
            
           
    <a href="index.php"> Log Out </a></td>
 </tr>
 </table>

 <form action="update.php" method="post">
  
    <table width="100%">
    <tr>
        	
            <td width="20%">
            
           <textarea name="text" cols="100%" rows="25"><?php echo $text;?></textarea>
                    
            </td>
           
        </tr>
    	<tr>
        	
            <td width="20%">
            
            <input type="submit" value="Update" style="width:150px;"/>
            <input type="hidden" name="id" value="<?php echo $id;?>" />
           
            </td>
           
        </tr>
       
      </table>
      </form>
    <div id="unkown">
    
        
        
     
    </div>
    </div>


</div>
</body>
</html>
