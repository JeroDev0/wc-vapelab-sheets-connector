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

<form method="post" action="<?php admin_url( '?page=wc-vapelab-sheets-connector' ); ?>" enctype="multipart/form-data">
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
   
   <h2>Credentials</h2>
   <table class="form-table">
   <tr>
            <th scope="row">Credentials JSON</th>
            <td class="forminp forminp-text">
                <input name="wcvlshcon_credentials_json_url" type="file" value="<?php echo esc_html(stripslashes($settings["credentials_json_url"])); ?>" class="" placeholder="">
            </td>
        </tr>
        <?php if(isset($authUrl)): ?>
            <tr>
            <th scope="row">Authotization</th>
            <td class="forminp forminp-text">
                <a class="button" target="_blank" href="<?php echo $authUrl?>">Authorize</button></td>
            </td>
            </tr>
        <?php endif;?>   
   
   <?php echo '</table>';
}

?>
<p class="submit" style="clear: both;">
      <input type="submit" name="submit_connection_tab"  class="button-primary" value="Update Settings" />
   </p>
</form>
