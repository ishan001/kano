<div class="wrap-categories">
	<div class="cat-wrap theme3">
		<?php $j = 0;
		foreach ($list as $items) {
			$j++;
			?>
			<div class="content-box">
				<?php  
				if (($items['image']) && (strlen($items['image']) != '') && $items['product_image'] == 1) {
					?>
					<div class="image-cat">
						<a href="<?php echo $items['link']; ?>"
						   title="<?php echo $items['title']; ?>" target="<?php echo $item_link_target; ?>" >
							<img src="<?php echo $items['image']; ?>"
								title="<?php echo $items['title']; ?>" alt="<?php echo $items['title']; ?>"/>
						</a>
						<a class="btn-viewmore" href="<?php echo $items['link']; ?>" title="View more"><?php echo $view_more ?></a>
					</div>
				<?php } ?>
				<div class="inner">
					<?php if ($cat_title_display) { ?>
						<div class="cat-title">
							<a href="<?php echo $items['link']; ?>"
							   title="<?php echo $items['title']; ?> " target="<?php echo $item_link_target; ?>" >
								<?php if(strlen($items['title']) > $cat_title_maxcharacs && $cat_title_maxcharacs != 0) {echo 
								utf8_substr(strip_tags(html_entity_decode($items['title'], ENT_QUOTES, 'UTF-8')), 0, $cat_title_maxcharacs) . '..';}else{ echo $items['title'];}
								?>
							</a>
						</div>
					<?php } ?>
					<?php if ($cat_sub_title_display) { ?>
						<div class="child-cat">
							<?php
							if (!empty($items['child_cat'])) {
								foreach ($items['child_cat'] as $item) {
									?>
									<div class="arrow"></div>
									<div class="child-cat-title">
										<a  title="<?php echo $item['title'];?>"
											href="<?php echo $item['link']; ?>" target="<?php echo $item_link_target; ?>">
											<?php if(strlen($item['title']) > $cat_sub_title_maxcharacs && $cat_sub_title_maxcharacs != 0) {echo 
								utf8_substr(strip_tags(html_entity_decode($item['title'], ENT_QUOTES, 'UTF-8')), 0, $cat_sub_title_maxcharacs) . '..';}else{ echo $item['title'];}
								?>
											<?php if ($cat_all_product) { ?>
												<?php echo '&nbsp;&nbsp;(' . $item['all_product'] . ')'.',&nbsp;'; ?>
											<?php } ?>
										</a>
									</div>
								<?php
								}
							} else {
								?>
								<p>
									<?php echo 'No sub-categories to show!'; ?>
								</p>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			</div>
			<?php
			$clear = 'clr1';
			if ($j % 2 == 0) $clear .= ' clr2';
			if ($j % 3 == 0) $clear .= ' clr3';
			if ($j % 4 == 0) $clear .= ' clr4';
			if ($j % 5 == 0) $clear .= ' clr5';
			if ($j % 6 == 0) $clear .= ' clr6';
			?>
			<div class="<?php echo $clear; ?>"></div>
		<?php } ?>
	</div>
</div>