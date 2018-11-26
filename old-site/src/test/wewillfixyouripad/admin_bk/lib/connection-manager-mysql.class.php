<?

/**
 mysql Connection Manager Class would hanlde Connection to Database and Exectue both DML And DLL Queries.
 * @author  
 * @package TCB
 * @since   1.0
**/

class ConnectionMgr
{
	var $con;
	var $cur;
	var $tCount;
	var $arrQry;
	var $errNo;
//=====================Creating connection ==================	
	function createConnection()
	{
		$this->con=$link = @mysql_connect(SERVER_ADDRESS, USERNAME, PASSWORD);
		if(!$this->con) 
			return -1;
		
		if(!mysql_select_db(DATABASE))
		{ 
			//echo mysql_error();
			return -2;
		}
		return $this->con;
	}
//===========Executing the select query==================	
	
	function DML_executeQry($query)
	{
		//echo $query;
		
		 
		if(!isset($this->con))
			$this->errNo=$this->createConnection();
		if($this->errNo>0)
		{
			
			$result = mysql_query($query,$this->errNo);
			//echo mysql_num_rows($result)."____";
		  
			if (!$result) 
			{
				
				//print "<br>".$query."<br>";
				//echo mysql_error()."<br>";
				return -3;
			}
				//echo "<br />yes in ";	
			return $result;
		}
		else
		{
			//echo "<br />error no.".$this->errNo;
			return $this->errNo;
		}
	}
//===========================Executing the insert update delete query===============	
	
	function DDL_executeQry($query)
	{
		if(!isset($this->con))			
			$this->errNo=$this->createConnection();			
		if($this->errNo)
		{
			//echo $this->errNo;
			if (!mysql_query($query,$this->errNo))
			{
				//echo $query."<br>";
				//echo mysql_error();
				$mysqlErrNo=mysql_errno($this->con);
				//echo $mysqlErrNo;
				if($mysqlErrNo==1451)
					return "-".mysql_errno($this->con);
				else
					return -3;
			}			
			return 1;
		}
		else
		{
			return $this->errNo;
		}
	}

//===========================Get Last Inserted ID===============		
	function insertid()
    {
        return mysql_insert_id($this->con);
    }
	
//==Start tanscation function =======================	
	function startinTranscation()
	{
		$errNo=$this->DDL_executeQry("start transaction");
		if($errNo>0)
			return 1;
		else
			return $errNo;
	}
	//=======Commit transcaton================================
	function commitTranscation()
	{
		$errNo=$this->DDL_executeQry("commit");
		if($errNo>0)
			return 1;
		else
			return $errNo;
	}
	//==========Roll back transcation ==========
	function rollbackTranscation()
	{
		$errNo=$this->DDL_executeQry("rollback");
		if($errNo>0)
			return 1;
		else
			return $errNo;
	}
//=================================================================================
}

?>
