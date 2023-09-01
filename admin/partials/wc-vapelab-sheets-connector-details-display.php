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

<form method="post" action="<?php admin_url(
    "?page=wc-vapelab-sheets-connector"
); ?>">
<?php
wp_nonce_field("wc_vapelab_sheets_connector_settings");

if ($pagenow == "admin.php" && $_GET["page"] == "wc-vapelab-sheets-connector") {

    if (isset($_GET["tab"])) {
        $tab = $_GET["tab"];
    } else {
        $tab = "products";
    }
    echo "<h2>Details</h2>";
    echo '<table class="form-table">';
    ?> 

   <tr>
      <th>Active</th>
      <td class="forminp forminp-select">
         <select  name="enable_details_sheet"  style="width:400px" tabindex="-1" aria-hidden="true" >
            <option <?php selected($enabled); ?> value="yes">Yes</option>
            <option <?php selected($enabled, false); ?> value="no">No</option>
         </select>
      </td>
   </tr>
   <?php if ($enabled): ?>
   <tr>
      <th scope="row">Spreadsheet ID</th>
      <td class="forminp forminp-text">
            <input style="width:400px" name="wcvlshcon_details[spreadsheet_id]" type="text" value="<?php echo esc_html(
                stripslashes($settings["spreadsheet_id"])
            ); ?>" class="" placeholder="">
      </td>
   </tr>
   <?php if (!is_null($spreadsheet_id) && !empty($spreadsheet_id)): ?>
   <tr>
      <th scope="row">Main Sheet</th>
      <td class="forminp forminp-select">
      <select  name="wcvlshcon_details[main_sheet_id]" style="width:400px" tabindex="-1" aria-hidden="true" <?php disabled(
          !$sheets_arr
      ); ?>>
            <?php foreach ($sheets_arr as $sheet): ?>
               <option <?php selected(
                   $sheet["id"],
                   $settings["main_sheet_id"]
               ); ?> value="<?php echo $sheet["id"] .
     ":" .
     $sheet["title"]; ?>" ><?php echo $sheet["label"]; ?></option>
            <?php endforeach; ?>
      </select>
      </td>
   </tr>
   <tr>
      <th scope="row">Put variation name<br>in separated column</th>
      <td>
         <select  name="wcvlshcon_details[variation_column]"  style="width:400px" tabindex="-1" aria-hidden="true" >
            <option <?php selected($settings['variation_column'],"yes"); ?> value="yes">Yes</option>
            <option <?php selected($settings['variation_column'], "no"); ?> value="no">No</option>
         </select>
      </td>
   </tr>      
   <tr>
      <th scope="row"> Product Name Delimiter </th>
      <td class="forminp forminp-text">
      <input style="width:400px" name="wcvlshcon_details[delimiter]" type="text" value="<?php echo esc_html(stripslashes($settings["delimiter"])); ?>" class="" placeholder="">
      </td>
   </tr>
            <tr valign="top" class="show_options_if_checked">
   <th scope="row" class="titledesc">
   <h2>Actions</h2></th>
            </tr>
            
        <tr>
            <th scope="row">Fix Metada Sheet</th>
            <td><button type="submit" name="action_submit" class="button" value="wc_details_fix_metadata">Run</button></td>
        </tr>
        <tr valign="top" class="show_options_if_checked">
      <th scope="row" class="titledesc">
         <h2>Download to sheet</h2>
      </th>
      </tr>
      <tr>
      <th scope="row">Order ID</th>
      <td class="forminp forminp-text">
         <input style="width:355px" name="action_submit_data[order_id]" type="text" value="" class="" placeholder="">
         <button type="submit" name="action_submit" class="button" value="wc_details_sync_by_id">Run</button>
      </td>
      <td></td>
      </tr>
      <tr>
      <th scope="row">Date range</th>
      <td class="forminp forminp-text">
         <input style="width:175px" name="action_submit_data[from]" type="date" value="" class="" placeholder="">
         <input style="width:175px" name="action_submit_data[to]" type="date" value="" class="" placeholder="">
         <button type="submit" name="action_submit" class="button" value="wc_details_sync_by_date">Run</button>
      </td>
      <td></td>
   </tr>
        <?php endif; ?>
        <?php endif; ?>
<?php echo "</table>";
}
?>
   <p class="submit" style="clear: both;">
        <input type="submit" name="submit_details_tab"  class="button-primary" value="Update Settings" />
   </p>
</form>
