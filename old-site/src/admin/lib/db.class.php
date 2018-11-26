<?php
/*
+--------------------------------------------------------------------------
|   by Mazhar Iqbal
+--------------------------------------------------------------------------
|	class.db.php
|   ========================================
|	Database Class	
+--------------------------------------------------------------------------
*/
class db
{
    var $query = "";
    var $db = "";

    function db()
    {
        global $glob;

        $this->db = mysql_connect(SERVER_ADDRESS, USERNAME, PASSWORD);
        if (!$this->db)
            die($this->debug(true));

        $selectdb = @mysql_select_db(DATABASE);
        if (!$selectdb)
            die($this->debug());

    } // end constructor

    function select($query, $maxRows = 0, $pageNum = 0)
    {
        $this->query = $query;

        // start limit if $maxRows is greater than 0
        if ($maxRows > 0)
        {
            $startRow = $pageNum * $maxRows;
            $query = sprintf("%s LIMIT %d, %d", $query, $startRow, $maxRows);
        }

        $result = mysql_query($query, $this->db);

        if ($this->error())
            die($this->debug());

        $output = false;

        for ($n = 0; $n < mysql_num_rows($result); $n++)
        {
            $row = mysql_fetch_assoc($result);
            $output[$n] = $row;
        }

        return $output;

    } // end select

    function misc($query)
    {
        $this->query = $query;
        $result = mysql_query($query, $this->db);

        if ($this->error())
            die($this->debug());

        if ($result == true)
        {
            return true;
        } else
        {
            return false;
        }
    }

    function numrows($query)
    {
        $this->query = $query;
        $result = mysql_query($query, $this->db);
        return mysql_num_rows($result);
    }

    function paginate($numRows, $maxRows, $pageNum = 0, $pageVar = "page", $class = "txtLink")
    {
        global $lang;
        $navigation = "";

        // get total pages
        $totalPages = ceil($numRows / $maxRows);

        // develop query string minus page vars
        $queryString = "";
        if (!empty($_SERVER['QUERY_STRING']))
        {
            $params = explode("&", $_SERVER['QUERY_STRING']);
            $newParams = array();
            foreach ($params as $param)
            {
                if (stristr($param, $pageVar) == false)
                {
                    array_push($newParams, $param);
                }
            }
            if (count($newParams) != 0)
            {
                $queryString = "&" . htmlentities(implode("&", $newParams));
            }
        }

        // get current page
        $currentPage = $_SERVER['PHP_SELF'];


        // build page navigation
        if ($totalPages > 1)
        {
            $navigation = $totalPages . $lang['misc']['pages'];

            $upper_limit = $pageNum + 3;
            $lower_limit = $pageNum - 3;

            if ($pageNum > 0)
            { // Show if not first page

                if (($pageNum - 2) > 0)
                {
                    $first = sprintf("%s?" . $pageVar . "=%d%s", $currentPage, 0, $queryString);
                    $navigation .= "<a href='" . $first . "' class='" . $class . "'>&laquo;</a> ";
                }

                $prev = sprintf("%s?" . $pageVar . "=%d%s", $currentPage, max(0, $pageNum - 1), $queryString);
                $navigation .= "<a href='" . $prev . "' class='" . $class . "'>&lt;</a> ";
            } // Show if not first page

            // get in between pages
            for ($i = 0; $i < $totalPages; $i++)
            {

                $pageNo = $i + 1;

                if ($i == $pageNum)
                {
                    $navigation .= "&nbsp;<strong>[" . $pageNo . "]</strong>&nbsp;";
                } elseif ($i !== $pageNum && $i < $upper_limit && $i > $lower_limit)
                {
                    $noLink = sprintf("%s?" . $pageVar . "=%d%s", $currentPage, $i, $queryString);
                    $navigation .= "&nbsp;<a href='" . $noLink . "' class='" . $class . "'>" . $pageNo . "</a>&nbsp;";
                } elseif (($i - $lower_limit) == 0)
                {
                    $navigation .= "&hellip;";
                }
            }

            if (($pageNum + 1) < $totalPages)
            { // Show if not last page
                $next = sprintf("%s?" . $pageVar . "=%d%s", $currentPage, min($totalPages, $pageNum + 1), $queryString);
                $navigation .= "<a href='" . $next . "' class='" . $class . "'>&gt;</a> ";
                if (($pageNum + 3) < $totalPages)
                {
                    $last = sprintf("%s?" . $pageVar . "=%d%s", $currentPage, $totalPages - 1, $queryString);
                    $navigation .= "<a href='" . $last . "' class='" . $class . "'>&raquo;</a>";
                }
            } // Show if not last page

        } // end if total pages is greater than one

        return $navigation;

    }

