jQuery(document).ready(function($){
	/*
	 * Replace default block classes with boostrap classes
	 */
	"use strict";
		
		jQuery('.aq-block').each(function(){
		
			if (jQuery(jQuery(this)).hasClass('aq_span2')) {
				jQuery(this).removeClass('aq_span2');
				jQuery(this).addClass('col-md-2');
			}
			
			else if (jQuery(this).hasClass('aq_span3')) {
				jQuery(this).removeClass('aq_span3');
				jQuery(this).addClass('col-md-3');
			}
			
			else if (jQuery(this).hasClass('aq_span4')) {
				jQuery(this).removeClass('aq_span4');
				jQuery(this).addClass('col-md-4');
			}
			
			else if (jQuery(this).hasClass('aq_span5')) {
				jQuery(this).removeClass('aq_span5');
				jQuery(this).addClass('col-md-5');
			}
			
			else if (jQuery(this).hasClass('aq_span6')) {
				jQuery(this).removeClass('aq_span6');
				jQuery(this).addClass('col-md-6');
			}		
			
			else if (jQuery(this).hasClass('aq_span7')) {
				jQuery(this).removeClass('aq_span7');
				jQuery(this).addClass('col-md-7');
			}
			
			else if (jQuery(this).hasClass('aq_span8')) {
				jQuery(this).removeClass('aq_span8');
				jQuery(this).addClass('col-md-8');
			}
			
			else if (jQuery(this).hasClass('aq_span9')) {
				jQuery(this).removeClass('aq_span9');
				jQuery(this).addClass('col-md-9');
			}
			
			else if (jQuery(this).hasClass('aq_span10')) {
				jQuery(this).removeClass('aq_span10');
				jQuery(this).addClass('col-md-10');
			}
			
			else if (jQuery(this).hasClass('aq_span11')) {
				jQuery(this).removeClass('aq_span11');
				jQuery(this).addClass('col-md-11');
			}
			
			else if (jQuery(this).hasClass('aq_span12')) {
				jQuery(this).removeClass('aq_span12');
				jQuery(this).addClass('col-md-12');
			}
		});
		
		// Add classes to the team block
		jQuery('.aq-block-ptf_team_block').each(function() {
			
			jQuery(this).addClass('col-sm-6');
			
		});
		
});