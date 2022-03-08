<?php
/**
 * Provide a admin area view for the plugin
 * This file is used to markup the admin-facing aspects of the plugin.
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<form action='options.php' method='post'>

	<div class="toasted_wrap">

	<div id="toasted-services-block">
		<?php

		settings_fields( 'toasted_preview' );

		do_settings_sections( 'toasted_preview' );

		submit_button( __('Apply', 'toasted') , "default");


		?>
		
	</div>
	
	</div>

	</form>