    function paginateExModified($numRows, $maxRows, $pageNum = 0, $url, $pageVar = "page", $class = "txtLink")
    {
        global $lang;
        $navigation = "";

        // get total pages
        $totalPages = ceil($numRows / $maxRows);

        // develop query string minus page vars

        // build page navigation
        if ($totalPages > 1)
        {
            $navigation = $totalPages . $lang['misc']['pages'];

            $upper_limit = $pageNum + 3;
            $lower_limit = $pageNum - 3;
            /*
            if ($pageNum > 0) { // Show if not first page
            
            if(($pageNum - 2)>0){
            $first = sprintf("%s?".$pageVar."=%d%s", $currentPage, 0, $queryString);
            $navigation .= "<a href='".$first."' class='".$class."'>&laquo;</a> ";}
            
            $prev = sprintf("%s?".$pageVar."=%d%s", $currentPage, max(0, $pageNum - 1), $queryString);
            $navigation .= "<a href='".$prev."' class='".$class."'>&lt;</a> ";
            } // Show if not first page
            */
            // get in between pages
            for ($i = 0; $i < $totalPages; $i++)
            {

                $pageNo = $i + 1;
                $urlC = str_replace('$$PageNumber$$', $pageNo - 1, $url);
                if ($i == $pageNum)
                {
                    $navigation .= "&nbsp;<strong>[" . $pageNo . "]</strong>&nbsp;";
                } elseif ($i !== $pageNum && $i < $upper_limit && $i > $lower_limit)
                {
                    $noLink = sprintf("%s?" . $pageVar . "=%d%s", $currentPage, $i, $queryString);
                    $navigation .= "&nbsp;<a href='" . $urlC . "' class='" . $class . "'>" . $pageNo . "</a>&nbsp;";
                } elseif (($i - $lower_limit) == 0)
                {
                    $navigation .= "&hellip;";
                }
            }
            /*
            
            if (($pageNum+1) < $totalPages) { // Show if not last page
            $next = sprintf("%s?".$pageVar."=%d%s", $currentPage, min($totalPages, $pageNum + 1), $queryString);
            $navigation .= "<a href='".$next."' class='".$class."'>&gt;</a> ";
            if(($pageNum + 3)<$totalPages){
            $last = sprintf("%s?".$pageVar."=%d%s", $currentPage, $totalPages-1, $queryString);
            $navigation .= "<a href='".$last."' class='".$class."'>&raquo;</a>";}
            } // Show if not last page 
            */
        } // end if total pages is greater than one

        return $navigation;
    }

