<?php if ( isset( $tabs ) ) { ?>
	<nav class="nav-tab-wrapper woo-nav-tab-wrapper">
		<?php foreach ( $tabs as $tab ) { ?>
			<a href="<?php echo $tab['url']; ?>" class="nav-tab <?php echo $tab['active'] ? 'nav-tab-active' : ''; ?>"><?php echo $tab['title']; ?></a>
		<?php } ?>
	</nav>
<?php } ?>
