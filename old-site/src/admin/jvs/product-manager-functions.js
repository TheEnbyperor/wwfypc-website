///////////////////////////////////////// checking file types /////////////////////////////////////////////////////// 

function fileTypeCheck(filename)
{	
	var fileTypes=["gif","png","jpg","jpeg"]; 
	var defaultPic="spacer.gif";
	var source=filename.value;
	var ext=source.substring(source.lastIndexOf(".")+1,source.length).toLowerCase();
	for (var i=0; i<fileTypes.length; i++) if (fileTypes[i]==ext) break;
	globalPic=new Image();
	if (i<fileTypes.length) globalPic.src=source;
	else 
	{
		//globalPic.src=defaultPic;
		alert("Invalid image. Please upload a file ending with jpg, jpeg, gif or png etc!");
		filename.focus();
		return false;
	}
	return true;
}

///////////////////////////////////////// checking file types ///////////////////////////////////////////////////

///////////////////////////////////////// Add category validation ///////////////////////////////////////////////
function addCategoryFrmValidation()
	{
	
		try
			{
						if(document.getElementById("catDisplayName").value != "")
						{
							var categoryNameArray = document.getElementById("catDisplayName").value.split('->');
							var numOfCategoryLevels = parseInt(categoryNameArray.length) + 1;
							document.getElementById("catCurrentLevel").value = numOfCategoryLevels;
						}
						 
				
			}
			catch(err) 
			{
						
			  			 //numOfCatLevels
						 //alert(document.getElementById("catNumLevel").value);
			}
			if(document.getElementById("catCurrentLevel").value > document.getElementById("numOfCatLevels").value)
			{
			
				alert('You can add categories upto ' + document.getElementById("numOfCatLevels").value + ' levels');
				return false;		
			}
			if(document.getElementById("txtCategoryName").value == "")
			{
					alert("Please enter category name");
					document.getElementById("txtCategoryName").focus();
					return false;
			}
			if(Validate(document.getElementById("txtCategoryName").value,"[^A-Za-z0-9\\ ]") == true){
			alert("Please enter valid category name \nAllowed: A-Z a-z 0-9");
			document.getElementById("txtCategoryName").focus();
			return false;
			}
			if(document.getElementById("catImage").value != "")
			{
				if(fileTypeCheck(document.getElementById("catImage")) == false)
				{
					return false;
					
				}
			}
		
		return true;
		
	
	}
//////////////////////////////////////////////// End of Add category validation ////////////////////////////

////////////////////////////////////////////////// update category validation  /////////////////////////////
function updateCategoryFrmValidation()
		{
			var categoryName = "txtCategoryName";
			var categoryImage = "catImage";
			var numOfRecords = parseInt(document.getElementById("numOfRecords").value);
			for(i=1; i<= numOfRecords; i++)
			{
				catName = categoryName + i;
				catImage = categoryImage + i;
				//alert(catName);
				if(document.getElementById(catName).value == "")
				{
					alert("Please enter category name");
					document.getElementById(catName).focus();
					return false;
				}
				if(Validate(document.getElementById(catName).value,"[^A-Za-z0-9\\ ]") == true)
				{
					alert("Please enter valid category name \nAllowed: A-Z a-z 0-9");
					document.getElementById(catName).focus();
					return false;
				}
				if(document.getElementById(catImage).value != "")
				{
			
					if(fileTypeCheck(document.getElementById(catImage)) == false)
					{
						return false;
					
					}
				}
			}
		
		 return true;
		
	
	 }
//////////////////////////////////////////// End of update category validation /////////////////////////////
	
