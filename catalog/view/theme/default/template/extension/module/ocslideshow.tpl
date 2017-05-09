<div class="banner7">
	<div class= "oc-banner7-container">
		<div class="flexslider oc-nivoslider">
			<div class="oc-loading"></div>
			<div id="oc-inivoslider" class="slides">

				<?php
					$slides = $ocslideshows;
					$config = $slide_setting[0];

					$i = 1;
					foreach($slides as $s) {

				?>
				<img style="display: none;" src="<?php echo $s['image']; ?>" alt="" title="#banner7-caption<?php echo $i; ?>"  />
				<?php
					$i ++;
			        }
				?>
			</div>

			<?php
					$i = 1;
					foreach($slides as $s) { ?>
			<div id="banner7-caption<?php echo $i; ?>" class="banner7-caption nivo-html-caption nivo-caption move-slides-effect" data-class="slide-movetype<?php echo $s['type']; ?>">
				<div class="banner7-small_image">
					<img src="<?php echo $s['small_image']; ?>" alt="" title="small" />
				</div>
				<div class="banner7-title">
					<?php if(isset($s['title']) && $s['title'] != ""): ?>
					<h3><?php echo $s['title']; ?></h3>
					<?php endif; ?>
				</div>
				<div class="sub-title">
					<?php if(isset($s['sub_title']) && $s['sub_title'] != ""): ?>
					<h3><?php echo $s['sub_title']; ?></h3>
					<?php endif; ?>
				</div>
				<div class="banner7-des">
					<?php echo $s['description']; ?>
				</div>
				<?php if( $s['link'] ) { ?>
				<div class="banner7-readmore">
					<a href="<?php echo $s['link']?>" title="<?php echo $text_readmore; ?>"><?php echo $text_readmore; ?></a>
				</div>
				<?php } ?>
			</div>
			<?php
					$i++;
					}
				?>
			<script type="text/javascript">
				$(window).load(function() {
					$('#oc-inivoslider').nivoSlider({
						effect: '<?php if($config['effect']) { echo $config['effect'];} else { echo 'random'; } ?>',
						slices: 15,
						boxCols: 8,
						boxRows: 4,
						manualAdvance: <?php  if(isset($config['auto'])&& $config['auto'] == 1) { echo 'false' ; } else { echo 'true';} ?>,
						animSpeed:500,
						pauseTime: '<?php  if($config['delay']) { echo $config['delay']; } else { echo 3000;} ?>',
						startSlide: 0,
						controlNav:  <?php  if(isset($config['contrl']) && $config['contrl'] == 1) { echo 'true' ; } else { echo 'false';} ?>,
					directionNav:  <?php  if(isset($config['nextback'])&& $config['nextback'] == 1) { echo 'true' ; } else { echo 'false';} ?>,
					controlNavThumbs: false,
							pauseOnHover:  <?php  if(isset($config['hover'])&& $config['hover'] == 1) { echo 'true' ; } else { echo 'false';} ?>,
							prevText: 'Prev',
							nextText: 'Next',
							beforeChange: function() {
						var nivo_image = $('#oc-inivoslider .nivo-caption .banner7-small_image img').attr('src');
						$('#oc-inivoslider .nivo-caption').hide();
						$('.move-slides-effect img').each(function() {
							var small_image = $(this).attr('src');
							if(nivo_image == small_image) {
								var move_class = $(this).closest('.move-slides-effect').data('class');
								$('#oc-inivoslider .nivo-caption').removeClass().addClass('nivo-caption').addClass(move_class);
							}
						});
					},
					afterLoad: function(){
						$('.oc-loading').css("display","none");
						var nivo_image = $('.nivo-caption .banner7-small_image img').attr('src');
						$('.move-slides-effect img').each(function() {
							var small_image = $(this).attr('src');
							if(nivo_image == small_image) {
								var move_class = $(this).closest('.move-slides-effect').data('class');
								$('#oc-inivoslider .nivo-caption').removeClass().addClass('nivo-caption').addClass(move_class);
							}
						});
					},

				});
				});

			</script>
		</div>
	</div>
</div>