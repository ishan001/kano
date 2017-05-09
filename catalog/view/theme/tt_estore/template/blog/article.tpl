<?php echo $header; ?>

  <div class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9 col-xs-12'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      
        <div class="article-container">
		<img class=" lazy"  src="<?php echo $image; ?>" alt="<?php echo $heading_title;  ?>" />
          <div class="article-title">
                <?php echo $heading_title; ?>
            </div>
			<div class="article-date">
				<?php if($author != null && $author != ""): ?>
					<?php echo $text_post_by . $author; ?>
			   <?php endif; ?>
			   <?php echo "/" . $date; ?>
			 </div>
            <div class="article-description">
                
                <p><?php echo $description; ?></p>
				
            </div>
            
        </div>
      
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>
