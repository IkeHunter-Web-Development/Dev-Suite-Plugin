<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Cobolt
 * @subpackage Cobolt/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
  <h1>Development Suite</h1>
  
  <form action="options.php" method="post">
    <?php
      settings_fields('cobolt_settings');
      do_settings_sections('cobolt_settings');
      submit_button();
    ?>
  </form>
</div>
