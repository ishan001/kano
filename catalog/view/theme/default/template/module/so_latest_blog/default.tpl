<?php if (!empty($blogs)) {
$tag_id = 'so_latest_blog_'.$moduleid.'_'.rand().time();
$count_item = count($blogs);
$cls_btn_page = ($button_page == 'top') ? 'buttom-type1':'button-type2';
$btn_type 	  = ($button_page == 'top') ? 'button-type1':'button-type2';
$btn_prev = ($button_page == 'top') ? '&#171;':'&#139;';
$btn_next = ($button_page == 'top') ? '&#187;':'&#155;';
$i = 0;
?>
<div class="module so-latest-blog <?php echo $class_suffix; ?>">
	<?php if($disp_title_module) { ?>
		<h3 class="modtitle"><span><?php echo $head_name; ?></span></h3>
	<?php } ?>
	<div id="<?php echo $tag_id ; ?>" class="so-blog-external <?php echo $cls_btn_page; ?> <?php echo $btn_type; ?>">
		<?php if($type_show == 'simple') { ?>
		<div class="blog-external-simple">
			<?php foreach( $blogs as $key => $blog ) { ?>
				<div class="media">
					<?php include("default_items.tpl"); ?>
				</div>
			<?php } ?>
		</div>
		<?php } else { ?>
		<div class="blog-external" data-effect="<?php echo $effect; ?>">
			<?php foreach( $blogs as $key => $blog ) {
			$i++;
			?>
				<?php if ($i % $nb_rows == 1 || $nb_rows == 1) { ?>
					<div class="media">
				<?php } ?>
					<?php include("default_items.tpl"); ?>
				<?php if ($i % $nb_rows == 0 || $i == $count_item) { ?>
					</div>
				<?php } ?>
			<?php } ?>
		</div>
		<?php } ?>
	</div>
	<script type="text/javascript">
		//<![CDATA[
		jQuery(document).ready(function ($) {
			;(function (element) {
				var $element = $(element),
						$extraslider = $(".blog-external", $element),
						_delay = <?php echo $delay; ?>,
				_duration = <?php echo $duration; ?>,
				_effect = '<?php echo $effect; ?>';

				this_item = $extraslider.find('div.media');
				this_item.find('div.item:eq(0)').addClass('head-button');
				this_item.find('div.item:eq(0) .media-heading').addClass('head-item');
				this_item.find('div.item:eq(0) .media-left').addClass('so-block');
				this_item.find('div.item:eq(0) .media-content').addClass('so-block');
				$extraslider.on("initialized.owl.carousel2", function () {
					var $item_active = $(".owl2-item.active", $element);
					if ($item_active.length > 1 && _effect != "none") {
						_getAnimate($item_active);
					}
					else {
						var $item = $(".owl2-item", $element);
						$item.css({"opacity": 1, "filter": "alpha(opacity = 100)"});
					}
					<?php if($dots == "true") { ?>
						if ($(".owl2-dot", $element).length < 2) {
							$(".owl2-prev", $element).css("display", "none");
							$(".owl2-next", $element).css("display", "none");
							$(".owl2-dot", $element).css("display", "none");
						}
					<?php }?>

					<?php if ($button_page == "top"){ ?>
						$(".owl2-controls", $element).insertBefore($extraslider);
						$(".owl2-dots", $element).insertAfter($(".owl2-prev", $element));
					<?php }else{ ?>
						$(".owl2-nav", $element).insertBefore($extraslider);
						$(".owl2-controls", $element).insertAfter($extraslider);
					<?php }?>

				});

				$extraslider.owlCarousel2({
					margin: <?php echo $margin;?>,
				slideBy: <?php echo $slideBy;?>,
				autoplay: <?php echo $autoplay;?>,
				autoplayHoverPause: <?php echo $pausehover ;?>,
				autoplayTimeout: <?php echo $autoplay_timeout; ?>,
				autoplaySpeed: <?php echo $autoplaySpeed; ?>,
				loop: <?php echo $loop; ?>,
				startPosition: <?php echo $startPosition; ?>,
				mouseDrag: <?php echo $mouseDrag;?>,
				touchDrag: <?php echo $touchDrag; ?>,
				autoWidth: false,
						responsive: {
					0: 	{ items: <?php echo $nb_column4;?> } ,
					480: { items: <?php echo $nb_column3;?> },
					768: { items: <?php echo $nb_column2;?> },
					992: { items: <?php echo $nb_column1;?> },
					1200: {items: <?php echo $nb_column0;?>}
				},
				dotClass: "owl2-dot",
				dotsClass: "owl2-dots",
				dots: <?php echo $dots; ?>,
				dotsSpeed:<?php echo $dotsSpeed; ?>,
				nav: <?php echo $nav; ?>,
				loop: true,
				navSpeed: <?php echo $navSpeed; ?>,
				navText: ["<?php echo $btn_prev; ?>", "<?php echo $btn_next; ?>"],
				navClass: ["owl2-prev", "owl2-next"]

			});

			$extraslider.on("translate.owl.carousel2", function (e) {
				<?php if($dots == "true") { ?>
					if ($(".owl2-dot", $element).length < 2) {
						$(".owl2-prev", $element).css("display", "none");
						$(".owl2-next", $element).css("display", "none");
						$(".owl2-dot", $element).css("display", "none");
					}
				<?php } ?>

				var $item_active = $(".owl2-item.active", $element);
				_UngetAnimate($item_active);
				_getAnimate($item_active);
			});

			$extraslider.on("translated.owl.carousel2", function (e) {

				<?php if($dots == "true") { ?>
					if ($(".owl2-dot", $element).length < 2) {
						$(".owl2-prev", $element).css("display", "none");
						$(".owl2-next", $element).css("display", "none");
						$(".owl2-dot", $element).css("display", "none");
					}
				<?php } ?>

				var $item_active = $(".owl2-item.active", $element);
				var $item = $(".owl2-item", $element);

				_UngetAnimate($item);

				if ($item_active.length > 1 && _effect != "none") {
					_getAnimate($item_active);
				} else {

					$item.css({"opacity": 1, "filter": "alpha(opacity = 100)"});

				}
			});

			function _getAnimate($el) {
				if (_effect == "none") return;
				//if ($.browser.msie && parseInt($.browser.version, 10) <= 9) return;
				$extraslider.removeClass("extra-animate");
				$el.each(function (i) {
					var $_el = $(this);
					$(this).css({
						"-webkit-animation": _effect + " " + _duration + "ms ease both",
						"-moz-animation": _effect + " " + _duration + "ms ease both",
						"-o-animation": _effect + " " + _duration + "ms ease both",
						"animation": _effect + " " + _duration + "ms ease both",
						"-webkit-animation-delay": +i * _delay + "ms",
						"-moz-animation-delay": +i * _delay + "ms",
						"-o-animation-delay": +i * _delay + "ms",
						"animation-delay": +i * _delay + "ms",
						"opacity": 1
					}).animate({
						opacity: 1
					});

					if (i == $el.size() - 1) {
						$extraslider.addClass("extra-animate");
					}
				});
			}

			function _UngetAnimate($el) {
				$el.each(function (i) {
					$(this).css({
						"animation": "",
						"-webkit-animation": "",
						"-moz-animation": "",
						"-o-animation": "",
						"opacity": 0
					});
				});
			}

		})("#<?php echo $tag_id ; ?>");
		});
		//]]>
	</script>
</div>

<?php
} else {
    echo 'Has no item to show!';
} ?>
