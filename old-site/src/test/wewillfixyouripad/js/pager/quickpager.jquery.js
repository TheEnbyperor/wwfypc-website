//-------------------------------------------------

//		Quick Pager jquery plugin

//		Created by dan@geckonm.com

//		www.geckonewmedia.com

// 

//-------------------------------------------------



(function($) {

	    

	$.fn.quickPager = function(options) {

	

		var defaults = {

            pageSize: 1,

            currentPage: 1,

			holder: ""

    	};

    	var options = $.extend(defaults, options);

	  	

		//leave this

		var selector = $(this);

		var totalRecords = $(this).children().length;

		var pageCounter = 1;



		selector.children().each(function(i){

			if(i < pageCounter*options.pageSize && i >= (pageCounter-1)*options.pageSize) {

				$(this).addClass("page"+pageCounter);

			}

			else {

				$(this).addClass("page"+(pageCounter+1));

				pageCounter ++;

			}	

		});

		 

		//show/hide the appropriate regions 

		selector.children().hide();

		$(".page"+options.currentPage).show();

		

		//first check if there is more than one page. If so, build nav

		if(pageCounter > 1) {

			

			//Build pager navigation

			var pageNav = "<div class='maindiv'><center><ul class='pageNav' style='width:auto; float:none;'>";	

			for (i=1;i<=pageCounter;i++){

				

								

				if (i==options.currentPage) 

				{

					pageNav += "<li class=currentPage pageNav"+i+"'><a rel='"+i+"'>"+i+"</a></li>";	

				}

				else 

				{

					pageNav += "<li class='pageNav"+i+"'><a rel='"+i+"'>"+i+"</a></li>";

				}

				

			}



			pageNav += "</ul></center></div>";

			

			if(options.holder == "") {

				selector.after(pageNav);

			}

			else {

				$(options.holder).append(pageNav);

			}

						

			//pager navigation behaviour

			$(".pageNav a").live("click", function() {			

				//grab the REL attribute 

				var clickedLink = $(this).attr("rel");

				options.currentPage = clickedLink;

				//remove current current (!) page

				$("li.currentPage").removeClass("currentPage");

				//Add current page highlighting

				$("ul.pageNav").find("a[rel='"+clickedLink+"']").parent("li").addClass("currentPage");

				//$(this).parent("li").addClass("currentPage");

				//hide and show relevant links				

				selector.children().hide();			

				selector.find(".page"+clickedLink).show();

				return false;

			});

			

		}

			  

	}

	



})(jQuery);