//////////////////////////////////////////// Category deletion function  ///////////////////////////////////
function deleteCategoryFrmValidation()
		{
			var ajaxRequest;  // The variable that makes Ajax possible!
			var queryString = "";
			var pollchecks = document.getElementsByTagName("INPUT");
		 	var _return = false;
			var countstatus = 1;	 
			var categoryId = "";
		 	for (var i = 0; i < pollchecks.length; i++)
		  	{			
				if(pollchecks[i].type == "checkbox" && pollchecks[i].checked == true)
				{
					if(countstatus == 1)
					{
						categoryId = pollchecks[i].value;
						countstatus++;
						_return = true;
					}
					else
					{
						pollchecks[i].checked = false;
					}
					
					
					
				}
				
		  }
		  if (_return == false)
		  {
		  alert('Please select one record');
		   return _return;	
		  }
		  if(categoryId != "" && _return == true)
		  {
		  		try{
					// Opera 8.0+, Firefox, Safari
					ajaxRequest = new XMLHttpRequest();
			  		 } catch (e){
							// Internet Explorer Browsers
							try{
								ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
							   } 		
								catch (e) {
											try{
												ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
												} 
												catch (e){
														// Something went wrong
															alert("Your browser does not support Ajax. You are using old browser!");
														  }	return false;
											}
				
							
							}
			
		// Create a function that will receive data sent from the server
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							//alert(ajaxRequest.responseText);
							//return false;
							if(ajaxRequest.responseText == -1)
							{
									alert('Subcategory record exist');
									return false;
									
							
							}
							else if(ajaxRequest.responseText == -2)
							{
								alert('Product record exist');
								return false;
										
							}
							else if(ajaxRequest.responseText == 1)
							{
								document.getElementById("catDisplayName").value = "";
								document.getElementById("categoryId").value = "";
								document.getElementById("Mode").value = "Delete";
								document.getElementById("frmcategories").submit();
								return true;
							}
						}
				}
		
				//alert(categoryId);
				queryString = "?catId=" + categoryId;
				ajaxRequest.open("GET", "../Product Manager/ajaxvarify-action.php" + queryString, true);
				ajaxRequest.send(null);
		  
		  
		  
		  }

	 }
//////////////////////////////////////////// End of Category Deletion function ///////////////////////////////////////
	
//////////////////////////////////////////// Edit Category form //////////////////////////////////////////////////////
function editCategoryFrmSubmit()
		{
			var pollchecks = document.getElementsByTagName("INPUT");
		 	var _return = false;	 
		 	for (var i = 0; i < pollchecks.length; i++)
		  	{			
				if(pollchecks[i].type == "checkbox" && pollchecks[i].checked == true )
				{
						document.getElementById("Mode").value = "Edit";
						document.getElementById("frmcategories").submit();
						_return = true;
						break;				
					
					
					
				}
		    }
		  if (_return == false)
		  {
		  alert('Please select at least one record');
		   return _return;	
		  }
		  return _return;
			
		}
/////////////////////////////////////////// End of Edit Category form /////////////////////////////////////////////////


//================= product addition and updation checks ===================================================
function addFrmProductValidat(Mode)
	{
		
		if(Mode == 'Add')
		{
			var insertedProducts = parseInt(document.getElementById("numOfInsertedProducts").value);
			var AllowedProducts = parseInt(document.getElementById("numOfAllowedProducts").value);
			var displayMessage = "";
			
			if(insertedProducts >= AllowedProducts && AllowedProducts != 0)
			{
		 		displayMessage = 'You are allow to add ' + AllowedProducts + ' Products \n For more info please contact administrator.';
				alert(displayMessage);
				return false;
			}
		}
		if(document.getElementById("cmdCategories").value == "")
		{
				alert("Please select category");
				document.getElementById("cmdCategories").focus();
				return false;
		}
		if(document.getElementById("txtProductName").value == "")
		{
				alert("Please enter product name");
				document.getElementById("txtProductName").focus();
				return false;
		}
		if(Validate(document.getElementById("txtProductName").value,"[^A-Za-z0-9\\ ]") == true){
		alert("Please enter valid product name \nAllowed: A-Z a-z 0-9");
		document.getElementById("txtProductName").focus();
		return false;
		}
		return true;
		
	
	}
	
