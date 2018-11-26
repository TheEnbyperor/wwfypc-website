<?
include_once("../administrator/require/webconfig.inc.php");
include_once("../administrator/lib/query-builder-mysql.class.php");
include_once("../administrator/lib/connection-manager-mysql.class.php");
		$objQryBuilder = & new QueryBuilder();
		$objConMgr = & new ConnectionMgr();	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><title>DJ Robbo Booking Record Detail</title>
<meta name="keywords" content="telecom, telecommunication, mobile, internet, ISP">
<meta name="description" content="Welcome to Etisalat. We help people to reach each other, businesses to find new markets and everyone to fulfil their potential. We provide telephone, TV and Internet across the UAE and beyond. Our customers enjoy the latest services and technologies, as well as a choice of great entertainment.">

<link href="../administrator/css/style.css" rel="stylesheet" type="text/css" />

</head>
<style media="print">
.noprint
{
display: none;
}
</style>
 
 <?

 	$vid=$_GET['id'];
	$where="b_id='".$vid."'";
	$selectQuery= $objQryBuilder->selectQry("*","tbl_booking",$where);
	$sQuery =	$objConMgr->DML_executeQry($selectQuery);
	
	if ($sQuery>0 )					    
		{
		$value = mysql_fetch_object($sQuery);
		
		$cname 		    = $value->cname;
		$pname 		    = $value->pname;
		$caddress       = $value->caddress;
		$zcode 	        = $value->zcode;
		$edate 	        = $value->edate;
		$type_function 	= $value->type_function;
		$vname          = $value->vname;
		$vtype 		    = $value->vtype;
		$vaddress       = $value->vaddress;
		$vtel_no 	    = $value->vtel_no;
		$stime 		    = $value->stime;
		$ftime		    =$value->ftime ;
		$vatime 	    = $value->vatime;
		$nguest 		= $value->nguest;
		$lrequire       = $value->lrequire;
		$s_announcment  = $value->s_announcment;
		$ms_pop	        = $value->ms_pop;
		$ms_dance 	    = $value->ms_dance;
		$ms_rb          = $value->ms_rb;
		$ms_rock		= $value->ms_rock;
		$ms_lsong 		= $value->ms_lsong;
		$ms_christmas   = $value->ms_christmas;
		$ms_50s 	    = $value->ms_50s;
		$ms_60s		    = $value->ms_60s;
		$ms_70s 	    = $value->ms_70s;
		$ms_80s		    = $value->ms_80s;
		$ms_90s 	    = $value->ms_90s;
		$ms_00s		    = $value->ms_00s;
		$ostyle		    = $value->ostyle;
		$elyrics		= $value->elyrics;
		$other_info		= $value->other_info;
		$price_agreed   = $value->price_agreed;
		$p_payment	    = $value->p_payment;
		
		
	    }
	else
		{
		$Msg="Sorry, No record found";
		}



?>
<body>
    
 <table width="780" align="left" border="0" cellspacing="0" cellpadding="2" style="border-width:2px; border-style:solid; border-color:#F7F7F7;">
<tr><td colspan="8">
<table align="right" class="noprint">
<tr >
      <td width="2"><input name="Print" type="button" id="Print" onclick="window.print();" value="Print" style="cursor:pointer"  /></td>
      <td colspan="3">
       
          <input type="reset" name="Reset" id="Reset" value="Cancel" onclick="window.close();" style="cursor:pointer" />
       
      </td>
   </tr>
</table>
</td></tr>
<tr><td>
<table id="tblRecordList" width="780">
   
<tr >
      <td width="30"></td>
      <td colspan="4"></td>
    </tr>    

 <tr>
	  <td height="25" colspan="3" align="Left" class="tblHeading">Detail: </td> 
	  <td width="45" height="25"  align="center" class="tblHeading">&nbsp;</td>
