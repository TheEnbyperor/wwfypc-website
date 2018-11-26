<?php
include ("db_connection.php");

$username=$_POST['username'];
$password=$_POST['password'];

$result = mysql_query ("UPDATE content SET username='$username', password='$password'");
if(!$result)
{
	echo "Could not update the database";
}
else
{
?>
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
<div id="content" style="width:500px;">
    
    <table width="500" border="0">
  <tr>
    <td colspan="2"><h2>Mobile Admin Panel</h2></td>
  </tr>
</table>

     <br />
    	<form id="form" method="post" action="loginquery.php" onSubmit="return validate_form(this)">
        <fieldset>
        	<br />
            <table width="480" border="0">
  <tr >
    <td colspan="2"><strong style="color:#FF0000;">Successfully Updated</strong></td>
    
  </tr>
  <tr bgcolor="#999">
    <td>Username:</td>
    <td> <input type="text" name="username"/> </td>
  </tr>
  <tr bgcolor="#999">
    <td>Password:</td>
    <td><input type="password" name="password" /> </td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" name="submit"  value="Login" style="border:1px solid #CCCCCC; color:#666666;"/></td>
  </tr>
</table>

             
             
        </fieldset>
        
        </form>
    </div>
</body>
</html>

<?php
	
}
?>