//====================  Endo of product addition and updation checks 
//==================== Ajax function For populating catetories combobox 

	function ajaxCategoryAction(category)
	{
	//alert('hello');
		
		var categoryId = category.value;
			
			//alert(categoryId);
		if(categoryId != document.getElementById("lastCatValue").value)
		{
			if(categoryId == "")
			{
				categoryId = 0;
			}
			else
			{
				document.getElementById("lastCatValue").value = categoryId;	
			}
			var ajaxRequest;  // The variable that makes Ajax possible!
			var queryString ="";
			var optionValues = "";
			try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequest = new XMLHttpRequest();
			   } catch (e){
				// Internet Explorer Browsers
							try{
								ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
							   } 		
								catch (e) {
											try{
												ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
												} 
												catch (e){
														// Something went wrong
															alert("Your browser does not support Ajax. You are using old browser!");
														  }	return false;
											}
				
							
							}
			
		// Create a function that will receive data sent from the server
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							optionValues = ajaxRequest.responseText;
							if(optionValues != "false")
							{
								//alert(optionValues.length);
								//alert(optionValues);
								removeItems("cmdCategories");
								optiosArray = optionValues.split("|");
								var toFill=document.getElementById("cmdCategories");
								//var makeNewOption=document.createElement("Option");
								for(i=0; i < optiosArray.length; i++)
								{
									//alert(optiosArray[i]);
									var makeNewOption=document.createElement("Option");
									//alert(optiosArray[i]);
									makeNewOption.value = optiosArray[i];
									i=i+1; 
									makeNewOption.text = optiosArray[i];
									toFill.options.add(makeNewOption);
									
								}
							}
							
						}
				}
		
			//alert(categoryId);
			queryString = "?catId=" + categoryId;
			ajaxRequest.open("GET", "../Product Manager/ajaxcat-action.php" + queryString, true);
			ajaxRequest.send(null);
		
		}
		
	}
	
	
//====================Ajax function For populating catetories combobox 
//=========== removing options tags ===================================
function  removeItems(Obj)
{
	var idObjectNameToEmpty=document.getElementById(Obj);
	var totalLength=idObjectNameToEmpty.length;
	for(var ind=2; ind<=totalLength; ind++)
	{
		idObjectNameToEmpty.remove(idObjectNameToEmpty.length-1);
	}
}

//=========== End of removing options tags ===================================

//===========submiting the form for paging =============================
	function submitPaging(frm,page)
	{
		
		document.frmPaging.pageNo.value = page;
		document.frmPaging.submit();
	}
//======================================================================

//========================================== Product detail function =======================================

function AdditionFrmValidat(Mode)
	{
		sizepattern = /^[0-9][0-9]*\.?[0-9]*$/; //define patteren for valide user input entry 
		pricepattern = /^[1-9][0-9]*\.?[0-9]*$/; //define patteren for valide user input entry 
		quantitypattern = /^[1-9][0-9]*$/;		
		if(document.getElementById("cmdProducts").value == "")
		{
				alert("Please select product name");
				document.getElementById("cmdProducts").focus();
				return false;
		}
		if(Validate(document.getElementById("txtProductSize").value,"[^A-Za-z0-9\\ .]") == true)
		{
			 alert("Please enter valid size");
			 document.getElementById("txtProductSize").focus();
			 return false;
		}
		try
			{
						if(quantitypattern.test(document.getElementById("txtProductQty").value) == false)
						{
							 alert("Please enter valid quantity");
							 document.getElementById("txtProductQty").focus();
							 return false;
						}
						 
				
			}
			catch(err) 
			{
						
			  			 //numOfCatLevels
						 //alert(document.getElementById("catNumLevel").value);
			}
		try
			{
						if(quantitypattern.test(document.getElementById("txtReorderLevel").value) == false)
						{
							 alert("Please enter valid reorder value");
							 document.getElementById("txtReorderLevel").focus();
							 return false;
						}
						 
				
			}
			catch(err) 
			{
						
			  			 //numOfCatLevels
						 //alert(document.getElementById("catNumLevel").value);
			}
		if(pricepattern.test(document.getElementById("txtProductPrice").value) == false)
		{
			 alert("Please enter valid price");
			 document.getElementById("txtProductPrice").focus();
			 return false;
		}
		if(document.getElementById("cmbProVat").value == "")
		{
				alert("Please select product vat");
				document.getElementById("cmbProVat").focus();
				return false;
		}
		if(Mode == 'Add')
		{
			if(fileTypeCheck(document.getElementById("proImage")) == false)
			{
				return false;
			
			}
		}
		if(Mode == 'Edit')
		{
			if(document.getElementById("proImage").value != "")
			{
				if(fileTypeCheck(document.getElementById("proImage")) == false)
				{
					return false;
			
				}
			
			}
		
		}
		return true;
		
	
	}

