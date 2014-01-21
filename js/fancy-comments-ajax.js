jQuery(document).bind('mousemove', function(e)
	{	
	
	
		var kfc_popup_top = parseInt(jQuery("#kfc-popup-top").text());

		jQuery('#fancy-comments').css({
               left:  e.pageX,
               top:   e.pageY+kfc_popup_top,
			});
	});

jQuery(document).ready(function(jQuery)
	{	
			
			
			var kfc_select_class = jQuery("#kfc-select-class").text();
		
			
			jQuery(kfc_select_class+" article").mouseleave(function(){
				
					jQuery(".fancy-comments").css("display","none");
					jQuery(this).css("background-color","");
				});

			jQuery(kfc_select_class+" article").mouseenter(function()
				{
					
					var hue = 'rgb('
								+ (Math.floor((Math.random()*200)+100)) + ','
								+ (Math.floor((Math.random()*200)+100)) + ','
								+ (Math.floor((Math.random()*200)+100)) + ')';

					
					jQuery(this).css("background-color",hue);
					jQuery(this).css("cursor","pointer");
					jQuery(".fancy-comments").css("display","block");
					
					
					
					
					
					var comment_id = jQuery(this).attr("id");
					var comment_id = comment_id.replace(/[A-Za-z$-]/g, "");

					jQuery.ajax(
						{
					type: 'POST',
					url: fancy_comments_ajax.fancy_comments_ajaxurl,
					data: {"action": "fancy_comments", "comment_id":comment_id},
					success: function(data)
							{	
								
								jQuery(".fancy-comments").html(data);
								
							}
						});


				});	

	});