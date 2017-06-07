<div class="cat-wrap theme1">
	<?php $i = 0;
	foreach ($list as $items) {
		$i++;
		?>
		<div class="content-box">
			<?php if ($cat_title_display) { ?>
				<div class="cat-title">
					<a title="<?php echo $items['title']; ?>"
					   href="<?php echo $items['link']; ?>" target="<?php echo $item_link_target; ?>" >
						<?php if(strlen($items['title']) > $cat_title_maxcharacs && $cat_title_maxcharacs ) {echo 
						utf8_substr(strip_tags(html_entity_decode($items['title'], ENT_QUOTES, 'UTF-8')), 0, $cat_title_maxcharacs) . '..';}else{ echo $items['title'];}
						?>
					</a>
				</div>
			<?php } ?>
			<?php if ($cat_sub_title_display) { ?>
				<!-- Begin -->
				<div class="child-cat">
					<?php
					if (!empty($items['child_cat'])) {
						foreach ($items['child_cat'] as $item) {
							?>
							<div class="child-cat-title">
								<a href="<?php echo $item['link']; ?>"
								   title="<?php echo $item['title']; ?>" target="<?php echo $item_link_target; ?>">
									<?php if(strlen($item['title']) > $cat_sub_title_maxcharacs && $cat_sub_title_maxcharacs != 0) {echo 
						utf8_substr(strip_tags(html_entity_decode($item['title'], ENT_QUOTES, 'UTF-8')), 0, $cat_sub_title_maxcharacs) . '..';}else{ echo $item['title'];}
						?>
								</a>
								<?php if ($cat_all_product) { ?>
									<span class="num_items">
                                    <?php echo '(' . ($item['all_product']) . ')'; ?>
                                </span>
								<?php } ?>
							</div>
						<?php } ?>
					<?php } else { ?>
						<p>
							<?php echo 'No sub-categories to show!'; ?>
						</p>
					<?php } ?>
				</div><!-- END child-cat -->
			<?php } ?>
		</div><!-- END content-box -->
		<?php
		$clear = 'clr1';
		if ($i % 2 == 0) $clear .= ' clr2';
		if ($i % 3 == 0) $clear .= ' clr3';
		if ($i % 4 == 0) $clear .= ' clr4';
		if ($i % 5 == 0) $clear .= ' clr5';
		if ($i % 6 == 0) $clear .= ' clr6';
		?>
		<div class="<?php echo $clear; ?>"></div>
	<?php } ?>
</div>