    function paginateEx($numRows, $maxRows, $pageNum = 0, $pageVar = "page", $class = "txtLink")
    {
        global $lang;
        $navigation = "";

        // get total pages
        $totalPages = ceil($numRows / $maxRows);

        // develop query string minus page vars
        $queryString = "";
        if (!empty($_SERVER['QUERY_STRING']))
        {
            $params = explode("&", $_SERVER['QUERY_STRING']);
            $newParams = array();
            foreach ($params as $param)
            {

                if (stristr($param, $pageVar) == false)
                {
                    array_push($newParams, $param);
                }
            }
            if (count($newParams) != 0)
            {
                $queryString = "&" . htmlentities(implode("&", $newParams));
            }
        }
        $queryString = "";
        // get current page
        $currentPage = $_SERVER['HTTP_X_REWRITE_URL'];

        // build page navigation
        if ($totalPages > 1)
        {
            $navigation = '<ul class="Pager">';

            $upper_limit = $pageNum + 3;
            $lower_limit = $pageNum - 3;

            if ($pageNum > 0)
            { // Show if not first page
                $prev = sprintf("%s?" . $pageVar . "=%d", $currentPage, $pageNum - 1);
                $navigation .= '<li class="Previous"><a href="' . $prev . '"><img border="0" src="images/pager_previous.JPG" alt="Previous" /> </a> </li> ';
            } // Show if not first page
            else
            {
                $navigation .= '<li class="Previous"><img border="0" src="images/pager_previous.JPG" alt="Previous" /> </li> ';
            }
            // get in between pages
            for ($i = 0; $i < $totalPages; $i++)
            {

                $pageNo = $i + 1;

                if ($i == $pageNum)
                {
                    $navigation .= '<li class="Selected" >' . $pageNo . '</li>';
                } elseif ($i !== $pageNum && $i < $upper_limit && $i > $lower_limit)
                {
                    $noLink = sprintf("%s?" . $pageVar . "=%d", $currentPage, $i);
                    $navigation .= "<li><a href='" . $noLink . "' class='" . $class . "'>" . $pageNo . "</a></li>";
                } elseif (($i - $lower_limit) == 0)
                {
                    $navigation .= "&hellip;";
                }
            }

            if (($pageNum + 1) < $totalPages)
            { // Show if not last page
                $next = sprintf("%s?" . $pageVar . "=%d", $currentPage, min($totalPages, $pageNum + 1));

                $navigation .= '<li class="Previous"><a href="' . $next . '" ><img border="0" src="images/pager_next.JPG" alt="Previous" /></a> </li> ';

            } // Show if not last page
            else
            {
                $navigation .= '<li class="Previous"><img border="0" src="images/pager_next.JPG" alt="Previous" /> </li> ';

            }


        } // end if total pages is greater than one
        $navigation .= '</ul>';
        return $navigation;

    }
    function insert($tablename, $record)
    {
        if (!is_array($record))
            die($this->debug("array", "Insert", $tablename));

        $count = 0;
        foreach ($record as $key => $val)
        {
            if ($count == 0)
            {
                $fields = "`" . $key . "`";
                $values = $val;
            } else
            {
                $fields .= ", " . "`" . $key . "`";
                $values .= ", " . $val;
            }
            $count++;
        }

        $query = "INSERT INTO " . $tablename . " (" . $fields . ") VALUES (" . $values . ")";
        $this->query = $query;
        mysql_query($query, $this->db);

        if ($this->error())
            die($this->debug());

        if ($this->affected() > 0)
            return true;
        else
            return false;

    } // end insert


    function update($tablename, $record, $where)
    {
        if (!is_array($record))
            die($this->debug("array", "Update", $tablename));

        $count = 0;

        foreach ($record as $key => $val)
        {
            if ($count == 0)
                $set = "`" . $key . "`" . "=" . $val;
            else
                $set .= ", " . "`" . $key . "`" . "= " . $val;
            $count++;
        }

        $query = "UPDATE " . $tablename . " SET " . $set . " WHERE " . $where;

        $this->query = $query;
        mysql_query($query, $this->db) or die();
        //echo $query ."---------".mysql_error();

        if ($this->error())
            die($this->debug());
        return true;
        //if ($this->affected() > 0) return true; else return false;

    } // end update

    function delete($tablename, $where, $limit = "")
    {
        $query = "DELETE from " . $tablename . " WHERE " . $where;
        if ($limit != "")
            $query .= " LIMIT " . $limit;
        $this->query = $query;
        mysql_query($query, $this->db);

        if ($this->error())
            die($this->debug());

        if ($this->affected() > 0)
        {
            return true;
        } else
        {
            return false;
        }

    } // end delete

    //////////////////////////////////
    // Clean SQL Variables (Security Function)
    ////////
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


