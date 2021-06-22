jQuery(document).ready(function($){
  $( document.body ).trigger( 'wc-enhanced-select-init' );

  $( '.wss-tip' ).tipTip( {
    'attribute': 'data-tip',
    'fadeIn': 50,
    'fadeOut': 50,
    'delay': 200
  } );

  var wooStockSyncSettings = {
    init: function() {
      this.triggerCredentialCheck();
      this.triggerSettingsUpdate();
    },

    /**
     * Save form when changing certain settings
     */
    triggerSettingsUpdate: function() {
      $( 'select#woo_stock_sync_role' ).change( function( e ) {
        var form = $( this ).closest( 'form' );

        $( 'button[name="save"]', form ).click();
      } );
    },

    triggerCredentialCheck: function() {
      var self = this;

      $( document ).on( 'click', 'a.woo-stock-sync-check-credentials', function(e) {
        e.preventDefault();
        self.checkCredentials( $( this ).closest( 'tr' ) );
      } );
    },

    checkCredentials: function( row ) {
      var self = this;
      var checkButton = $( 'a.woo-stock-sync-check-credentials', row );

      var data = {
        'action': 'woo_stock_sync_check_api_access',
        'url': $( 'input.woo-stock-sync-url', row ).val(),
        'key': $( 'input.woo-stock-sync-api-key', row ).val(),
        'secret': $( 'input.woo-stock-sync-api-secret', row ).val(),
      };

      this.showCheckProcessing( checkButton );

      jQuery.post(ajaxurl, data)
      .done(function(response) {
        responseData = jQuery.parseJSON(response);
        if ( responseData.success ) {
          self.showCheckSuccess( checkButton, woo_stock_sync.check_credentials_success );
        } else {
          self.showCheckFail( checkButton, responseData.error );
        }
      })
      .fail(function(response) {
        alert( 'Error checking API credentials' );
      })
      .always(function(response) {
      });
    },

    showCheckProcessing: function( el ) {
      $( 'span.woo-stock-sync-check-credentials-indicator' ).remove();
      el.after( '<span class="woo-stock-sync-check-credentials-indicator woo-stock-sync-check-credentials-processing"></span>' );
    },

    showCheckSuccess: function( el, successMsg ) {
      $( 'span.woo-stock-sync-check-credentials-indicator' ).remove();
      el.after( '<span class="woo-stock-sync-check-credentials-indicator woo-stock-sync-check-credentials-success">' + successMsg + '</span>' );
    },

    showCheckFail: function( el, errorMsg ) {
      $( 'span.woo-stock-sync-check-credentials-indicator' ).remove();
      el.after( '<span class="woo-stock-sync-check-credentials-indicator woo-stock-sync-check-credentials-fail">' + errorMsg +'</span>' );
    },
  };

  wooStockSyncSettings.init();
});
