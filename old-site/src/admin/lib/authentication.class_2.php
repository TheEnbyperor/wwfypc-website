<?php

/**

 * This class will perform login, logout and password change functionality for register user  

 * @author   mazhar.iqbal@sabritech.com 

 * @since   1.0 

 */

include_once ("lib/connection-manager-mysql.class_2.php");

include_once ("lib/query-builder-mysql.class_2.php");



class Authentication

{

    var $objQryBuilder;

    var $objConMgr;



    function Authentication()

    {

        $this->objQryBuilder = new QueryBuilder();

        $this->objConMgr = new ConnectionMgr();

    }



    //--------------This function is used to perform login for registered user {umair.alvi@sabritech.com 13/03/2007}--

    function DoLoginForRegisterUser($tableName, $whereCondition)

    {

        ################## call query builderfunction to build select query for user login



        $selectQry = $this->objQryBuilder->selectQry("*", $tableName, $whereCondition);



        ################## call connectionManager function to excute DML query for user login

        $selectResult = $this->objConMgr->DML_executeQry($selectQry);

        //die();

        if ($selectResult > 0)

        {

            if (mysql_num_rows($selectResult) == 1)

            {

                $userDetailRS = mysql_fetch_object($selectResult);

                $_SESSION['userId'] = $userDetailRS->userId;

                $_SESSION['department'] = $userDetailRS->department;

                $_SESSION['userType'] = $userDetailRS->userType;

                return 1;

                //echo mysql_num_rows($selectResult);

            } else

                if (mysql_num_rows($selectResult) == 0)

                {

                    return 0;

                }

        } else

        {

            return $selectResult;

        }

    }

    //--------------------------- End of User login function



    //--------------This function is used to perform action for registered user login {umair.alvi@sabritech.com 08/05/2007}--

    function ActionForLogin($userName, $Password)

    {

        ############ Where condition for user login query #####################

        $Password = md5($Password);

        $whereCondition = "(userName = '$userName' AND password = '$Password') AND (status = 'E')";



        $loginResult = $this->DoLoginForRegisterUser("tbl_admin_users", $whereCondition);



        return $loginResult;

    }

    //--------------------------- End of User login function



    //--------------This function is used to chnage  user password {umair.alvi@sabritech.com 09/05/2007}--

    function ActionForChangePassword($tableName, $oldPassword, $newPassword, $userId)

    {



        ############ Where condition for fetching old password#####################

        $actulPassword = $newPassword;

        $oldPassword = md5($oldPassword);

        $newPassword = md5($newPassword);

        $whereCondition = "password = '$oldPassword' AND userId = $userId";



        ################################### First checking is old password exist are not



        $selectQry = $this->objQryBuilder->selectQry("*", $tableName, $whereCondition);



        ################## call connectionManager function to excute DML query for user login

        $selectResult = $this->objConMgr->DML_executeQry($selectQry);

        if (mysql_num_rows($selectResult) > 0)

        {

            $values = "password = '$newPassword'";

            $updateQry = $this->objQryBuilder->updateQry($tableName, $values, $whereCondition);



            $updateResult = $this->objConMgr->DDL_executeQry($updateQry);

            if ($updateResult)

            {

                $errorMessage = 1;

            } else

            {

                $errorMessage = -4;

            }

        } else

        {

            $errorMessage = 0;

        }

        return $errorMessage;

    }

    //--------------------------- End of User login function

}

?>