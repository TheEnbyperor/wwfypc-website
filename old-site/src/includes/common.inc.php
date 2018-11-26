<?php

function LoadMetaPages($mpgId)
{
		$objQryBuilder 	= new QueryBuilder();
		$objConMgr 		= new ConnectionMgr();
		$mpgSql = $objQryBuilder->selectQry("*","tbl_meta_pages"," 	mtp_status = 1", " mtp_page");
		$mpgResult = $objConMgr->DML_executeQry($mpgSql);
		$html = "";
		while($row = mysql_fetch_object($mpgResult))
		{
			if ($row->mtp_id == $mpgId)
				$html .= "<option value='$row->mtp_id' selected>$row->mtp_page</option>";
			else
				$html .= "<option value='$row->mtp_id'>$row->mtp_page</option>";
			
		}
		
		return $html;
}
function removeQuotes($strToChange)
{
	$strToChange=str_replace("'","&#39;",$strToChange);
	$strToChange=str_replace("","&pound;",$strToChange);
	return $strToChange;
}
function prepearString($value)
{
	//$link = mysql_connect('localhost', 'paws_user', 'paws_pass') or  die(mysql_error());
	$objConMgr  = new ConnectionMgr();
	$value = mysql_real_escape_string(trim($value),$objConMgr->createConnection());
	// Quote if not integer
	$value = "'" .$value. "'";
	return $value;
}
function sendMail($fromname, $from, $to, $subject, $body)
{
    global $config;       
    $mail = new PHPMailer();
    $mail->From = $from;
    $mail->FromName = $fromname;
    $mail->Host = $config['smtpserver'];
    $mail->Subject = $subject;

    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
    $mail->IsSMTP();
    $mail->MsgHTML($body);

    $mail->AddAddress("$to", "$to");

    if (!$mail->Send())
    {
        return false;
    } else
    {
        return true;
    }

}

function IsUniqueExcludingMe($str, $fld, $id)
{
    global $glob, $db, $tbls;

    $query = "SELECT " . $fld . " FROM " . $tbls['users'] . " WHERE  userid <> " . $id . " and   " . $fld . "=" . $db->mySQLSafe($str);
    $rsChk = $db->select($query);
    if ($rsChk == true)
    {
        return false;
    } else
    {
        return true;
    }
}

function IsUserExist($username)
{
    global $glob, $db, $tbls;

    $query = "SELECT userid FROM users WHERE username=" . $db->mySQLSafe($username);
    $rsChk = $db->select($query);
    if ($rsChk == true)
    {
        return true;
    } else
    {
        return false;
    }
}

function treatGet($text)
{
   // $text = str_replace(array('&', '"', '<', '>'), array('&amp;', '&quot;', '&lt;', '&gt;'), $text);
    $text = str_replace(array('A', 'a', 'B', 'b','C', 'c', 'D', 'd','E', 'e', 'F', 'f','G', 'g', 'H', 'h','I', 'i', 'J', 'j','K', 'k', 'L', 'l','M', 'm', 'N', 'n','O', 'o', 'P', 'p','Q', 'q', 'R', 'r','S', 's', 'T', 't','U', 'u', 'V', 'v','W', 'w', 'X', 'x','Y', 'y', 'Z', 'z','"', '&', '~', '!','@', '#', '$', '%','^', '(', ')', '_','-','+','=','|','','/'), array('&amp;', '&quot;', '&lt;', '&gt;'), $text);
    return $text;
}
function encodeJson($str)
{
    if (get_magic_quotes_gpc())
    {
        return stripslashes($str);
    } else
    {
        return $str;
    }
}

function readF($myFile)
{
    $fh = fopen($myFile, 'r');
    $theData = fread($fh, filesize($myFile));
    fclose($fh);
    return $theData;
}

function writeF($myFile, $stringData)
{
    $fh = fopen($myFile, 'w') or false;
    if ($fh != false)
    {
        fwrite($fh, $stringData);
        fclose($fh);
        return true;
    } else
    {
        return false;
    }
}

//========== Apply magic qoutes injection prevention - added by Mazhar Iqbal==========
function mySQLSafe($value, $quote = "'", $endquote = "'")
{
    // strip quotes if already in
    $value = str_replace(array("\'", "'"), "&#39;", $value);

    // Stripslashes
    if (get_magic_quotes_gpc())
    {
        $value = stripslashes($value);
    }
    // Quote value
    if (version_compare(phpversion(), "4.3.0") == "-1")
    {
        $value = mysql_escape_string($value);
    } else
    {
        $value = mysql_real_escape_string($value);
    }

    $value = $quote . $value . $endquote;

    return $value;
}

function print_arr($arr)
{
    print_r("<pre>");
    print_r($arr);
    print_r("</pre>");
}

function seoFriendly($str)
{
    $str = htmlentities($str, ENT_QUOTES);
    $str = strtolower($str);
    $str = str_replace("#39;", "", $str);
    $str = str_replace("?", "", $str);
    $str = str_replace("&amp;", "", $str);
    $str = str_replace("&", "", $str);
    $str = str_replace("'", " ", $str);
    $str = str_replace(":", "", $str);
    $str = str_replace(" ", "-", $str);
    $str = str_replace("--", "-", $str);
    return $str;
}

function redirect($url)
{
    $r = ROOTPATH . "$url";
    @header("Location: $r");
    exit;
}

function is_odd($num)
{
    if ($num % 2 == 0)
    {
        return false;
    } else
    {
        return 1;
    }
}

function IsImageExist($imageFile, $filePath = "upload/news/")
{
    $defaultImage = "default.gif";

    if ($imageFile)
        if (file_exists($filePath . $imageFile))
            return $filePath . $imageFile;

    return $filePath . $defaultImage;
}

function GetPDFFiles($pageId) {
	$db = @new db();
	$rsPDFFiles = $db->select("SELECT * FROM tbl_pdf_gallery WHERE glr_page_id=".$pageId." AND glr_status=1 LIMIT 0,10");
	if(!empty($rsPDFFiles))
		return $rsPDFFiles;
	else
		return false;
}

?>