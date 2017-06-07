<?php if($ocquickview_status == 1): ?>
<div id="quickview-content">
    <!-- Load quickview content into here -->
</div>

<div id="quickview-bg-block">
    <!-- Quick View deep background -->
</div>

<div class="quickview-load-img">
    <img src="<?php echo $ocquickview_loader_img; ?>" alt="" />
</div>

<div>
	<input type="hidden" id="qv-status" value="<?php echo $ocquickview_status; ?>" />
	<input type="hidden" id="qv-container" value="<?php echo $ocquickview_container ?>" />
	<input type="hidden" id="qv-parent-element" value="<?php echo $ocquickview_parent_element ?>" />
	<input type="hidden" id="qv-children-element" value="<?php echo $ocquickview_children_element ?>" />
	<input type="hidden" id="qv-text-quickview" value="<?php echo $text_quickview ?>" />
</div>

<script type="text/javascript">
	$('#quickview-bg-block').click(function () {
		ocquickview.closeQVFrame();
	})
</script>
<?php endif; ?>