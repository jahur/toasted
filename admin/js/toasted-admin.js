(function($) {
  "use strict";

  /**
   * All of the code for your admin-facing JavaScript source
   * should reside in this file.
   *
   * Note: It has been assumed you will write jQuery code here, so the
   * $ function reference has been prepared for usage within the scope
   * of this function.
   *
   * This enables you to define handlers, for when the DOM is ready:
   *
   * $(function() {
   *
   * });
   *
   * When the window is loaded:
   *
   * $( window ).load(function() {
   *
   * });
   *
   * ...and/or other possibilities.
   *
   * Ideally, it is not considered best practise to attach more than a
   * single DOM-ready or window-load handler for a particular page.
   * Although scripts in the WordPress core, Plugins and Themes may be
   * practising this, we should strive to set a better example in our own work.
   */
  
	$('.ekshop-sync-single').click(function(event){
	   console.log( $(this).attr('id') );
	   console.log( $(this).attr('data-ekprodid') );
	   event.preventDefault();
	   productSyncById($(this).attr('data-ekprodid'));
	   //jQuery(".ur-submit-button").click();
	   
	});

	function productSyncById(id){
		console.log('from single sync function: '+ id);
		jQuery("#eksid-"+id).addClass("rotating");
		//var productId = id;
		//hidden_first_name = jQuery("#hidden_first_name").val();
		
		
		//jQuery("#form_send_reg").text('Sending...');
		//jQuery( "#hidden_first_name_error, #hidden_last_name_error, #hidden_email_address_error, #phone_logged_in_error" ).empty();
		
		
		
		jQuery.ajax({
		  url: ajax_script_product_sync_by_id.ajax_url,
		  type: "post",
		  data: {
			action: "product_sync_by_id",
			id: id,
			//hidden_last_name: hidden_last_name,
			//hidden_email_address: hidden_email_address,
			//leaders_emails: leaders_emails,
			//phone_logged_in: phone_logged_in,
			//preferred_contact_method: preferred_contact_method,
			//entrytitle: entrytitle
		  },
		  success: function(response) {
			console.log(response);
			//jQuery("#ekshop_token").val(response);
			//jQuery("#second_form").empty();
			//jQuery("#second_form").html("<p class='success'>Thanks for your interest in this group. The group leader will be in touch</p>");
			jQuery("#eksid-"+id).removeClass("rotating");
			jQuery("#eksid-"+id).removeClass("dashicons-update");
			jQuery("#eksid-"+id).addClass("dashicons-yes-alt");
			//jQuery(".ajaxsaving").removeClass("progress");
			//prop_comp_site_url = jQuery("#prop_comp_site_url").val();
			//jQuery("#append_first_name_reg").html(response);
			// if (response != "notitle") {
			// } else if (response == "notitle") {
			//   jQuery("#titleerror").html("Enter title");
			// }
		  },
				  error: function(xhr, status, error) {
				   console.log(error);
				  }
		});

		
	
		return false;
	}

	$("#ekshop_product_sync").click(function(event) {
	event.preventDefault();
	productSync();
	console.log('sync button clicked');
	jQuery("#ekshop_product_sync").html("Syncing <i class='ekshop-sync-single  dashicons dashicons-update rotating' style='margin-top:5px;'></i>");
	//jQuery(".ur-submit-button").click();
	
	});

	function productSync(){
		jQuery.ajax({
			url: ajax_script_product_sync_func.ajax_url,
			type: "post",
			data: {
			  action: "product_sync_func",
			  hidden_first_name: 'this is from js file title',
			  /*hidden_last_name: hidden_last_name,
			  hidden_email_address: hidden_email_address,
				*/
			},
			success: function(response) {
				console.log(response);
				//jQuery("#ekshop_token").val(response);
				//jQuery("#ekshop_product_sync").empty();
				jQuery("#ekshop_product_sync").html("Sync done <i class='ekshop-sync-single  dashicons dashicons-yes-alt' style='margin-top:5px;'></i>");
			  //jQuery(".ajaxsaving").removeClass("progress");
			  //prop_comp_site_url = jQuery("#prop_comp_site_url").val();
			  jQuery("#response").html(response);
			  // if (response != "notitle") {
			  // } else if (response == "notitle") {
			  //   jQuery("#titleerror").html("Enter title");
			  // }
			},
					error: function(xhr, status, error) {
					 console.log(error);
					}
		  });
		  return false;

	}

   $("#ekshop_get_session").click(function(event) {
			event.preventDefault();
			sendRegFormData();
			console.log('token button clicked');
			//jQuery(".ur-submit-button").click();
			
		});
		
	function sendRegFormData(){
			//event.preventDefault();
			//jQuery(".ajaxsaving").addClass("progress");
			var entrytitle, hidden_first_name, hidden_last_name, hidden_email_address, leaders_emails, phone_logged_in, message_logged_in, preferred_contact_method;
			/*entrytitle = jQuery(".entry-title").text();
			hidden_first_name = jQuery("#hidden_first_name").val();
			hidden_last_name = jQuery("#hidden_last_name").val();
			hidden_email_address = jQuery("#hidden_email_address").val();
			leaders_emails = jQuery("#leaders_emails").val();
			phone_logged_in = jQuery("#phone_logged_in").val();
			//message_logged_in = jQuery("#message_logged_in").val();
			preferred_contact_method = jQuery("#preferred_contact_method").val();*/
			
			//jQuery("#form_send_reg").text('Sending...');
            //jQuery( "#hidden_first_name_error, #hidden_last_name_error, #hidden_email_address_error, #phone_logged_in_error" ).empty();
			jQuery.ajax({
			  url: ajax_script_get_access_token.ajax_url,
			  type: "post",
			  data: {
				action: "get_access_token",
				hidden_first_name: 'this is from js file title',
				/*hidden_last_name: hidden_last_name,
				hidden_email_address: hidden_email_address,
				leaders_emails: leaders_emails,
				phone_logged_in: phone_logged_in,
				preferred_contact_method: preferred_contact_method,
				entrytitle: entrytitle*/
			  },
			  success: function(response) {
				  console.log(response);
				  jQuery("#ekshop_token").html(response);
				  //jQuery("#second_form").empty();
				  //jQuery("#second_form").html("<p class='success'>Thanks for your interest in this group. The group leader will be in touch</p>");
				//jQuery(".ajaxsaving").removeClass("progress");
				//prop_comp_site_url = jQuery("#prop_comp_site_url").val();
				//jQuery("#append_first_name_reg").html(response);
				// if (response != "notitle") {
				// } else if (response == "notitle") {
				//   jQuery("#titleerror").html("Enter title");
				// }
			  },
                      error: function(xhr, status, error) {
                       console.log(error);
                      }
			});
		
			return false;
		}
  /*
  $("#brand-aug-dist").change(function() {
    var optionUrl = $(this).val();
    $("#brand-aug-dist-config").attr("href", optionUrl);
    console.log(a);
  });

  $(function() {
    $(".copytext").click(function() {
      //$(".allowCopy").focus();
      $(".allowCopy").select();
      document.execCommand("copy");
      $(this).text("Copied");
    });
  });
  */
  
})(jQuery);

