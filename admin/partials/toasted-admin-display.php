

<form action='options.php' method='post'>

	<div class="toasted_wrap">
		<div id="toasted-services-block">
			<?php
				settings_fields( 'toasted_options' );

				do_settings_sections( 'toasted_options' );

				submit_button( __('Save', 'toasted') , "button-primary");
			?>

		</div>		
	</div>
</form>



