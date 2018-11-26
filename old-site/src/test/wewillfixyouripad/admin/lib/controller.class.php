<?php
/**
 * User will communicate with database,security checks through Controller class that will inlcude other classes to perform requide 
 * functionality and control the flow of an application
 * @author  
 * @package CMSD
 * @since   1.0 
 */

//include("connection-manager-mysql.class.php");
//include("query-builder-mysql.class.php");
class Controller
{
    var $objQryBuilder;
    var $objConMgr;

    function Controller()
    {
        //$this->objQryBuilder = new QueryBuilder();
        //$this->objConMgr = new ConnectionMgr();
    }

    //--------This will check whether a variable exist and initialize with some value {umair.alvi@sabritech.com 08/05/2007}--
    function CheckIsSet($fieldName)
    {
        if (isset($fieldName) && $fieldName != "")
        {
            return 1;
        }
        if (!isset($fieldName) || $fieldName == "")
        {
            return 0;
        }
    }

    //---------End Of this function -----------------------

    //---------------------This function can be used to redirect to another page {umair.alvi@sabritech.com 13/03/2007}--------
    function Redirect($url)
    {
        header("Location:" . $url);
    }
    //-----------End of this function ----------------------
    //---------------------------------function to parse date according to date format in mysql db{umair.alvi@sabritech.com}
    function SetDateFormat($fieldValue)
    {
        $dateVal = explode("/", $fieldValue);
        $day = $dateVal[0];
        $month = $dateVal[1];
        $year = $dateVal[2];
        $dateVal = $year . "-" . $month . "-" . $day;
        return $dateVal;
    }
    //---------------------------------End of Function-----------------------------------------

    //----------------------------function to parse date format to dd/mm/yyyy after getting from db{umair.alvi@sabritech.com}
    function DisplayDateFormat($fieldValue)
    {
        $dateVal = explode("-", $fieldValue);
        $year = $dateVal[0];
        $month = $dateVal[1];
        $day = $dateVal[2];
        $dateVal = $day . "/" . $month . "/" . $year;
        return $dateVal;
    }
    //---------------------------------End of Function---------------------------------------------------------
    //---------------Ending session on logout  {umair.alvi@sabritech.com 13/03/2007}------------------------------------------------
    function UnregisterSession($sessionValue)
    {
        if ($this->CheckIsSet($_SESSION["$sessionValue"]))
        {
            $_SESSION["$sessionValue"] = "";
            unset($_SESSION["$sessionValue"]);

        }

    }
    //------------------------------------------------------------------------------------------------------

}
?>
