function limitText(limitField, limitCount, limitNum) {
	if (limitField.value.length > limitNum) {
		alert("maximum "+limitNum+" characters are allowed");
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		limitCount.value = limitNum - limitField.value.length;
	}
} // ta
function isValid(pattern, str)
	{
		return pattern.test(str);
	}

function Validate(strToValidate,RegPattern)
	{
			var expr = new RegExp(RegPattern,"g");
			var result = expr.test(strToValidate);
			if(result==true)
			{
				return true;
			
			}
		else{
				return false;
			}
	}
////////////////////////////////////////////////// Password change Form validation code  /////////////////////////////
function validatePasswordChangeform()
	{
	
				
		if(document.getElementById("txtOldPassword").value == "")
		{
		 alert("Please enter Old Password.");
		 document.getElementById("txtOldPassword").focus();
		 return false;
		}
		if(document.getElementById("txtNewPassword").value == "")
		{
		 alert("Please enter New Password.");
		 document.getElementById("txtNewPassword").focus();
		 return false;
		}
		if(document.getElementById("txtNewPassword").value.indexOf(" ") >0){
			alert("Please enter a valid value in the New Password field. Spaces are not allowed.");
		 	document.getElementById("txtNewPassword").focus();
		 	return false;
		}
		if(document.getElementById("txtConfirmNewPassword").value == "")
		{
		 alert("Please enter Confirm New Password.");
		 document.getElementById("txtConfirmNewPassword").focus();
		 return false;
		}
		if(document.getElementById("txtConfirmNewPassword").value.indexOf(" ") >0){
			alert("Please enter a valid value in the Confirm New Password field. Spaces are not allowed.");
		 	document.getElementById("txtConfirmNewPassword").focus();
		 	return false;
		}		
		if(document.getElementById("txtNewPassword").value != document.getElementById("txtConfirmNewPassword").value)
		{
		 alert("The values in New Password and Confirm New Password field must match.");
		 document.getElementById("txtConfirmNewPassword").focus();
		 return false;
		}
		 return true;
	   
	}
//////////////////////////////////////////////// End of Password change Form validation code /////////////////////////////

////////////////////////////////////////////////// Login Form validation code  /////////////////////////////
function validateLoginform()
	{
	
				
		if(document.getElementById("txtUsername").value == "")
		{
		 alert("Please enter a Username.");
		 document.getElementById("txtUsername").focus();
		 return false;
		}
		if(document.getElementById("txtPassword").value == "")
		{
		 alert("Please enter a Password.");
		 document.getElementById("txtPassword").focus();
		 return false;
		}
		 return true;
	   
	}
//////////////////////////////////////////////// End of Login Form validation code /////////////////////////////
	
//////////////////////////////////////////// CMS Design step one from validation function /////////////////////////////
function validateStepOneform()
	{
	
				
		if(document.getElementById("txtWebSiteName").value == "")
		{
		 alert("Please enter website name.");
		 document.getElementById("txtWebSiteName").focus();
		 return false;
		}
		if(Validate(document.getElementById("txtWebSiteName").value,"[^A-Za-z\\ ]") == true){
		alert("Please enter valid website name \nAllowed: A-Z a-z.");
		document.getElementById("txtWebSiteName").focus();
		return false;
		}
		if(document.getElementById("txtWebSiteUrl").value == "")
		{
		 alert("Please enter email website url");
		 document.getElementById("txtWebSiteUrl").focus();
		 return false;
		}
		if(document.getElementById("txtWebSiteEmail").value == "")
		{
			alert("Please enter website email");
			document.getElementById("txtWebSiteEmail").focus();
			return false;
	   	}
		if(Validate(document.getElementById("txtWebSiteEmail").value,"^[A-Za-z][A-Za-z0-9_\\.]*@[A-Za-z]*\\.[A-Za-z0-9]") == false){
			alert("Please enter valid website e-mail.");
			document.getElementById("txtWebSiteEmail").focus();
			return false;
		}
		 
		 return true;
	   
	}
	//////////////////////////////////////////// End of CMS Design step one from validation function /////////////////////////////
	
	
	//////////////////////////////////////////// CMS Design step two from validation function /////////////////////////////
function validateStepTwoform()
	{
	
				
		if(document.getElementById("txtHostName").value == "")
		{
		 alert("Please enter host name.");
		 document.getElementById("txtHostName").focus();
		 return false;
		}
		if(document.getElementById("txtDatabaseName").value == "")
		{
		 alert("Please enter database name.");
		 document.getElementById("txtDatabaseName").focus();
		 return false;
		}
		if(document.getElementById("txtDatabaseUsername.").value == "")
		{
			alert("Please enter database user name.");
			document.getElementById("txtDatabaseUsername").focus();
			return false;
	   	}
		if(document.getElementById("txtDatabasePassword").value == ""){
			alert("Please enter database password.");
			document.getElementById("txtDatabasePassword").focus();
			return false;
		}
		 
		 return true;
	   
	}
	//////////////////////////////////////////// End of CMS Design step two from validation function /////////////////////////////
	
//////////////////////////////////////////// Help and support form validation  /////////////////////////////
function validatehelpsupportform()
	{
	
		if(document.getElementById("txtClientName").value == "")
		{
		 alert("Please enter name.");
		 document.getElementById("txtClientName").focus();
		 return false;
		}
		if(Validate(document.getElementById("txtClientName").value,"[^A-Za-z\\ ]") == true){
		alert("Please enter valid website name \nAllowed: A-Z a-z.");
		document.getElementById("txtClientName").focus();
		return false;
		}
		if(document.getElementById("txtEmail").value == "")
		{
			alert("Please enter email.");
			document.getElementById("txtEmail").focus();
			return false;
	   	}
		if(Validate(document.getElementById("txtEmail").value,"^[A-Za-z][A-Za-z0-9_\\.]*@[A-Za-z]*\\.[A-Za-z0-9]") == false){
			alert("Please enter valid client e-mail.");
			document.getElementById("txtEmail").focus();
			return false;
		}
		if(document.getElementById("txtSubject").value == "")
		{
		 alert("Please enter subject.");
		 document.getElementById("txtSubject").focus();
		 return false;
		}		 
		 return true;	   
	}
	//////////////////////////////////////////// End of CMS Design step one from validation function /////////////////////////////
	
