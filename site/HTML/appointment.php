<?php 
    	     
			include_once("includes/header.php");
			
         ?>
           <div class="form">
           	<div class="maindiv">
            	<div class="fleft" style="border-right:1px dashed #484848; margin-bottom:15px;">
            	<div class="fhead">
                	<div class="fhead1">
                    	Book an Appointment
                    </div>
                    <div class="maindiv">
                    	<div class="name">
                    	Your Name<div class="mandatory1">*
                        </div>
                    </div>
                    <div class="formbg">
                    	<input type="text" class="forminput"/>
                    </div>
                    </div>
                    <div class="maindiv">
                    	<div class="name">
                    	Phone Number<div class="mandatory1">*
                        </div>
                    </div>
                    <div class="formbg">
                    	<input type="text" class="forminput"/>
                    </div>
                    </div>
                    <div class="maindiv">
                    	<div class="name">
                    	Email Address
                    </div>
                    <div class="formbg">
                    	<input type="text" class="forminput"/>
                    </div>
                    </div>
                    <div class="maindiv">
                    	<div class="name">
                    	House Number and Street Name 
                        
                    </div>
                    <div class="formbg">
                    	<input type="text" class="forminput"/>
                    </div>
                    </div>
                    <div class="maindiv">
                    	<div class="name" style="width:100%;">
                    	Area<br/>
                    </div>
                    <div class="formbg">
                    	<input type="text" class="forminput" value="e.g. Whitchurch'"/>
                    </div>
                    </div>
                    <div class="maindiv">
                    	<div class="name" style="width:100%;">
                    	City
                    </div>
                    <div class="formbg">
                    	<input type="text" class="forminput" value="Cardiff"/>
                    </div>
                    </div>
                    <div class="maindiv">
                    	<div class="name" style="width:100%;">
                    	Postal / Zip Code
                    </div>
                    <div class="formbg">
                    	<input type="text" class="forminput" value=""/>
                    </div>
                    </div>
                </div>
            </div>
            <div class="fright">
            	<div class="maindiv" style="height:300px;">
                	<div class="fleft" style="width:371px;">
            	<div class="fhead">
                	<div class="fhead2">
                    	Your computer
                    </div>
                    <div class="maindiv">
                    	<div class="name">
                    	Select the type of computer from the drop down list.
                    </div>
                    <div class="formbg2">
                    	<select tabindex="12" onchange="updateCounty(this.form);" class="forminput3" name="country">
                                            <option value="1">Desktop</option>
                                            <option value="2">Laptop</option>
                                            <option value="3">Netbook</option>
                                            <option value="4">Others</option>
                                        </select>
                    </div>
                    </div>
                    <div class="maindiv">
                    	<div class="name" style="width:100%;">
                    	Problem Description
                    </div>
                    <div class="formbg1">
                    	<textarea class="forminput1" rows="1" cols="1">
                        </textarea>
                    </div>
                    </div>
                    
                    
                    
                    
                    
                </div>
            </div>
                </div>
                <div class="maindiv">
                	<div class="fleft" style="width:371px;">
            	<div class="fhead" style="border-bottom:0px;">
                	<div class="fhead3" >
                    	When is good for you
                    </div>
                    <div class="maindiv">
                    	<div class="tleft">
                        	<div class="name" style="width:100%; margin-top:0px; margin-bottom:0px;">
                    	Which day
                        <div class="maindiv">
                    	<div class="formbg4">
                    	<select tabindex="12" onchange="updateCounty(this.form);" class="forminput4" name="date">
                                            <option value="1">01</option>
                                            <option value="2">02</option>
                                            <option value="3">03</option>
                                            <option value="4">04</option>
                                     </select>
                                     <span class="left" style="margin-top:8px; margin-left:3px;">&nbsp;Date</span> 
                    </div>
                    	<span class="left" style="margin-top:10px;">/</span>
                    	<div class="formbg5">
                    	<select tabindex="12" onchange="updateCounty(this.form);" class="forminput5" name="month">
                                            <option value="1">January</option>
                                            <option value="2">February</option>
                                            <option value="3">March</option>
                                            <option value="4">April</option>
                                        </select><br/>
                                        <span class="left" style="margin-top:8px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Month</span>
                    </div>
                    </div>
                    </div>
                        </div>
                    	<div class="tleft">
                        	<div class="name" style="width:100%; margin-top:0px; margin-bottom:0px;">
                    	Which Time
                        <div class="maindiv">
                    	<div class="time">
                    	<select tabindex="12" onchange="updateCounty(this.form);" class="forminputt" name="date">
                                            <option value="1">09</option>
                                            <option value="2">10</option>
                                            <option value="3">11</option>
                                            <option value="4">12</option>
                                        </select>
                                        <span class="left" style="margin-top:8px;">&nbsp;&nbsp;&nbsp;&nbsp;Hour</span> 
                    </div>
                    	<span class="left" style="margin-top:10px;">/</span>
                    	<div class="time">
                    	<select tabindex="12" onchange="updateCounty(this.form);" class="forminputt" name="month">
                                            <option value="1">00</option>
                                            <option value="2">01</option>
                                            <option value="3">02</option>
                                            <option value="4">03</option>
                                        </select>
                                        <span class="left" style="margin-top:8px;">&nbsp;&nbsp;&nbsp;Minute</span> 
                    </div>
                    </div>
                    </div>
                        </div>
                    
                    
                    
                    </div>
                    
                    
                    
                    
                    
                    
                </div>
            </div>
                </div>
            	
            	<div class="book">
                	<a href="#"><img src="images/book.jpg" alt=""/></a>
                </div>
            </div>
            
            	
            	
            </div>
           	
           </div> 	
                
                
            </div>
            <div class="rightpanel">
            	<?php 
    	    
			include_once("includes/contact.php");
			
         ?>
               
                <img src="images/FixedPrice.bmp" alt="" class="right" style="margin-top:25px;"/>
                <img src="images/buy.bmp" alt="" class="right" style="margin-top:25px;"/>
                
            </div>
        </div>
           <div class="quote">
        	<div class="maindiv">
            	<div class="quoteimg">
                	<img src="images/t_6.jpg" alt=""/>
                </div>
                <div class="quotetext">
                	<span><img src="images/quote.jpg" alt=""/></span> Thanks for your fast and efficient services. My old PC has now been restored to full and correct working &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;order without losing any files. Thanks again. Nick Jenkins, Grangetown. <span><img src="images/quoteb.jpg" alt=""/></span>
                </div>
            </div>
        </div>
<?php 
    	    
			include_once("includes/footer.php");
			
         ?>