//======================================== Ajax function  populate products againsist selected category 	
function ajaxProductAction(category)
	{
		
		var categoryId = category.value;
		var ajaxRequest;  // The variable that makes Ajax possible!
		var queryString ="";
		var optionValues = "";
		if(categoryId != "")
		{
			try{
				// Opera 8.0+, Firefox, Safari
				ajaxRequest = new XMLHttpRequest();
			   } catch (e){
				// Internet Explorer Browsers
							try{
								ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
							   } 		
								catch (e) {
											try{
												ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
												} 
												catch (e){
														// Something went wrong
															alert("Your browser does not support Ajax. You are using old browser!");
														  }	return false;
											}
				
							
							}
		
			ajaxRequest.onreadystatechange = function()
				{
					if(ajaxRequest.readyState == 4)
						{
							optionValues = ajaxRequest.responseText;
							if(optionValues != "false")
							{
								
								removeItems("cmdProducts");
								optiosArray = optionValues.split("|");
								var toFill=document.getElementById("cmdProducts");
								for(i=0; i < optiosArray.length; i++)
								{
										var makeNewOption=document.createElement("Option");
										makeNewOption.value = optiosArray[i];
										i=i+1; 
										makeNewOption.text = optiosArray[i];
										
										toFill.options.add(makeNewOption);
										
										
							    }
								
							 }
							
						}
				  }
			
			queryString = "?catId=" + categoryId;
			ajaxRequest.open("GET", "../Product Manager/ajaxpro-action.php" + queryString, true);
			ajaxRequest.send(null);
		
		}
		 
	}
	
	
//====================================== End of Ajax Function =======================================

//====================================== Delete confirmation check ===============================

function deleteRecordCheck()
	{
	 	 var pollchecks = document.getElementsByTagName("INPUT");
		 var _return = false;	 
		 for (var i = 0; i < pollchecks.length; i++)
		  {			
			if(pollchecks[i].type == "checkbox" && pollchecks[i].checked == true )
			{
				if(confirm("Are you sure to delete selected records"))
				{
					_return = true;
					break;				
				}
				else{
				
                  	return false;
					break;				   
				 }
				
			}
		  }
		  if (_return == false)
		  {
		  	alert('Please select at least one record');
		   	return _return;	
		  }
		  return _return;
		  
	}

//====================================== End of Delete confirmation check ===============================

//====================================== Product unit form validation ======================================
function unitFrmValidation()
	{	
		if(document.getElementById("txtProductUnit").value == "")
		{
				alert("Please enter unit name");
				document.getElementById("txtProductUnit").focus();
				return false;
		}
		if(Validate(document.getElementById("txtProductUnit").value,"[^A-Za-z\\ ]") == true){
		alert("Please enter valid unit name \nAllowed: A-Z a-z");
		document.getElementById("txtProductUnit").focus();
		return false;
		}
		return true;
		
	
	}
	
//====================================== Product vat form validation ======================================
function vatFrmValidation()
	{	
		vatpattern = /^[0-9][0-9]*\.?[0-9]*$/; //define patteren for valide vat value 
		if(document.getElementById("txtVatValue").value == "")
		{
				alert("Please enter vat value.");
				document.getElementById("txtVatValue").focus();
				return false;
		}
		if(vatpattern.test(document.getElementById("txtVatValue").value) == false)
		{
			 alert("Please enter valid vat value.");
			 document.getElementById("txtVatValue").focus();
			 return false;
		}
		
		return true;
		
	
	}

//========================================== Supllier form validation =======================================

