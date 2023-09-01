<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @since      1.0.0
 *
 * @package    WC_Vapelab_Sheets_Connector
 * @subpackage WC_Vapelab_Sheets_Connector/admin/partials
 */
?>

<form method="post" action="<?php admin_url( '?page=wc-vapelab-sheets-connector' ); ?>">
<?php
	
wp_nonce_field( "wc_vapelab_sheets_connector_settings" );

if ( $pagenow == 'admin.php' && $_GET['page'] == 'wc-vapelab-sheets-connector' ){

   if ( isset ( $_GET['tab'] ) ) $tab = $_GET['tab'];
   else $tab = 'products';
   echo '<h2>Connection</h2>';
   echo '<table class="form-table">'; ?> 

   <tr>
      <th>Active</th>
      <td class="forminp forminp-select">
         <select  name="enable_shippings_sheet"  style="width:400px" tabindex="-1" aria-hidden="true" >
            <option <?php selected($enabled) ?> value="yes">Yes</option>
            <option <?php selected($enabled,false) ?> value="no">No</option>
         </select>
      </td>
   </tr>
   <?php if($enabled) :?>
   <tr>
      <th scope="row">Spreadsheet ID</th>
      <td class="forminp forminp-text">
            <input style="width:400px" name="wcvlshcon_shippings[spreadsheet_id]" type="text" value="<?php echo esc_html( stripslashes( $settings["spreadsheet_id"] ) ); ?>" class="" placeholder="">
            <br>
            <button style="margin-top:5px" type="submit" name="action" class="button" value="wc_shippings_sheets_vapelab_create_spreadsheet">Create Spreadsheet</button>
      </td>
   </tr>
   <?php if(!is_null($spreadsheet_id) && !empty($spreadsheet_id)) :?>
   <tr>
      <th scope="row">Main Sheet</th>
      <td class="forminp forminp-select">
      <select  name="wcvlshcon_shippings[main_sheet_id]" style="width:400px" tabindex="-1" aria-hidden="true" <?php disabled(!$sheets_arr) ?>>
            <?php foreach($sheets_arr as $sheet):?>
               <option <?php selected($sheet['id'], $settings["main_sheet_id"]) ?> value="<?php echo $sheet['id'].":".$sheet['title'] ?>" ><?php echo $sheet['label']?></option>
            <?php endforeach;?>
      </select>
      </td>
   </tr>
   <tr>
      <th scope="row">Company ID</th>
      <td class="forminp forminp-select">
      <input style="width:400px" name="wcvlshcon_shippings[company_id]" type="text" value="<?php echo esc_html( stripslashes( $settings["company_id"] ) ); ?>" class="" >
      </td>
   </tr> 
   <tr>
      <th scope="row">Company Field</th>
      <td class="forminp forminp-select">
      <input style="width:400px" name="wcvlshcon_shippings[company_field]" type="text" value="<?php echo esc_html( stripslashes( $settings["company_field"] ) ); ?>" class="" >
      </td>
   </tr>             
   <tr valign="top" class="show_options_if_checked">
   <th scope="row" class="titledesc">
   <h2>Configuration</h2></th>
            </tr>
   <tr valign="top" class="show_options_if_checked">
                <th scope="row" class="titledesc">Move Automatically</th>
                <td class="forminp forminp-checkbox">
                    <fieldset>
                        <label for="wcosvl_enable_move_auto">
                            <input <?php checked( $settings["enable_move_auto"],'yes') ?> name="wcvlshcon_shippings[enable_move_auto]" type="checkbox" class="" value="<?php echo esc_html( stripslashes( $settings["enable_move_auto"] ) ); ?>"> Enable move automatically
                        </label>
                        <p class="description">Cron job will move WooCommerce shippings daily at 5 AM.</p>														
                    </fieldset>
                </td>
            </tr>
            <tr valign="top" class="show_options_if_checked">
                <th scope="row" class="titledesc">Sheet ID to move</th>
                <td class="forminp forminp-select">
                    <select  name="wcvlshcon_shippings[sheet_id_move]"  style="width:400px" tabindex="-1" aria-hidden="true" <?php disabled(!$sheets_arr) ?>>
                        <?php foreach($sheets_arr as $sheet):?>
                            <?php if($sheet['id'] != $settings['shippings_sheet_id']): ?>
                                <option <?php selected($sheet['id'], $settings["sheet_id_move"]) ?> value="<?php echo $sheet['id'].":".$sheet['title'] ?>" ><?php echo $sheet['label']?></option>
                            <?php endif;?>
                        <?php endforeach;?>
                    </select>
                </td>
            </tr>
            <tr valign="top" class="show_options_if_checked">
                <th scope="row" class="titledesc">Column target</th>
                <td class="forminp forminp-text">
                    <input style="width:400px" name="wcvlshcon_shippings[move_target_col]" type="text" style="" value="<?php echo esc_html( stripslashes( $settings["move_target_col"] ) ); ?>" class="" placeholder="eg. AJ"> 							
                </td>
            </tr>
            <tr valign="top" class="show_options_if_checked">
                <th scope="row" class="titledesc">Column content</th>
                <td class="forminp forminp-text">
                    <input style="width:400px" name="wcvlshcon_shippings[move_target_content]" type="text" style="" value="<?php echo esc_html( stripslashes( $settings["move_target_content"] ) ); ?>" class="" placeholder="eg. Mover"> 							
                </td>
            </tr>
            <tr valign="top" class="show_options_if_checked">
   <th scope="row" class="titledesc">
   <h2>Actions</h2></th>
            </tr>
            <tr>
            <th scope="row">Move Shippings Sheets</th>
            <td><button type="submit" name="wcosvl_action_submit" class="button" value="wc_shippings_sheets_vapelab_move_shippings_sheets">Run</button></td>
        </tr>
        <tr>
            <th scope="row">Fix Metada Sheet</th>
            <td><button type="submit" name="wcosvl_action_submit" class="button" value="wc_shippings_sheets_vapelab_fix_metadata_sheets">Run</button></td>
        </tr>
        <tr>
            <th scope="row">Order Sheet By Date</th>
            <td><button type="submit" name="wcosvl_action_submit" class="button" value="wc_shippings_sheets_vapelab_oder_sheet">Run</button></td>
        </tr>
        <?php endif;?>
        <?php endif;?>
<?php 
   echo '</table>';
}

?>
   <p class="submit" style="clear: both;">
        <input type="submit" name="submit_shippings_tab"  class="button-primary" value="Update Settings" />
   </p>
</form>

