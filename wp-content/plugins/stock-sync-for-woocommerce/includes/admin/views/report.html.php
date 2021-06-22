<?php global $title; ?>

<div class="wrap" id="woo-stock-sync-report">
  <h1 class="wp-heading-inline"><?php echo $title; ?></h1>
  <hr class="wp-header-end">

  <?php include 'tabs.html.php'; ?>

  <?php if ( wss_is_primary() ) { ?>
    <?php if ( $limit_reached && ! class_exists( 'Woo_Stock_Sync_Pro' ) ) { ?>
      <div class="error woo-stock-sync-limit-reached-error">
        <p><?php printf( __( 'Stock Sync for WooCommerce supports only 100 products and variations. You have %d products. Please upgrade to <a href="https://wooelements.com/products/stock-sync-pro" target="_blank">the Pro version</a> for full functionality.', 'woo-stock-sync' ), $product_count ); ?></p>
      </div>
    <?php } ?>

    <div id="woo-stock-sync-report-app">
      <form id="woo-stock-sync-filter" method="get">
        <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />

        <div class="tablenav">
          <div class="wss-product-search">
            <input name="wss_product_search" type="search" class="post-search-input" value="<?php echo esc_attr( $search_query ); ?>" placeholder="<?php esc_attr_e( 'Search for products', 'woo-stock-sync' ); ?>" />

            <input type="submit" name="filter_action" id="post-query-submit" class="button" value="<?php esc_attr_e( 'Search', 'woo-stock-sync' ); ?>">
          </div>

          <?php echo $pagination; ?>
        </div>

        <table class="wp-list-table widefat fixed striped table-view-list">
          <thead>
            <tr>
              <th><?php _e( 'Product (SKU)', 'woo-stock-sync' ); ?></th>
              <th><?php _e( 'Stock Quantity', 'woo-stock-sync' ); ?></th>
              <?php foreach ( $sites as $site ) { ?>
                <th><?php echo wss_format_site_url( $site['url'], true ); ?></th>
              <?php } ?>
              <th><?php _e( 'Actions', 'woo-stock-sync' ); ?></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="product in products">
              <td><span v-html="product.title"></span></td>
              <td>
                <span class="stock-qty">{{ product.qty }}</span>

                <?php do_action( 'woo_stock_sync_after_product_qty' ); ?>
              </td>
              <td v-for="site in sites">
                <span v-if="! product.site_qtys[site.key].processing">
                  <a v-if="product.site_qtys[site.key].url" :href="product.site_qtys[site.key].url" target="_blank">{{ product.site_qtys[site.key].qty }}</a>
                </span>
                <span v-if="! product.site_qtys[site.key].processing && ! product.editing_qty && product.site_qtys[site.key].qty != product.qty && product.site_qtys[site.key].qty" class="wss-icon warning"></span>
                <span v-if="product.site_qtys[site.key].processing" class="wss-icon process"></span>
              </td>
              <td>
                <a href="#" v-on:click.prevent="pushQtys( product )" class="button" v-bind:disabled="! product.sku || ! product.managing_stock"><?php _e( 'Push', 'woo-stock-sync' ); ?></a>
                <span class="wss-icon completed" v-if="product.status === 'completed'"></span>
                <span class="wss-icon process" v-if="product.status === 'processing'"></span>
              </td>
            </tr>
          </tbody>
        </table>

        <div class="last-updated">
          <?php printf( __( 'Last updated: %s.', 'woo-stock-sync' ), $last_updated ); ?>
          <a href="<?php echo $urls['update']; ?>"><?php _e( 'Update now &raquo;', 'woo-stock-sync' ); ?></a>
        </div>
      </form>
    </div>
  <?php } else { ?>
    <p><?php printf( __( 'Please view report in <a href="%s" target="_blank">the Primary Inventory site.</a>', 'woo-stock-sync' ), wss_primary_report_url() ); ?></p>
  <?php } ?>
</div>

<script>
  if ( jQuery( '#woo-stock-sync-report-app' ).length > 0 ) {
    var app = new Vue( {
      el: '#woo-stock-sync-report-app',
      data: {
        status: 'pending',
        sites: <?php echo json_encode( array_values( $sites ) ); ?>,
        products: <?php echo json_encode( $products_json ); ?>,
      },
      methods: {
        /**
         * Push quantity to external sites
         */
        pushQtys: function( product ) {
          if ( ! product.sku || ! product.managing_stock ) {
            alert( "Product doesn't have SKU or it's not managing stock!" );
            return;
          }

          var self = this;

          this.pushQty( product, 0 );
        },
        /**
         * Push quantity to external sites
         */
        pushQty: function( product, siteIndex ) {
          var self = this;
          var site = this.sites[siteIndex];
          var siteKey = site['key'];

          jQuery.ajax( {
            type: 'post',
            url: woo_stock_sync.ajax_urls.push,
            data: {
              product_id: product.id,
              site_key: siteKey,
            },
            dataType: 'json',
            beforeSend: function() {
              product.site_qtys[siteKey].processing = true;
              product.status = 'default';
            },
            success: function( response ) {
              product.site_qtys[siteKey].processing = false;

              if ( response.status ) {
                product.site_qtys[siteKey].qty = response.qty;
              } else {
                alert( response.errors.join( "\n" ) );
              }

              if ( ( siteIndex + 1 ) < self.sites.length ) {
                self.pushQty( product, ( siteIndex + 1 ) );
              } else {
                product.status = 'completed';
              }
            },
            error: function() {
              alert( 'Unknown error' );
            },
            complete: function() {
            }
          } );
        },
        /**
         * Edit stock quantity
         */
        editQty: function( product ) {
          product.editing_qty = true;
        },
        /**
         * Refresh product data
         */
        refreshProduct: function( product, retryCount ) {
          var self = this;

          jQuery.ajax( {
            type: 'get',
            url: woo_stock_sync.ajax_urls.get_product,
            data: {
              product_id: product.id,
            },
            dataType: 'json',
            beforeSend: function() {
            },
            success: function( response ) {
              var shouldRetry = false;
              _.each( response.site_qtys, function( data, index ) {
                if ( data.qty == product.qty || data.not_found ) {
                  product.site_qtys[index] = data;
                } else {
                  shouldRetry = true;
                }
              } );

              if ( shouldRetry && retryCount < 5 ) {
                setTimeout( function() {
                  self.refreshProduct( product, retryCount + 1 );
                }, 750 );
              } else {
                product.site_qtys = response.site_qtys;
              }
            },
            error: function() {
              alert( 'Unknown error' );
            },
            complete: function() {
            }
          } );
        },
        /**
         * Update stock quantity
         */
        updateQty: function( product ) {
          var self = this;

          jQuery.ajax( {
            type: 'post',
            url: woo_stock_sync.ajax_urls.update_qty,
            data: {
              product_id: product.id,
              qty: product.qty,
            },
            dataType: 'json',
            beforeSend: function() {
              product.status_qty = 'processing';
              product.editing_qty = false;

              _.each( product.site_qtys, function( data ) {
                data.processing = true;
              } );
            },
            success: function( response ) {
              if ( response.status ) {
                product.qty = response.qty;

                setTimeout( function() {
                  self.refreshProduct( product, 0 );
                }, 1000 );
              } else {
                alert( response.errors.join( "\n" ) );
              }

              product.status_qty = 'completed';
            },
            error: function() {
              alert( 'Unknown error' );
            },
            complete: function() {
            }
          } );
        }
      },
      created: function() {
      },
      mounted: function() {
      }
    } );
  }
</script>