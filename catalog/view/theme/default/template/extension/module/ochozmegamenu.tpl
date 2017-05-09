<div class="ma-nav-mobile-container visible-xs">
	<div class="hozmenu">
		<div class="navbar">
			<div id="navbar-inner" class="navbar-inner navbar-inactive">
                    <div class="menu-mobile">
                        <a class="btn btn-navbar navbar-toggle">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                        </a>
                        <span class="brand navbar-brand"><?php echo 'categories'; ?></span>
                    </div>
				
					<?php echo $_menu ?>
				
			</div>
		</div>
	</div>
</div>
<div class="nav-container visible-lg visible-md">

	<div class="nav1">
		<div class="nav2">
			<div id="pt_custommenu" class="pt_custommenu">
			<?php echo $hozmegamenu; ?>
			</div>
		</div>
	</div>

</div>
<script type="text/javascript">
//<![CDATA[
	var body_class = $('body').attr('class'); 
	if(body_class == 'common-home') {
		$('#pt_menu_home').addClass('act');
	}
	
var CUSTOMMENU_POPUP_EFFECT = <?php echo $effect; ?>;
var CUSTOMMENU_POPUP_TOP_OFFSET = <?php echo $top_offset ; ?>

//]]>
</script>