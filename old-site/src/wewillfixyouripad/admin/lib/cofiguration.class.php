<?php

class Cofiguration
{
	
	
	
	function Cofiguration()
	{
		//$this->objQryBuilder = new QueryBuilder();
		//$this->objConMgr = new ConnectionMgr();
	}

//--------This function will create folder with given name  {umair.alvi@sabritech.com 11/05/2007}-- 
	function CreateWebsiteNameFloder($fieldName)
	{
		//echo $fieldName;
		//die();
		if(isset($fieldName) && $fieldName != "")
		{
				if(mkdir ($fieldName,0777))
				{ 
					return 1;
				}
			else{
						return 0;
				}
		}
		if(!isset($fieldName) || $fieldName == "")
		{
			return 0;
		}
	}
	
//---------End Of this function -----------------------
//------This function will perform single file copy operation from specified source to destination {umair.alvi@sabritech.com 11/05/2007}--
function copySpecifiedFile($source,$destination)
	{
		
		if((isset($source) && $source != "") && (isset($destination) && $destination != ""))
		{
				if(copy($source,$destination))
				{ 
					return 1;
				}
			else{
						return 0;
				}
		}
		else{
		
				return 0;
		    }
		
	}
//---------End Of this function -----------------------
//------This function will perform Directory copy operation from specified source to destination {umair.alvi@sabritech.com 17/05/2007}--	
	/*function dircopy($srcdir, $dstdir, $verbose = false) {
		  $num = 0;
		  if(!is_dir($dstdir)) mkdir($dstdir);
		  if($curdir = opendir($srcdir)) {
			while($file = readdir($curdir)) {
			  if($file != '.' && $file != '..') {
				$srcfile = $srcdir . '\\' . $file;
				$dstfile = $dstdir . '\\' . $file;
				if(is_file($srcfile)) {
				  if(is_file($dstfile)) $ow = filemtime($srcfile) - filemtime($dstfile); else $ow = 1;
				  if($ow > 0) {
					if($verbose) echo "Copying '$srcfile' to '$dstfile'...";
					if(copy($srcfile, $dstfile)) {
					  touch($dstfile, filemtime($srcfile)); $num++;
					  if($verbose) echo "OK\n";
					}
					else echo "Error: File '$srcfile' could not be copied!\n";
				  }                   
				}
				else if(is_dir($srcfile)) {
				  $num += dircopy($srcfile, $dstfile, $verbose);
				}
			  }
			}
			closedir($curdir);
		  }
		  return $num;
		}*/
		
		
		function dircpy($source, $dest, $overwrite = false){

		  if($handle = opendir($source)){         // if the folder exploration is sucsessful, continue
			while(false !== ($file = readdir($handle))){ // as long as storing the next file to $file is successful, continue
			  if($file != '.' && $file != '..'){
				$path = $source . '/' . $file;
				if(is_file($path)){
				  if(!is_file($dest . '/' . $file) || $overwrite)
					if(!@copy($path,$dest . '/' . $file)){
					  echo '<font color="red">File ('.$path.') could not be copied, likely a permissions problem.</font>';
					}
				} elseif(is_dir($path)){
				  if(!is_dir($dest . '/' . $file))
					mkdir($dest . '/' . $file); // make subdirectory before subdirectory is copied
				  $this->dircpy($path, $dest . '/' . $file, $overwrite); //recurse!
				}
			  }
			}
			closedir($handle);
		  }
	} // end of dircpy()
	
	######################## This function use for setting editor files path to upload images using editor 
	function editorConfigFileSetting($fileSource,$configFileValue)
	{
		
		
		$handle = @fopen($fileSource,"r");
		$writeEditorConfig = "";
		if($handle) 
			{
				while (!feof($handle))
					{
						$buffer = fgets($handle,filesize($fileSource));
						
						$countWords = strlen("Config['UserFilesPath']");
						
						if(substr($buffer,1,$countWords) == "Config['UserFilesPath']")
						{
							
							$writeEditorConfig	.=  $configFileValue;
						
						}
						else
						{
							
							$writeEditorConfig  .=  $buffer;
							
						}
						
					
					}
					
					fclose($handle);
					$handle = @fopen($fileSource,"w+");
					fwrite($handle,$writeEditorConfig);
					fclose($handle);
				
			}
		  
	} 
}
?>