function supplierFrmValidation()
	{
		
		if(document.getElementById("txtName").value == "")
		{
			 alert("Please enter supplier name");
			 document.getElementById("txtName").focus();
			 return false;
		}
		if(Validate(document.getElementById("txtName").value,"[^A-Za-z0-9\\ ]") == true)
		{
				alert("Please enter valid supplier name");
				document.getElementById("txtName").focus();
				return false;
		}
		if(document.getElementById("txtAddress").value == "")
		{
			 alert("Please enter supplier address");
			 document.getElementById("txtAddress").focus();
			 return false;
		}
		if(document.getElementById("txtTelephone").value == "")
		{
			 alert("please enter telephone number");
			 document.getElementById("txtTelephone").focus();
			 return false;
		}
		if(checkInternationalPhone(document.getElementById("txtTelephone").value) == false)
		{
			alert("Please enter a valid phone number");
			 document.getElementById("txtTelephone").focus();
			 return false;
		}
		if(document.getElementById("txtEmail").value == "")
		{
			 alert("Please enter email address");
			 document.getElementById("txtEmail").focus();
			 return false;
		}
		if(Validate(document.getElementById("txtEmail").value,"^[A-Za-z][A-Za-z0-9_\\.]*@[A-Za-z]*\\.[A-Za-z0-9]") == false)
		{
				alert("Please enter valid email address");
				document.getElementById("txtEmail").focus();
				return false;
		}
		return true;
		
	
	}

//====================================== Tele phone number validation =======================================================

var digits = "0123456789";
// non-digit characters which are allowed in phone numbers
var phoneNumberDelimiters = "()- ";
// characters which are allowed in international phone numbers
// (a leading + is OK)
var validWorldPhoneChars = phoneNumberDelimiters + "+";
// Minimum no of digits in an international phone no.
var minDigitsInIPhoneNumber = 10;

function isInteger(s)
{   var i;
    for (i = 0; i < s.length; i++)
    {   
        // Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9"))) return false;
    }
    // All characters are numbers.
    return true;
}

function stripCharsInBag(s, bag)
{   var i;
    var returnString = "";
    // Search through string's characters one by one.
    // If character is not in bag, append to returnString.
    for (i = 0; i < s.length; i++)
    {   
        // Check that current character isn't whitespace.
        var c = s.charAt(i);
        if (bag.indexOf(c) == -1) returnString += c;
    }
    return returnString;
}

function checkInternationalPhone(strPhone){
s=stripCharsInBag(strPhone,validWorldPhoneChars);
return (isInteger(s) && s.length >= minDigitsInIPhoneNumber);
}

//====================================== End of Tele phone number validation ==================================================

//====================================== product Reorder form validation =======================================
function productReorderValidationForm()
		 {
		 	quantitypattern = /^[1-9][0-9]*$/;
			var numOfRecordPerPage = document.getElementById("numOfRecordPerPage").value;
			for(i = 1; i <= numOfRecordPerPage ; i++ )
			{
			 	
				try
				{
						var productReorderQty = "txtProQty" + i;		
						var supplierValue = "cmbSupplier" + i;
						if(document.getElementById(productReorderQty).value != "")
						{
							 if(quantitypattern.test(document.getElementById(productReorderQty).value) == false)
							 {
								alert("Please enter valid quantity.");
								document.getElementById(productReorderQty).focus();
								return false;
								break;
							 }
							 if(document.getElementById(supplierValue).value== "")
							 {
									alert("Please select supplier name.");
									document.getElementById(supplierValue).focus();
									return false;
									break;
							 }
							
						}
						 
				
				}
				catch(err) 
				{
						
			  			 //numOfCatLevels
						 //alert(document.getElementById("catNumLevel").value);
				}
				
				
				
			}
			
			return true;

		
		 }
//====================================== End of product Reorder form validation =======================================


//====================================== all check box selection ===============================

function checkedAll()
	{
	 	 var pollchecks = document.getElementsByTagName("INPUT");
		 var _return = false;	 
		 for (var i = 0; i < pollchecks.length; i++)
		  {			
			if(pollchecks[i].type == "checkbox")
			{
				  pollchecks[i].checked = true ;
				
			}
		  }
		  
	}

//====================================== End all check box selection ===============================

//====================================== unchecked selection ===============================

function uncheckedAll()
	{
	 	 var pollchecks = document.getElementsByTagName("INPUT");
		 var _return = false;	 
		 for (var i = 0; i < pollchecks.length; i++)
		  {			
			if(pollchecks[i].type == "checkbox")
			{
				  pollchecks[i].checked = false;
				
			}
		  }
		  
	}

//====================================== End unchecked selection ===============================