</tr>
    
    <tr>
      <td></td> 
      <td width="350" class="textHeading">NAME:</td>
      <td width="335" class="tbtext"><?= $cname?></td>
      <td width="45">&nbsp;</td>
    </tr>   
            
    <tr  bgcolor="#f0f0f0">
      <td ></td>
      <td class="textHeading">PARTNERS NAME:</td>
      <td class="tbtext"><?= $pname?></td>
      <td >&nbsp;</td>
    </tr>   
  
    <tr>
      <td></td> 
      <td class="textHeading">ADDRESS:</td>
      <td class="tbtext"><?= $caddress ?></td>
      <td >&nbsp;</td>
    </tr>
            
    <tr  bgcolor="#f0f0f0">
      <td width="30" class="">&nbsp;</td> 
      <td width="350" class="textHeading">ZIP CODE:</td>
      <td width="335" class="tbtext"><?= $zcode?></td>
      <td width="45">&nbsp;</td>
    </tr>
    
    <tr >
       <td></td> 
       <td class="textHeading">DATE:</td>
       <td class="tbtext"><?= $edate?></td>
       <td>&nbsp;</td>
    </tr>
    
    <tr  bgcolor="#f0f0f0">
       <td></td> 
        <td class="textHeading">TYPE OF FUNCTION:</td>
        <td class="tbtext"><?= $type_function?></td>
        <td>&nbsp;</td>
  </tr>
             
     <tr >
       <td></td>
       <td class="textHeading">VENUE NAME:</td>
       <td class="tbtext"><?= $vname?></td>
       <td>&nbsp;</td>
     </tr>
            
    <tr  bgcolor="#f0f0f0">
      <td></td>
      <td class="textHeading">TYPE OF VENUE:</td>
      <td class="tbtext"><?= $vtype?></td>
      <td>&nbsp;</td>
    </tr>
    
    <tr class="bodytext">
      <td width="30">&nbsp;</td>
      <td width="350" class="textHeading">VENUE ADDRESS:</td>
      <td width="335" class="tbtext"><?= $vaddress?></td>
      <td width="45">&nbsp;</td>
    </tr>
            
    <tr  bgcolor="#f0f0f0">
      <td  ></td>
      <td class="textHeading">VENUE TEL NUMBER:</td>
      <td class="tbtext"><?= $vtel_no?></td>
      <td>&nbsp;</td>
    </tr>
    
    <tr>
      <td></td>
      <td class="textHeading">START TIME:</td>
      <td class="tbtext"><?= $stime?></td>
      <td>&nbsp;</td>
    </tr>
    
    
    <tr  bgcolor="#f0f0f0">
      <td></td>
      <td class="textHeading">FINISH TIME:</td>
      <td class="tbtext"><?= $ftime?></td>
      <td>&nbsp;</td>
    </tr>
    
    <tr>
      <td></td>
      <td class="textHeading">VENUE ACCESS TIME:</td>
      <td class="tbtext"><?= $vatime?></td>
      <td>&nbsp;</td>
    </tr>
    
    
    <tr  bgcolor="#f0f0f0">
      <td></td>
      <td class="textHeading">GUESTS EXPECTING:</td>
      <td class="tbtext"><?= $nguest?></td>
      <td>&nbsp;</td>
    </tr>

    <tr>
      <td></td>
      <td class="textHeading">LIGHTING REQUIREMENTS:</td>
      <td class="tbtext"><?= $lrequire?></td>
      <td>&nbsp;</td>
    </tr>
    
    
    <tr  bgcolor="#f0f0f0">
      <td></td>
      <td class="textHeading">SPECIAL ANNOUNCEMENTS:</td>
      <td class="tbtext"><?= $s_announcment?></td>
      <td>&nbsp;</td>
    </tr>
    
    <tr>      
      <td  colspan="4">&nbsp;</td>     
    </tr>
    
    <tr bgcolor="#f0f0f0">      
      <td  colspan="4"class="textHeading">MUSIC STYLES TO BE PLAYED:</td>     
    </tr>
    
    
    <tr >
      <td></td>
      <td class="textHeading">POP:</td>
      <td class="tbtext"><?= $ms_pop?></td>
      <td>&nbsp;</td>
    </tr>
    
    <tr bgcolor="#f0f0f0">
      <td></td>
      <td class="textHeading">DANCE:</td>
      <td class="tbtext"><?= $ms_dance?></td>
      <td>&nbsp;</td>
    </tr>
    
    
    <tr >
      <td></td>
      <td class="textHeading"> R&B:</td>
      <td class="tbtext"><?= $ms_rb?></td>
      <td>&nbsp;</td>
    </tr>
    
    <tr bgcolor="#f0f0f0">
      <td></td>
      <td class="textHeading">ROCK:</td>
      <td class="tbtext"><?= $ms_rock?></td>
      <td>&nbsp;</td>
    </tr>
    
    
    <tr>
      <td></td>
      <td class="textHeading">LOVE SONGS:</td>
      <td class="tbtext"><?= $ms_lsong?></td>
      <td>&nbsp;</td>
    </tr>
    
    
    <tr  bgcolor="#f0f0f0">
      <td></td>
      <td class="textHeading"> CHRISTMAS:</td>
      <td class="tbtext"><?= $ms_christmas?></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td></td>
      <td class="textHeading">50s:</td>
      <td class="tbtext"><?= $ms_50s?></td>
      <td>&nbsp;</td>
    </tr>
    
    
    <tr  bgcolor="#f0f0f0">
      <td></td>
      <td class="textHeading"> 60s:</td>
      <td class="tbtext"><?= $ms_60s?></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td></td>
      <td class="textHeading">70s:</td>
      <td class="tbtext"><?= $ms_70s?></td>
      <td>&nbsp;</td>
    </tr>
    
    
    <tr  bgcolor="#f0f0f0">
      <td></td>
      <td class="textHeading"> 80s:</td>
      <td class="tbtext"><?= $ms_80s?></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td></td>
      <td class="textHeading">90s:</td>
      <td class="tbtext"><?= $ms_90s?></td>
      <td>&nbsp;</td>
    </tr>
    
    
    <tr  bgcolor="#f0f0f0">
      <td></td>
      <td class="textHeading"> 00s:</td>
      <td class="tbtext"><?= $ms_00s?></td>
      <td>&nbsp;</td>
    </tr>
    
    <tr>
      <td></td>
      <td class="textHeading">OTHER STYLES OF MUSIC:</td>
      <td class="tbtext"><?= $ostyle?></td>
      <td>&nbsp;</td>
    </tr>
    
    
    <tr  bgcolor="#f0f0f0">
      <td></td>
      <td class="textHeading"> EXPLICIT LYRICS::</td>
      <td class="tbtext"><?= $elyrics?></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td></td>
      <td class="textHeading">ANY OTHER INFORMATION:</td>
      <td class="tbtext"><?= $other_info?></td>
      <td>&nbsp;</td>
    </tr>
    
    
    <tr  bgcolor="#f0f0f0">
      <td></td>
      <td class="textHeading">PRICE AGREED:</td>
      <td class="tbtext"><?= $price_agreed?></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td></td>
      <td class="textHeading">PRE PAYMENT:</td>
      <td class="tbtext"><?= $p_payment?></td>
      <td>&nbsp;</td>
    </tr>
    
    
     <tr>
      <td></td>
      <td></td>
      <td></td>
      <td>&nbsp;</td>
    </tr>
  </table>
  </td></tr>
<tr><td colspan="8">
<table align="right" class="noprint">
<tr >
      <td width="2"><input name="Print" type="button" id="Print" onclick="window.print();" value="Print" style="cursor:pointer" /></td>
      <td colspan="3">
       
          <input type="reset" name="Reset" id="Reset" value="Cancel" onclick="window.close();" style="cursor:pointer" />
       
      </td>
   </tr>
</table>
</td></tr></table>


</body></html>
<?
function prepearString($value){
	$objConMgr  = new ConnectionMgr();
	$value = mysql_real_escape_string(trim($value),$objConMgr->createConnection());
	$value = "'" .$value. "'";
	return $value;
}

?>