<?php global $title; ?>

<div class="wrap" id="woo-stock-sync-report">
  <h1 class="wp-heading-inline"><?php echo $title; ?></h1>
  <hr class="wp-header-end">

  <?php include 'tabs.html.php'; ?>

  <?php if ( wss_is_secondary() ) { ?>
    <div class="wss-alert">
      <?php printf( __( 'This is a log for Secondary Inventory and only contains failed communication with Primary Inventory. For complete log please view <a href="%s" target="_blank">Primary Inventory Log</a>.', 'woo-stock-sync' ), wss_primary_report_url( 'log' ) ); ?>
    </div>
  <?php } ?>

  <form method="get">
    <div class="tablenav">
      <div class="alignleft actions">
        <input type="hidden" name="page" value="woo-stock-sync-report" />
        <input type="hidden" name="action" value="log" />

        <select class="wc-product-search" name="product_id" data-action="woocommerce_json_search_products_and_variations" data-placeholder="<?php esc_attr_e( 'Filter by product', 'woo-stock-sync' ); ?>" style="min-width:200px;">
          <?php if ( $filter_by_product_id ) { ?>
            <option value="<?php echo $filter_by_product_id; ?>"><?php echo $filter_by_product->get_formatted_name(); ?></option>
          <?php } ?>
        </select>

        <input type="submit" name="filter_action" id="post-query-submit" class="button" value="<?php esc_attr_e( 'Filter', 'woo-stock-sync' ); ?>">
      </div>
    
      <?php echo $pagination; ?>
    </div>

    <table class="wp-list-table widefat fixed striped table-view-list wss-log-table">
      <thead>
        <tr>
          <th><?php _e( 'Message', 'woo-stock-sync' ); ?></th>
          <th><?php _e( 'Date', 'woo-stock-sync' ); ?></th>
          <th><?php _e( 'Source', 'woo-stock-sync' ); ?></th>
          <th><?php _e( 'Synced', 'woo-stock-sync' ); ?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ( $logs as $log ) { ?>
          <tr class="type-<?php echo $log->type; ?>">
            <td>
              <?php echo $log->message; ?>
            </td>
            <td>
              <?php echo wss_format_datetime( strtotime( $log->created_at ) ); ?>
            </td>
            <td>
              <?php if ( isset( $log->data->source ) ) { ?>
                <?php if ( isset( $log->data->source_url ) ) { ?>
                  <a href="<?php echo $log->data->source_url; ?>" target="_blank">
                <?php } ?>
                  <?php echo wss_format_site_url( $log->data->source ); ?>

                  <?php if ( isset( $log->data->source_desc ) ) { ?>
                    <?php echo $log->data->source_desc; ?>
                  <?php } ?>

                <?php if ( isset( $log->data->source_url ) ) { ?>
                  </a>
                <?php } ?>
              <?php } ?>
            </td>
            <td>
              <?php
                $sync_results = [];
                if ( isset( $log->data->sync_results ) ) {
                  $sync_results = (array) $log->data->sync_results;
                }
              ?>
              <?php if ( ! empty( $sync_results ) ) { ?>
                <?php foreach ( $sites as $i => $site ) { ?>
                  <?php if ( isset( $sync_results[$site['key']] ) ) { ?>
                    <?php if ( $sync_results[$site['key']]->result ) { ?>
                      <span
                        class="wss-sync-result wss-tip sync-result-success"
                        data-tip="<?php printf( esc_attr__( 'OK: %s', 'woo-stock-sync' ), wss_format_site_url( $site['url'] ) ); ?>"
                      >
                        <?php echo $i + 1; ?>
                      </span>
                    <?php } else { ?>
                      <?php if ( count( (array) $sync_results[$site['key']]->errors ) === 1 && isset( $sync_results[$site['key']]->errors->not_found ) ) { ?>
                        <span
                          class="wss-sync-result wss-tip sync-result-warning"
                          data-tip="<?php printf( esc_attr__( 'Failed: %s. Errors: %s', 'woo-stock-sync' ), wss_format_site_url( $site['url'] ), implode( "\n", (array) $sync_results[$site['key']]->errors ) ); ?>"
                        >
                          <?php echo $i + 1; ?>
                        </span>
                      <?php } else { ?>
                        <span
                          class="wss-sync-result wss-tip sync-result-error"
                          data-tip="<?php printf( esc_attr__( 'Failed: %s. Errors: %s', 'woo-stock-sync' ), wss_format_site_url( $site['url'] ), implode( "\n", (array) $sync_results[$site['key']]->errors ) ); ?>"
                        >
                          <?php echo $i + 1; ?>
                        </span>
                      <?php } ?>
                    <?php } ?>
                  <?php } else { ?>
                    <span
                      class="wss-sync-result wss-tip sync-result-na"
                      data-tip="<?php printf( esc_attr__( 'Not available: %s', 'woo-stock-sync' ), wss_format_site_url( $site['url'] ) ); ?>"
                    >
                      <?php echo $i + 1; ?>
                    </span>
                  <?php } ?>
                <?php } ?>
              <?php } else { ?>
                <?php _e( 'N/A', 'woo-stock-sync' ); ?>
              <?php } ?>
            </td>
          </tr>
        <?php } ?>
        <?php if ( empty( $logs ) ) { ?>
          <?php if ( ! $log_table_exists ) { ?>
            <tr>
              <td colspan="4"><?php printf( __( 'Database table for logs doesn\'t exist! <a href="%s">Create it &raquo;</a>', 'woo-stock-sync' ), $urls['create_log_table'] ); ?></td>
            </tr>
          <?php } else { ?>
            <tr>
              <td colspan="4"><?php _e( 'No log messages.', 'woo-stock-sync' ); ?></td>
            </tr>
          <?php } ?>
        <?php } ?>
      </tbody>
    </table>
    <div class="wss-descs">
      <?php foreach ( $sites as $i => $site ) { ?>
        <span class="desc"><span class="wss-sync-result sync-result-success"><?php echo $i + 1; ?></span>&nbsp;<?php echo wss_format_site_url( $site['url'] ); ?></span>
      <?php } ?>
    </div>

    <div class="wss-descs">
      <span class="desc"><span class="wss-sync-result sync-result-success"></span> Successful sync</span>
      <span class="desc"><span class="wss-sync-result sync-result-warning"></span> Product not found</span>
      <span class="desc"><span class="wss-sync-result sync-result-error"></span> Error occurred during syncing</span>
    </div>
  </div>
</div>