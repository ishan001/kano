<div class="module">
	<h3 class="modtitle"><?php echo $heading_title; ?></h3>
	<div class="row modcontent clearfix">
	  <?php foreach ($products as $product) { ?>
	  <div class="col-lg-<?php echo $nb_column0 ?> col-md-<?php echo $nb_column1 ?> col-sm-<?php echo $nb_column2 ?> col-xs-<?php echo $nb_column3 ?>">
		<div class="product-thumb transition">
		<?php if($product_image) {?>
		  <div class="image"><a href="<?php echo $product['href'];?>" target="<?php echo $item_link_target;?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a></div>
		<?php } ?>
		  <div class="caption">
			<?php if($display_title){ ?>
				<h4><a href="<?php echo $product['href']; ?>" target="<?php echo $item_link_target;?>"><?php echo html_entity_decode($product['name']); ?></a></h4>
			<?php } ?>
			<?php if($display_description){ ?>
				<?php echo html_entity_decode($product['description']); ?>
			<?php } ?>
			<?php if ($product['rating']) { ?>
			<div class="rating">
			  <?php for ($i = 1; $i <= 5; $i++) { ?>
			  <?php if ($product['rating'] < $i) { ?>
			  <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
			  <?php } else { ?>
			  <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
			  <?php } ?>
			  <?php } ?>
			</div>
			<?php } ?>
			<?php if ($display_price) { ?>
				<?php if ($product['price']) { ?>
				<p class="price">
				  <?php if (!$product['special']) { ?>
				  <?php echo $product['price']; ?>
				  <?php } else { ?>
				  <span class="price-new"><?php echo $product['special']; ?></span> <span class="price-old"><?php echo $product['price']; ?></span>
				  <?php } ?>
				  <?php if ($product['tax']) { ?>
				  <span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
				  <?php } ?>
				</p>
				<?php } ?>
			<?php } ?>
		  </div>
		</div>
	  </div>
	  <?php } ?>
	</div>
</div>
