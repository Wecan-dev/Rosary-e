<tr valign="top">
  <td class="forminp forminp-<?php echo esc_attr( sanitize_title( $value['type'] ) ); ?>" colspan="2">
    <table class="form-table wp-list-table widefat fixed">
      <thead>
        <tr>
          <th class="min"><?php _e( '#', 'woo-stock-sync' ); ?></th>
          <th><?php _e( 'URL', 'woo-stock-sync' ); ?></th>
          <th><?php _e( 'API Key', 'woo-stock-sync' ); ?></th>
          <th><?php _e( 'API Secret', 'woo-stock-sync' ); ?></th>
          <th><?php _e( 'Check', 'woo-stock-sync' ); ?></th>
        </tr>
      </thead>
      <tbody>
        <?php for ( $i = 0; $i < $value['sites']; $i++ ) { ?>
          <tr>
            <td class="min">
              <?php echo $i + 1; ?>
            </td>
            <td>
              <input
                type="text"
                class="woo-stock-sync-url"
                name="<?php echo woo_stock_sync_api_credentials_field_name( 'woo_stock_sync_url', $i ); ?>"
                value="<?php echo woo_stock_sync_api_credentials_field_value( 'woo_stock_sync_url', $i ); ?>"
              />
            </td>
            <td>
              <input
                type="text"
                class="woo-stock-sync-api-key"
                name="<?php echo woo_stock_sync_api_credentials_field_name( 'woo_stock_sync_api_key', $i ); ?>"
                value="<?php echo woo_stock_sync_api_credentials_field_value( 'woo_stock_sync_api_key', $i ); ?>"
              />
            </td>
            <td>
              <input
                type="text"
                class="woo-stock-sync-api-secret"
                name="<?php echo woo_stock_sync_api_credentials_field_name( 'woo_stock_sync_api_secret', $i ); ?>"
                value="<?php echo woo_stock_sync_api_credentials_field_value( 'woo_stock_sync_api_secret', $i ); ?>"
              />
            </td>
            <td>
              <a href="#" class="woo-stock-sync-check-credentials"><?php _e( 'Check credentials', 'woo-stock-sync' ); ?></a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </td>
</tr>