    function debug($type = "", $action = "", $tablename = "")
    {

        switch ($type)
        {
            case "connect":
                $message = "MySQL Error Occured";
                $result = mysql_errno() . ": " . mysql_error();
                $query = "";
                $output = "Could not connect to the database. Be sure to check that your database connection settings are correct and that the MySQL server in running.";
                break;


            case "array":
                $message = $action . " Error Occured";
                $result = "Could not update " . $tablename . " as variable supplied must be an array.";
                $query = "";
                $output = "Sorry an error has occured accessing the database. Be sure to check that your database connection settings are correct and that the MySQL server in running.";

                break;


            default:
                if (mysql_errno($this->db))
                {
                    $message = "MySQL Error Occured";
                    $result = mysql_errno($this->db) . ": " . mysql_error($this->db);
                    $output = "Sorry an error has occured accessing the database. Be sure to check that your database connection settings are correct and that the MySQL server in running.";
                } else
                {
                    $message = "MySQL Query Executed Succesfully.";
                    $result = mysql_affected_rows($this->db) . " Rows Affected";
                    $output = "view logs for details";
                }

                $linebreaks = array("\n", "\r");
                if ($this->query != "")
                    $query = "QUERY = " . str_replace($linebreaks, " ", $this->query);
                else
                    $query = "";
                break;
        }

        $output = "<b style='font-family: Arial, Helvetica, sans-serif; color: #0B70CE;'>" . $message . "</b><br />\n<span style='font-family: Arial, Helvetica, sans-serif; color: #000000;'>" . $result . "</span><br />\n<p style='Courier New, Courier, mono; border: 1px dashed #666666; padding: 10px; color: #000000;'>" .
            $query . "</p>\n";

        return $output;
    }


    function error()
    {
        if (mysql_errno($this->db))
            return true;
        else
            return false;
    }


    function insertid()
    {
        return mysql_insert_id($this->db);
    }

    function affected()
    {
        return mysql_affected_rows($this->db);
    }

    function close() // close conection

    {
        mysql_close($this->db);
    }


    function paginateDigg($numRows, $maxRows, $pageNum = 0, $url, $sp = false)
    {
        global $lang;
        $queryString = "";
        $currentPage = "";
        $navigation = "";
        $pageVar = "";
        $temp = "";
        $count = 0;
        // get total pages
        $totalPages = ceil($numRows / $maxRows);
        if ($totalPages > 1)
        {
            // develop query string minus page vars
            $currpageNum = $pageNum;
            $pageNum = $pageNum + 1;
            $pageNum = $pageNum - 1;
            $navigation = '<div id="pagingBg"><div class="pagingImgs"><div class="paging-Links">';
            $lower_limit = $pageNum;
            $upper_limit = $lower_limit + 3;
            $urlC = str_replace('$$PageNumber$$', $pageNum - 1, $url);

            if ($pageNum > 0)
            { // Show if not first page
                $prev = sprintf("%s?" . $pageVar . "=%d%s", $currentPage, $pageNum - 1, $queryString);
                $thistd = $pageNum;
                $navigation .= '<div><a href="#" onclick="submitPagingPost(' . $thistd . ');return false;">Previous</a></div> ';
            } // Show if not first page
            else
            {
                $navigation .= '<div>Previous</div>';
            }
            if ($upper_limit > $totalPages)
                $upper_limit = $totalPages;
            if ($totalPages > 4)
            {
                if ($lower_limit != 0)
                {
                    $urlC = str_replace('$$PageNumber$$', $pageNum - 1, $url);
                    $lowertd = $pageNum - 1;
                    $navigation .= "<div><a href='#' onclick='submitPagingPost($pageNum);return false;'>$pageNum</a></div>";
                } else
                {
                    $upper_limit = $upper_limit + 1;
                }
                if ($pageNum + ($upper_limit - $lower_limit) >= $totalPages)
                {
                    $lower_limit = $totalPages - 3;
                }
            } else
            {
                $lower_limit = 0;
                $upper_limit = $totalPages;
            }

            for ($i = $lower_limit; $i < $upper_limit; $i++, $count++)
            {
                $pageNo = $i + 1;

                $urlC = str_replace('$$PageNumber$$', $pageNo - 1, $url);

                if ($i == $pageNum)
                {

                    $navigation .= " <div $temp>" . $pageNo . "</div>";
                } else
                {

                    $navigation .= " <div $temp ><a href='#'  onclick='submitPagingPost($pageNo);return false;' >" . $pageNo . "</a></div>";
                }
            }
            if ($i < $totalPages)
            {

                $urlC = str_replace('$$PageNumber$$', $pageNum + 1, $url);
                $lastpagetd = $pageNo + 1;
                $navigation .= " <div class='next'   onclick='submitPagingPost($lastpagetd);return false;' ><a href='#'>" . $lastpagetd . "</a></div>";
            }
            if (($pageNum + 1) < $totalPages)
            { // Show if not last page
                $next = sprintf("%s?" . $pageVar . "=%d%s", $currentPage, min($totalPages, $pageNum + 1), $queryString);
                $urlC = str_replace('$$PageNumber$$', $pageNum + 1, $url);
                $thistd = $pageNum + 2;
                $navigation .= '<div class="Next"><a  href="#" onclick="submitPagingPost(' . $thistd . ');return false;">Next</a></div>';

            } // Show if not last page
            else
            {
                $navigation .= '<div class="Next">Next</div> ';
            }
            $navigation .= "</div>
          </div>
        </div>";
        }
        return $navigation;
    }


