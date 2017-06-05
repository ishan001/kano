<div id="blog_home" class="menu-recent owl-style3">
	 <div>
		  <div class="blog-title module-title2">
			   <h2>
				<?php 
					$title2 = explode(' ',$title,3); 
					for($i=0;$i<count($title2);$i++){ 
						$j=$i+1;
						echo $j>2 ? "<span class='word2'> ".$title2[$i]." </span>" : "<span> ".$title2[$i]." </span>";
					}
				?>
			   </h2>
			   <a href="index.php?route=blog/blog" class="link-all"><?php echo $text_all_blog; ?><i class="icon-control-play"></i></a>
		  </div>
		<?php
			$count = 0;
			$rows = $slide['rows'];
			if(!$rows) { $rows = 1;}
			$j=0;
		?>
	 <?php if ($articles) { ?>
      <div class="row">
      <div class="articles-container">
        <?php foreach ($articles as $key=>$article) { $j++; ?>
		  <?php  if($count % $rows == 0 ) { echo '<div class="row_items">'; }  $count++; ?>
          <div class="articles-inner item-inner">
			   <div class="articles-image"><img src="<?php echo $article['image']; ?>" alt="<?php echo $article['name']; ?>" /></div>
			   <div class="aritcles-content">
			   <a class="articles-name" href="<?php echo $article['href']; ?>"><?php echo $article['name']; ?></a>
			   <div class="articles-date">				
					<?php echo $text_post_by.'<span class="author-name">'.$article['author'].'</span>'; ?>
					<?php echo $article['date_added']; ?><?php if($article['author'] != null && $article['author'] != ""): ?>					
			   <?php endif; ?>
			   </div>
			   <div class="articles-intro"><?php echo $article['intro_text']; ?></div>
			   <div class="readmore"><a class="button" href="<?php echo $article['href']; ?>"><?php echo $button_read_more; ?></a></div>
			   </div>
          </div>
		  <?php if($count % $rows == 0 || $count == count($articles)): ?>
	  		</div>
		 <?php endif; ?>
        <?php } ?>
      </div>
      </div>
      <?php } ?>
	  
      <?php if (!$articles) { ?>
      <p><?php echo $text_empty; ?></p>
      <?php } ?>
	  </div>
 <script>
 $(document).ready(function() { 
	  $(".articles-container").owlCarousel({
			autoPlay : <?php if($slide['auto']) { echo 'true' ;} else { echo 'false'; } ?>,
			items : <?php echo $slide['items'] ?>,
			itemsDesktop : [1199,2],
			itemsDesktopSmall : [991,2],
			itemsTablet: [700,1],
			itemsMobile : [400,1],
			slideSpeed : <?php echo $slide['speed']; ?>,
			paginationSpeed : <?php echo $slide['speed']; ?>,
			rewindSpeed : <?php echo $slide['speed']; ?>,
			navigation : <?php if($slide['navigation']) { echo 'true' ;} else { echo 'false'; } ?>,
			pagination : <?php if($slide['pagination']) { echo 'true' ;} else { echo 'false'; } ?>,
			stopOnHover : true,
			addClassActive: true,
			navigationText : ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>']
	  });
 });
 </script>
</div>
