<?php
class MySQLPagedResults extends ConnectionMgr
{

    var $total_results_sql;
    var $current_page;
    var $results_per_page;
    var $links_per_page;
    var $previous_link_text;
    var $next_link_text;
    var $total_record;

    function MySQLPagedResults($total_results_sql, $page_name, $url_string, $results_per_page, $links_per_page, $first_link_text, $previous_link_text, $next_link_text, $last_link_text, $seperator)
    {
        $this->total_results_sql = $total_results_sql;
        //echo $this->total_results_sql;
        //die();
        if (!isset($_REQUEST[$page_name]) || $_REQUEST[$page_name] == "")
        { //{umair.alvi@sabritech.com 26/12/2006}changed condition to set page no to 1 if nothing is set
            $this->current_page = 1;
        } else
        {
            $this->current_page = $_REQUEST[$page_name];
        }
        $this->results_per_page = $results_per_page;
        $this->links_per_page = $links_per_page;
        $this->previous_link_text = $previous_link_text;
        $this->next_link_text = $next_link_text;
        $this->first_link_text = $first_link_text;
        $this->last_link_text = $last_link_text;
        $this->page_name = $page_name;
        $this->url_string = $url_string;
        $this->seperator = $seperator;
    }

    function totalResults()
    {
        $this->total_results_sql;
        //die();
        $result = $this->DML_executeQry($this->total_results_sql);
        //$rs = mysql_fetch_array($result);
        $totalrecords = mysql_num_rows($result);
        //echo "<br>";
        //print_r($rs);
        //die();

        $this->total_record = $totalrecords;
        return $this->total_record;
    }

    function totalPages()
    {
        return ceil($this->totalResults() / $this->results_per_page);
    }

    function currentOffset()
    {
        return ($this->current_page - 1) * $this->results_per_page;
    }

    function isFirstPage()
    {
        return ($this->current_page <= 1);
    }

    function isLastPage()
    {
        return ($this->current_page >= $this->totalPages());
    }

    function getPrevNav()
    {
        $nav = '';
        //Deal with previous link
        if (!$this->isFirstPage())
        {
            $nav .= "<a href=\"javascript: submitPaging('frmPaging',$this->current_page-1);\" class='pagingText'>" . $this->previous_link_text . '</a>';
        } else
        {
            $nav .= $this->previous_link_text;
        }
        return $nav;
    }

    function getNextNav()
    {
        $nav = '';
        //Deal with next link
        if (!$this->isLastPage())
        {
            $nav .= "<a href=\"javascript: submitPaging('frmPaging',$this->current_page+1);\"  class='pagingText'>" . $this->next_link_text . '</a>';
        } else
        {
            $nav .= $this->next_link_text;
        }
        return $nav;
    }

    function getFirstNav()
    {
        $nav = '';
        //Deal with previous link
        if (!$this->isFirstPage())
        {
            $nav .= "<a href=\"javascript: submitPaging('frmPaging',1)\"  class='pagingText'>" . $this->first_link_text . '</a>';
        } else
        {
            $nav .= $this->first_link_text;
        }
        return $nav;
    }

    function getLastNav()
    {
        $nav = '';
        //Deal with previous link
        if (!$this->isLastPage())
        {
            $nav .= "<a href=\"javascript: submitPaging('frmPaging'," . $this->totalPages() . ");\" class='pagingText'>" . $this->last_link_text . '</a>';
        } else
        {
            $nav .= $this->last_link_text;
        }

        return $nav;
    }

    function getResultNumbersStart()
    {
        return ($this->current_page * $this->results_per_page) - $this->results_per_page + 1;
    }

    function getResultNumbersEnd()
    {
        return $this->getResultNumbersStart() + $this->results_per_page - 1;
    }

    function getStartNumber()
    {
        $links_per_page_half = ceil($this->links_per_page / 2);
        //echo $this->current_page."====";
        //echo $links_per_page_half."===";
        //echo $this->totalPages() . "<br>";
        $returnthisValue = 1;
        if ($this->current_page <= $links_per_page_half)
        {
            $returnthisValue = 1;
        } elseif ($this->current_page >= $this->totalPages() - $links_per_page_half)
        {
            $returnthisValue = $this->totalPages() - $this->links_per_page + 1;
        } else
        {
            $returnthisValue = ceil($this->current_page - $links_per_page_half);
        }
        if ($returnthisValue < 1)
        {
            return 1;
        } else
        {
            return $returnthisValue;
        }

    }

    function getEndNumber()
    {
        //echo $this->totalPages(); 3
        //echo $this->links_per_page; 2
        if ($this->totalPages() < $this->links_per_page)
        {
            return $this->totalPages();
        } else
        {
            return $this->links_per_page;
        }
    }

    function getPagesNav()
    {
        $nav = '';
        // echo $this->getStartNumber();
        // echo $this->current_page;
        for ($i = $this->getStartNumber(); $i < $this->getStartNumber() + $this->getEndNumber(); $i++)
        {

            if ($i != $this->current_page)
            {
                $nav .= "<a href=\"javascript: submitPaging('frmPaging',$i)\"  class='pagingText'>$i</a>";
            } else
            {
                $nav .= "$i";
            }
            if ($i != $this->getStartNumber() + $this->getEndNumber() - 1)
            {
                $nav .= $this->seperator;
            }
        }
        //echo $nav;
        return $nav;
    }
}
?>
