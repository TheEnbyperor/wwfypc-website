<?php
$sqlMetaInfo = "SELECT * FROM tbl_meta_info WHERE mtp_id =" . $mtp_id;
$resMetaInfo = $objConMgr->DML_executeQry($sqlMetaInfo);
$meta_DESCRIPTION = "";
$meta_KEYWORDS = "";

if (@mysql_num_rows($resMetaInfo) > 0) {
    $rsMetaInfo = mysql_fetch_object($resMetaInfo);
    $meta_DESCRIPTION = $rsMetaInfo->mti_description;
    $meta_KEYWORDS = $rsMetaInfo->mti_keywords;
    $meta_Others = stripslashes($rsMetaInfo->mti_others);
    $page_Title = $rsMetaInfo->mti_title;
    $google_analytics = $rsMetaInfo->mti_google;
}

$userDetailSelectSql = $objQryBuilder->selectQry('*', 'tbl_emailpref', 'emailid=1');
$userDetailSelectResult = $objConMgr->DML_executeQry($userDetailSelectSql);
$phon = "";
$contactus = "";

if (mysql_num_rows($userDetailSelectResult) > 0) {
    while ($userDetailRS = mysql_fetch_object($userDetailSelectResult)) {
        $contactEmail = $userDetailRS->email;
        $phon = $userDetailRS->phoneno;
    }
}
function GetContactusEmailInfo()
{
    $objQryBuilder = &new QueryBuilder();
    $objConMgr = &new ConnectionMgr();

    $sqlContactusEmail = $objQryBuilder->selectQry("*", "tbl_emailpref", " emailid = 1");
    $CUEResult = $objConMgr->DML_executeQry($sqlContactusEmail);
    return mysql_fetch_object($CUEResult);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?= $meta_Others ?>
<meta name="description" content="<?= $meta_DESCRIPTION ?>" />
<meta name="keywords" content="<?= $meta_KEYWORDS ?>" />
<title>We Will Fix Your PC - <?= $page_Title ?></title>
<link href="css/style_wap.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="container">
<div class="header"> <a href="index_wap.php"><img src="images_wap/logo.jpg" alt="" class="logo"/></a> </div>
<div class="no"> <a href="#"><?=$phon[0].$phon[1].$phon[2].$phon[3].$phon[4]." ".$phon[5].$phon[6].$phon[7].$phon[8].$phon[9].$phon[10]?></a> </div>
<div class="no" style="margin-top:20px;"> <a href="#">07999 056096</a> </div>