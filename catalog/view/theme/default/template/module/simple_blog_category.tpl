<?php if($categories) { ?>
    <div class="panel panel-default blog-category box module block-boder">
      	<h3 class="modtitle"><span><?php echo $heading_title; ?></span></h3>

            <div class="box-content">
			 <ul class="list-group ">
			 <?php $categories = array_reverse($categories); ?>
            	<?php foreach ($categories as $category) { ?>
            		<?php if ($category['simple_blog_category_id'] == $category_id) { ?>
            			<li class="list-group-item"> <i class="fa fa-circle-thin"></i><a href="<?php echo $category['href']; ?>" class="list-group-item active"><?php echo $category['name']; ?></a></li>
            			<?php if ($category['children']) { ?>
            				<?php foreach ($category['children'] as $child) { ?>
            					<?php if ($child['category_id'] == $child_id) { ?>
            						<i class="fa fa-circle-thin"></i><a href="<?php echo $child['href']; ?>" class="list-group-item active">&nbsp;&nbsp;&nbsp;- <?php echo $child['name']; ?></a>
            					<?php } else { ?>
            						<i class="fa fa-circle-thin"></i><a href="<?php echo $child['href']; ?>" class="list-group-item">&nbsp;&nbsp;&nbsp;- <?php echo $child['name']; ?></a>
            					<?php } ?>
            				<?php } ?>
            			<?php } ?>
            		<?php } else { ?>
            			<li class="list-group-item"> <i class="fa fa-circle-thin"></i><a href="<?php echo $category['href']; ?>" class="list-group-item"><?php echo $category['name']; ?></a></li>
            		<?php } ?>
            	<?php } ?>
			</ul>

        	
        	<?php if((isset($simple_blog_category_search_article)) && ($simple_blog_category_search_article)) { ?>
        		<div id="blog-search" style="margin-top: 5px; margin-bottom: 5px;">
        			<div>
        				<input type="text" name="article_search" value="<?php echo $blog_search; ?>" placeholder="<?php echo $text_search_article; ?>" class="form-control" style="margin-bottom: 5px;" />
                        
    	    			<a id="button-search" class="btn"><i class="fa fa-search"></i></a>
        			</div>
        		</div>
        	<?php } ?>
        	
      	 </div>
    </div>
<?php } ?>



<script type="text/javascript">
	$('#blog-search input[name=\'article_search\']').keydown(function(e) {
		if (e.keyCode == 13) {
			$('#button-search').trigger('click');
		}
	});

	$('#button-search').bind('click', function() {
		url = 'index.php?route=simple_blog/search';
		
		var article_search = $('#blog-search input[name=\'article_search\']').val();
		
		if (article_search) {
			url += '&blog_search=' + encodeURIComponent(article_search);
		}
		
		location = url;
	});
</script> 
