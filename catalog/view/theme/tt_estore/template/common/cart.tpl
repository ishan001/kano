<div id="cart" class="btn-group btn-block">
  <button type="button" data-toggle="dropdown" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-inverse btn-block btn-lg dropdown-toggle"><i class="icon-handbag"></i> <span id="cart-total"><?php echo $text_items; ?></span></button>
  <ul class="dropdown-menu pull-right">
    <?php if ($products || $vouchers) { ?>
    <li class="has-scroll">
      <table class="table">
        <?php foreach ($products as $product) { ?>
        <tr>
          <td class="text-center">
				<?php if ($product['thumb']) { ?>
					<a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>"/></a>
				<?php } ?>
			</td>
          <td class="text-left info-item">
			  <a class="cart-name" href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
				<?php if ($product['option']) { ?>
					<?php foreach ($product['option'] as $option) { ?>
					<br />
					- <small><?php echo $option['name']; ?> <?php echo $option['value']; ?></small>
					<?php } ?>
				<?php } ?>
				<?php if ($product['recurring']) { ?>
					<br />
					- <small><?php echo $text_recurring; ?> <?php echo $product['recurring']; ?></small>
				<?php } ?>
				<p class="cart-quantity">&times;<?php echo $product['quantity']; ?></p>
				<p class="cart-price"><?php echo $product['total']; ?></p>
			</td>
          <td class="text-center cart-close"><button type="button" onclick="cart.remove('<?php echo $product['cart_id']; ?>');" title="<?php echo $button_remove; ?>" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button></td>
        </tr>
        <?php } ?>
        <?php foreach ($vouchers as $voucher) { ?>
        <tr>
          <td class="text-center"></td>
          <td class="text-left"><?php echo $voucher['description']; ?></td>
          <td class="text-right">x&nbsp;1</td>
          <td class="text-right"><?php echo $voucher['amount']; ?></td>
          <td class="text-center text-danger"><button type="button" onclick="voucher.remove('<?php echo $voucher['key']; ?>');" title="<?php echo $button_remove; ?>" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button></td>
        </tr>
        <?php } ?>
      </table>
    </li>
    <li>
      <div>
        <table class="table">
          <?php foreach ($totals as $total) { ?>
          <tr>
            <td class="text-right"><strong><?php echo $total['title']." :"; ?></strong></td>
            <td class="text-right"><?php echo $total['text']; ?></td>
          </tr>
          <?php } ?>
        </table>
        
      </div>
	  <p class="text-center cart-button"><a href="<?php echo $cart; ?>"><strong><?php echo $text_cart; ?> <i class="fa fa-angle-right"></i></strong></a><a href="<?php echo $checkout; ?>"><strong><?php echo $text_checkout; ?><i class="fa fa-angle-right"></i></strong></a></p>
    </li>
    <?php } else { ?>
    <li>
      <p class="text-center cart-empty"><?php echo $text_empty; ?></p>
    </li>
    <?php } ?>
  </ul>
</div>
