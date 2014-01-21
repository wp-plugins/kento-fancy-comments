<?php
		if($_POST['kfc_hidden'] == 'Y') {
			//Form data sent
			$kfc_popup_top = $_POST['kfc_popup_top'];
			update_option('kfc_popup_top', $kfc_popup_top);
			$kfc_select_class = $_POST['kfc_select_class'];
			update_option('kfc_select_class', $kfc_select_class);			
			?>
			<div class="updated"><p><strong><?php _e('Changes Saved.' ); ?></strong></p>
            </div>
			<?php
		} else {
			//Normal page display
			$kfc_popup_top = get_option( 'kfc_popup_top' );
			$kfc_select_class = get_option( 'kfc_select_class' );			

		}
?>
<div class="wrap">
	<div id="icon-tools" class="icon32"><br></div><?php echo "<h2>".__('Kento Fancy Comments Settings')."</h2>";?>
		<form  method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	<input type="hidden" name="kfc_hidden" value="Y">
        <?php settings_fields( 'kento_fancy_comments_plugin_options' );
				do_settings_sections( 'kento_fancy_comments_plugin_options' );
		?>

<table class="form-table">
               
	<tr valign="top">
		<th scope="row">Popup box top position on hover</th>
		<td style="vertical-align:middle;">                     
                     <input type="text" name="kfc_popup_top" id="kfc-popup-top"  value ="<?php if ( isset( $kfc_popup_top ) ) echo $kfc_popup_top; ?>">px
		</td>
	</tr>
                
	<tr valign="top">
		<th scope="row">Select CSS class of comment-list</th>
		<td style="vertical-align:middle;">                     
                     <input type="text" name="kfc_select_class" id="kfc-select-class"  value ="<?php if ( isset( $kfc_select_class ) ) echo $kfc_select_class; ?>">Please add CSS class or id (. or #) dot or hash before class name.
		</td>
	</tr>


</table>
                <p class="submit">
                    <input class="button button-primary" type="submit" name="Submit" value="<?php _e('Save Changes' ) ?>" />
                </p>
		</form>

   
</div>
