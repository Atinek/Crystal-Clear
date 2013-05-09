$(document).ready(function(e) {
	$('.featureCnt ul li:last-child').css('margin','0');
	$('.footerWrapper > ul > li').last().css('background','none')
	
	Cufon.replace('.sidebarHeading > h3',{ fontFamily: 'Franklin Gothic Book', hover: true});
	Cufon.replace('.menu a',{ fontFamily: 'Franklin Gothic Medium Cond',  hover: true});
	
	
	
	// Equal height plugin 
	
	var highestBox = 0;
        $('.contentLeft ').each(function(){  
                if($(this).height() > highestBox){  
                highestBox = $(this).height();  
				if( highestBox < 300)
				{
					highestBox += 10;	
				} 
			}
		});    
	//$('.containerMain > .colLeft').height(highestBox);
	
	$('.contentMain > .sidebar').height(highestBox);
	
	$('.innerContentLeft ').each(function(){  
                if($(this).height() > highestBox){  
                highestBox = $(this).height();  
				if( highestBox < 300)
				{
					highestBox += 100;	
				} 
			}
		});    
	//$('.containerMain > .colLeft').height(highestBox);
	
	$('.innerContentLeft > .innerSidebar ').height(highestBox);
	
		
	
});
	