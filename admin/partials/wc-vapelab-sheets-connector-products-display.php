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

if ($pagenow == 'admin.php' && $_GET['page'] == 'wc-vapelab-sheets-connector') {
    if (isset($_GET['tab'])) {
        $tab = $_GET['tab'];
    } else {
        $tab = 'products';
    }

    global $wc_vapelab_sheets_connector_errors; ?>

   <?php if(!empty($wc_vapelab_sheets_connector_errors)):?>
   <div class="notice notice-error">
   <?php foreach($wc_vapelab_sheets_connector_errors as $err):?>
      <p>
         <strong>Error</strong>: <?php echo $err['message']?>
      </p>
   <?php endforeach;?>
   </div>
   <?php endif;?>
   
 
   <table class="form-table">
   <tr>
      <th>Active</th>
      <td class="forminp forminp-select">
         <select  name="enable_products_sheet"  style="width:400px" tabindex="-1" aria-hidden="true" >
            <option <?php selected($enabled) ?> value="yes">Yes</option>
            <option <?php selected($enabled,false) ?> value="no">No</option>
         </select>
      </td>
   </tr>
   
   <?php if($enabled) :?>
      <tr>
            <th scope="row">Group</th>
            <td class="forminp forminp-checkbox">
               <fieldset>

                  <label for="woocommerce_calc_taxes">
                     <input <?php checked($settings['products_spreadsheet_group_by_categories'], 'yes') ?>name="products_spreadsheet_group_by_categories" type="checkbox" value="yes"> Group by category. </label>
               </fieldset>
            </td>
        </tr>
   <tr>
            <th scope="row">Spreadsheet ID</th>
            <td class="forminp forminp-text">
                <input style="width:400px" name="wcvlshcon_products[spreadsheet_id]" type="text" value="<?php echo esc_html(stripslashes($settings["spreadsheet_id"])); ?>" class="" placeholder="">
                <br>
                <button style="margin-top:5px" type="submit" name="action" class="button" value="wc_products_sheets_vapelab_create_spreadsheet">Create Spreadsheet</button>
            </td>
        </tr>
        <?php if(!is_null($spreadsheet_id) && !empty($spreadsheet_id)) :?>
        
        <tr>
            <th scope="row">Sheet</th>
            <td class="forminp forminp-text">
            <select  name="wcvlshcon_products[sheet_id]" style="width:400px" tabindex="-1" aria-hidden="true" <?php disabled(!$sheets_arr) ?>>
                  <option value="">Select a sheet</option>
                  <?php foreach($sheets_arr as $sheet):?>
                     <option <?php selected($sheet['id'], $settings["sheet_id"]) ?> value="<?php echo $sheet['id'].":".$sheet['title'] ?>" ><?php echo $sheet['label']?></option>
                  <?php endforeach;?>
            </select>
                
            </td>
        </tr>

        <tr valign="top" class="show_options_if_checked">
   <th scope="row" class="titledesc">
   <h2>Actions</h2></th>
        <tr>
            <th scope="row">Update Sheet</th>
            <td><button type="submit" name="action" class="button" value="wc_products_sheets_vapelab_update_spreadsheet">Run</button></td>
        </tr>
        <tr>
            <th scope="row">Update Woo</th>
            <td><button type="submit" name="action" class="button" value="wc_products_sheets_vapelab_update_woo">Run</button></td>
        </tr>
        <?php endif;?>
        <?php endif;?>
        <!--
        <tr>
            <th scope="row">Update Woo From Sheets</th>
            <td><button type="submit" name="action" class="button" value="orders_update_woo">Run</button></td>
        </tr>
            -->

   
   
   <?php echo '</table>';
}

?>
<p class="submit" style="clear: both;">
      <input type="submit" name="submit_poroducts_tab"  class="button-primary" value="Update Settings" />
   </p>
</form>
