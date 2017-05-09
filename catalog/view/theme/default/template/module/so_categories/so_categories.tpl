<?php
	$uniqued = 'so_categories_' . rand() . time();
	if ($theme == 'theme4') {
	
?>
<script type="text/javascript">
		//<![CDATA[
		jQuery(document).ready(function ($) {
			;
			(function (element) {
				var $element = $(element);
				$(window).load(function () {
					$element.imagesLoaded(function () {
					});
				});
				$element.imagesLoaded(function () {

					$element.so_accordion({
						items: '.so-categories-inner',
						heading: '.so-categories-heading',
						content: '.so-categories-content',
						active_class: 'selected',
						event: '<?php echo $accmouseenter; ?>',
						delay: 300,
						duration: 500,
						active: '1'
					});

					var height_content = function () {
						$('.so-categories-inner', $element).each(function () {
							var $inner = $('.so-categories-content', $(this).filter('.selected'));
							$inner.css('height', 'auto');
							if ($inner.length) {
								var inner_height = $inner.height();
								$inner.css('height', inner_height);
							}
						});
					}
					$(window).resize(function () {
						height_content();
					});
					$(window).load(function () {
						height_content();
					});
				});
			})('#<?php echo $uniqued;?>')

		});
		//]]>

	</script>
<?php } ?>


<!--[if lt IE 9]>
<div id="<?php echo $uniqued; ?>"
     class="so-categories module <?php echo $theme; ?> <?php echo $deviceclass_sfx; ?> msie lt-ie9"><![endif]-->
<!--[if IE 9]>
<div id="<?php echo $uniqued; ?>"
     class="so-categories module <?php echo $theme; ?> <?php echo $deviceclass_sfx; ?> msie"><![endif]-->
<!--[if gt IE 9]><!-->
<div id="<?php echo $uniqued; ?>" class="so-categories module <?php echo $theme; ?> <?php echo $deviceclass_sfx; ?>">
	<?php if($disp_title_module) { ?>
	<h3 class="modtitle"><?php echo $head_name; ?></h3>
	<?php } ?>
	<!--<![endif]-->
	<?php if (!empty($pretext)) { ?>
		<div class="intro_text">
			<?php echo html_entity_decode($pretext); ?>
		</div>
	<?php } ?>
	<?php include("so_categories_".$theme.".tpl");	?>
	<?php if (!empty($posttext)) { ?>
		<div class="footer_text">
			<?php echo html_entity_decode($posttext); ?>
		</div>
	<?php } ?>
</div>

