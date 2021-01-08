<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<header id="cfw-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div id="cfw-logo-container">
                    <!-- TODO: Find a way to inject certain backend settings as global params without having to put logic in the templates -->
                    <div class="cfw-logo">
                        <a title="<?php echo get_bloginfo( 'name' ); ?>" href="<?php echo apply_filters( 'cfw_header_home_url', get_home_url() ); ?>" class="logo"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