    function paginateCategory($numRows, $maxRows, $pageNum = 0, $url, $sp = false)
    {
        global $lang;
        $navigation = "";
        $count = 0;
        $queryString = "";
        $pageVar = "";
        $currentPage = "";
        // get total pages
        $totalPages = ceil($numRows / $maxRows);
        if ($totalPages > 1)
        {
            // develop query string minus page vars
            $currpageNum = $pageNum;
            $pageNum = $pageNum + 1;
            $pageNum = $pageNum - 1;
            $navigation = '<div id="pagingBg"><div class="pagingImgs"><div class="paging-Links">';
            $lower_limit = $pageNum;
            $upper_limit = $lower_limit + 3;
            $urlC = str_replace('$$PageNumber$$', $pageNum - 1, $url);

            if ($pageNum > 0)
            { // Show if not first page
                $prev = sprintf("%s?" . $pageVar . "=%d%s", $currentPage, $pageNum - 1, $queryString);
                $thistd = $pageNum;
                $navigation .= '<div><a href="' . $urlC . '"  >Previous</a></div> ';
            } // Show if not first page
            else
            {
                $navigation .= '<div>Previous</div>';
            }
            if ($upper_limit > $totalPages)
                $upper_limit = $totalPages;
            if ($totalPages > 4)
            {
                if ($lower_limit != 0)
                {
                    $urlC = str_replace('$$PageNumber$$', $pageNum - 1, $url);
                    $lowertd = $pageNum - 1;
                    $navigation .= "<div><a href='$urlC' >$pageNum</a></div>";
                } else
                {
                    $upper_limit = $upper_limit + 1;
                }
                if ($pageNum + ($upper_limit - $lower_limit) >= $totalPages)
                {
                    $lower_limit = $totalPages - 3;
                }
            } else
            {
                $lower_limit = 0;
                $upper_limit = $totalPages;
            }

            for ($i = $lower_limit; $i < $upper_limit; $i++, $count++)
            {
                $pageNo = $i + 1;

                $urlC = str_replace('$$PageNumber$$', $pageNo - 1, $url);

                if ($i == $pageNum)
                {

                    $navigation .= " <div >" . $pageNo . "</div>";
                } else
                {

                    $navigation .= " <div ><a href='$urlC'  >" . $pageNo . "</a></div>";
                }
            }
            if ($i < $totalPages)
            {

                $urlC = str_replace('$$PageNumber$$', $pageNum + 1, $url);
                $lastpagetd = $pageNo + 1;
                $navigation .= " <div class='next'    ><a href='$urlC'>" . $lastpagetd . "</a></div>";
            }
            if (($pageNum + 1) < $totalPages)
            { // Show if not last page
                $next = sprintf("%s?" . $pageVar . "=%d%s", $currentPage, min($totalPages, $pageNum + 1), $queryString);
                $urlC = str_replace('$$PageNumber$$', $pageNum + 1, $url);
                $thistd = $pageNum + 2;
                $navigation .= "<div class='Next'><a  href='$urlC'  >Next</a></div>";

            } // Show if not last page
            else
            {
                $navigation .= '<div class="Next">Next</div> ';
            }
            $navigation .= "</div>
          </div>
        </div>";
        }
        return $navigation;
    }

} // end of db class

?>