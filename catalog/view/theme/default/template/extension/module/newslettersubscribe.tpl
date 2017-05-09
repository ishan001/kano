<div class="newletter-subscribe">
<div id="boxes" class="newletter-container">
 <div style="" id="dialog" class="window">
	<div class="box">
	  <div class="newletter-title"><h2><?php echo $heading_title; ?></h2></div>
	  <div class="box-content newleter-content">
			<label><?php echo $newletter_lable; ?></label>
		  <div id="frm_subscribe">
			  <form name="subscribe" id="subscribe">
				  <table>
					   <tr>
						 <td><span class="required">*</span><span><?php echo $entry_email; ?></span><input type="text" value="" name="subscribe_email" id="subscribe_email">
						 <input type="hidden" value="" name="subscribe_name" id="subscribe_name" /></td>
					   </tr>
					   <tr>
						 <td>
							<a class="button" onclick="email_subscribe()"><span><?php echo $entry_button; ?></span></a>
							<?php if($option_unsubscribe) { ?>
							<a class="button" onclick="email_unsubscribe()"><span><?php echo $entry_unbutton; ?></span></a>
							<?php } ?>    
						 </td>
					   </tr>
					   
				  </table>
			  </form>
		  </div><!-- /#frm_subscribe -->
		  <div id="notification"></div>
		</div><!-- /.box-content -->
 </div>
</div>	

<script type="text/javascript">
function email_subscribe(){
	$.ajax({
			type: 'post',
			url: 'index.php?route=extension/module/newslettersubscribe/subscribe',
			dataType: 'html',
            data:$("#subscribe").serialize(),
			success: function (html) {
				eval(html);
			}}); 
	
	
}
function email_unsubscribe(){
	$.ajax({
			type: 'post',
			url: 'index.php?route=extension/module/newslettersubscribe/unsubscribe',
			dataType: 'html',
            data:$("#subscribe").serialize(),
			success: function (html) {
				eval(html);
			}}); 
	$('html, body').delay( 1500 ).animate({ scrollTop: 0 }, 'slow'); 
	
}
</script>
<script type="text/javascript">
    $(document).ready(function() {
		$('#subscribe_email').keypress(function(e) {
            if(e.which == 13) {
                e.preventDefault();
                email_subscribe();
            }
			var name= $(this).val();
		  	$('#subscribe_name').val(name);
        });
		$('#subscribe_email').change(function() {
		 var name= $(this).val();
		  		$('#subscribe_name').val(name);
		});
	
    });
</script>


</div><!-- /.box -->
