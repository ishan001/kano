<div class="cat-wrap theme4">
	<?php $i = 0;
	foreach ($list as $items) {
		$i++;
		?>
		<div class="so-categories-inner">
			<div class="so-categories-heading">
				<div class="icon_left"></div>
				<?php if ($cat_title_display) { ?>
					<div class="cat-title">
						<a href="<?php echo $items['link']; ?>"
						   title="<?php echo $items['title']; ?>" target="<?php echo $item_link_target; ?>" >
							<?php if(strlen($items['title']) > $cat_title_maxcharacs && $cat_title_maxcharacs != 0) {echo 
						utf8_substr(strip_tags(html_entity_decode($items['title'], ENT_QUOTES, 'UTF-8')), 0, $cat_title_maxcharacs) . '..';}else{ echo $items['title'];}
						?>
						</a>
					</div>
				<?php } ?>
				<div class="icon_right"></div>
			</div>
			<div class="so-categories-content cf">
				<?php
				if (!empty($items['child_cat'])) {
					$k = 0;
					foreach ($items['child_cat'] as $item) {
						$k++;
						$count = count($items['child_cat']); ?>
						<div class="so-categories-content-inner">
							<div class="child-cat <?php echo ($k == $count) ? 'cat-lastitem' : ''; ?>">
								<div class="child-cat-info">
									<?php 
									if ($item['image'] && (strlen($item['image']) != '') && $items['product_image'] == 1) {
										?>
										<div class="image-cat" title="<?php echo $item['title']; ?>"
										     style="max-width:<?php echo $width; ?>px;">
											<a href="<?php echo $item['link']; ?>"
											   title="<?php echo $item['title']; ?>" target="<?php echo $item_link_target; ?>" >
												<img
													src="<?php echo $item['image'] ?>"
													title="<?php echo $item['title']; ?>"
													alt="<?php echo $item['title']; ?>"/>
											</a>
										</div>
									<?php }else if($items['product_image'] == 1){?>
										<div class="image-cat" title="<?php echo $item['title']; ?>"
										     style="max-width:<?php echo $width; ?>px;">
											<a href="<?php echo $item['link']; ?>"
											   title="<?php echo $item['title']; ?>" target="<?php echo $item_link_target; ?>" >
												<img
													src="<?php echo $placeholder_path ?>"
													title="<?php echo $item['title']; ?>"
													alt="<?php echo $item['title']; ?>"/>
											</a>
										</div>
									<?php } ?>
									<?php if ($cat_sub_title_display) { ?>
										<div class="child-cat-desc">
											<div class="child-cat-title">
												<a href="<?php echo $item['link'] ?>"
												   title="<?php echo $item['title']; ?>" target="<?php echo $item_link_target; ?>" >
													<?php if(strlen($item['title']) > $cat_sub_title_maxcharacs && $cat_sub_title_maxcharacs != 0) {echo 
						utf8_substr(strip_tags(html_entity_decode($item['title'], ENT_QUOTES, 'UTF-8')), 0, $cat_sub_title_maxcharacs) . '..';}else{ echo $item['title'];}
						?>
												</a>
											</div>
											<?php if ($cat_all_product) { ?>
												<div class="num_items" style="float:left;color: #737373;">
													<?php echo '(' . ($item['all_product']) . ')'; ?>
												</div>
											<?php } ?>
										</div>
									<?php } ?>
								</div>
							</div>
						</div>
					<?php
					}
				} else {
					?>
					<div class="so-categories-content-inner">
						<div class="child-cat subcat-empty">
							<div class="child-cat-info">
								<?php echo 'No sub-categories to show!'; ?>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	<?php } ?>
</div>