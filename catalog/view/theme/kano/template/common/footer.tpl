<footer>
	<?php if(isset($block2)){ ?>
		<?php echo $block2; ?>
	<?php } ?>
  <div class="container">
    <div class="row">
		<?php if(isset($block3)){ ?>
			<div class="col-sm-3 col-footer">
				<?php echo $block3; ?>
			</div>
		<?php } ?>
      <?php if ($informations) { ?>
      <div class="col-sm-3 col-footer">
        <div class="title-footer"><?php echo $text_information; ?></div>
        <ul class="list-unstyled text-content">
          <?php foreach ($informations as $information) { ?>
          <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
          <?php } ?>
        </ul>
      </div>
      <?php } ?>
        <div class="col-sm-3 col-footer">

        </div>
      <div class="col-sm-3 col-footer">
        <div class="title-footer"><?php echo $text_account; ?></div>
        <ul class="list-unstyled text-content">
          <li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
          <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
          <li><a href="<?php echo $wishlist; ?>"><?php echo $text_wishlist; ?></a></li>
          <li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>
        </ul>
      </div>
<!--      <div class="col-sm-3 col-footer">
        <div class="title-footer"><?php echo $text_extra; ?></div>
        <ul class="list-unstyled text-content">
          <li><a href="<?php echo $manufacturer; ?>"><?php echo $text_manufacturer; ?></a></li>
          <li><a href="<?php echo $voucher; ?>"><?php echo $text_voucher; ?></a></li>
          <li><a href="<?php echo $affiliate; ?>"><?php echo $text_affiliate; ?></a></li>
          <li><a href="<?php echo $special; ?>"><?php echo $text_special; ?></a></li>
        </ul>
      </div>-->
    </div>
      <div class="banner-footer col-sm-12">
          <div class="col-sm-4">
              <ul class="list-unstyled list-social-media">
                  <li><a href="https://web.facebook.com/KanoTrading/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                  <li><a href="https://twitter.com/KanoTrading" target="_blank"><i class="fa fa-twitter"></i></a></li>
                  <li><a href="https://www.instagram.com/kanotrading.co.jp/" target="_blank"><i class="fa fa-instagram"></i></a></li>
              </ul>
          </div>
          <div class="col-sm-4">

          </div>
          <div class="col-sm-4">
              <img src="image/catalog/cmsblock/payment.png" alt="payment">
          </div>
      </div>
      <p class="text-powered">
		<?php echo $powered; ?>
	</p>
		<ul class="list-unstyled">
          <li><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
          <li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
          <li><a href="<?php echo $sitemap; ?>"><?php echo $text_sitemap; ?></a></li>
        </ul>
  </div>
  <div id="back-top"><i class="fa fa-angle-up"></i></div>
<script type="text/javascript">
$(document).ready(function(){
	// hide #back-top first
	$("#back-top").hide();
	// fade in #back-top
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 300) {
				$('#back-top').fadeIn();
			} else {
				$('#back-top').fadeOut();
			}
		});
		// scroll body to 0px on click
		$('#back-top').click(function () {
			$('body,html').animate({scrollTop: 0}, 800);
			return false;
		});
	});
});
</script>
</footer>

</body></html>