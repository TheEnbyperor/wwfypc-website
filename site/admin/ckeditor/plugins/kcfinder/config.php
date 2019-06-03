<?php
$_CONFIG = array(
	'disabled' => false,
	'theme' 	=> "oxygen",
    'uploadURL' => "images",
    'uploadDir' => "../../../../../files/dynamic_uploads",
    'types' => array(
        'files'   =>  "",
        'flash'   =>  "swf",
        'images'  =>  "*img",
        'file'    =>  "",
        'media'   =>  "swf flv avi mpg mpeg qt mov wmv asf rm",
        'image'   =>  "*img",
    ),
    'imageDriversPriority' => "imagick gmagick gd",
    'jpegQuality' => 100,
    'thumbsDir' => ".thumbs",
    'maxImageWidth' => 0,
    'maxImageHeight' => 0,
    'thumbWidth' => 200,
    'thumbHeight' => 200,
    'watermark' => "Esol",
    'denyZipDownload' => false,
    'denyUpdateCheck' => false,
    'denyExtensionRename' => false,
    'dirPerms' => 0755,
    'filePerms' => 0644,
    'access' => array(
        'files' => array(
            'upload' => true,
            'delete' => true,
            'copy'   => true,
            'move'   => true,
            'rename' => true
        ),
        'dirs' => array(
            'create' => true,
            'delete' => true,
            'rename' => true
        )
    ),
    'deniedExts' => "exe com msi bat php phps phtml php3 php4 cgi pl",
    'filenameChangeChars' => array(/*
        ' ' => "_",
        ':' => "."
    */),
    'dirnameChangeChars' => array(/*
        ' ' => "_",
        ':' => "."
    */),

    'mime_magic' => "",
    'cookieDomain' => "",
    'cookiePath' => "",
    'cookiePrefix' => 'KCFINDER_',
    '_check4htaccess' => false,
    //'_tinyMCEPath' => "/tiny_mce",

    '_sessionVar' => &$_SESSION['KCFINDER'],
    //'_sessionLifetime' => 30,
    //'_sessionDir' => "/full/directory/path",

    //'_sessionDomain' => ".mysite.com",
    //'_sessionPath' => "/my/path",
);
?>