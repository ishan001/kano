
<div class="newletter-popup">
<div id="boxes" class="newletter-container">
 <div style="" id="dialog" class="window">
	<div class="box">
	  <div class="newletter-title"><h2><?php echo $heading_title; ?></h2></div>
	  <div class="box-content newleter-content">
			<label><?php echo $newletter_lable; ?></label>
		  <div id="frm_subscribe">
			  <form name="subscribe" id="subscribe_popup">
				  <table>
					   <tr>
						 <td><span class="required">*</span><span><?php echo $entry_email; ?></span><input type="text" value="" name="subscribe_pemail" id="subscribe_pemail">
						 <input type="hidden" value="" name="subscribe_pname" id="subscribe_pname" /></td>
					   </tr>
					   <tr>
						 <td>
							<a class="button" onclick="email_subscribepopup()"><span><?php echo $entry_button; ?></span></a>
							<?php if($option_unsubscribe) { ?>
							<a class="button" onclick="email_unsubscribepopup()"><span><?php echo $entry_unbutton; ?></span></a>
							<?php } ?>    
						 </td>
					   </tr>
					   
				  </table>
			  </form>
			  <div class="subscribe-bottom">
					<input type="checkbox" id="newsletter_popup_dont_show_again">
					<label for="newsletter_popup_dont_show_again"><?php echo $entry_show_again; ?></label>
			  </div>
		  </div><!-- /#frm_subscribe -->
		  <div id="notification"></div>
		</div><!-- /.box-content -->
 </div>
</div>	

<script type="text/javascript">
function email_subscribepopup(){
	$.ajax({
			type: 'post',
			url: 'index.php?route=extension/module/newslettersubscribe/subscribepopup',
			dataType: 'html',
            data:$("#subscribe_popup").serialize(),
			success: function (html) {
				$.cookie('shownewsletter', '1');
				eval(html);
			}}); 
	
	
}
function email_unsubscribepopup(){
	$.ajax({
			type: 'post',
			url: 'index.php?route=extension/module/newslettersubscribe/unsubscribe',
			dataType: 'html',
            data:$("#subscribe_popup").serialize(),
			success: function (html) {
				eval(html);
			}}); 
	$('html, body').delay( 1500 ).animate({ scrollTop: 0 }, 'slow'); 
	
}
</script>
<script type="text/javascript">
    $(document).ready(function() {

		if($.cookie('shownewsletter')==1) $('.newletter-popup').hide();
		$('#subscribe_pemail').keypress(function(e) {
            if(e.which == 13) {
                e.preventDefault();
                email_subscribepopup();
            }
			var name= $(this).val();
		  	$('#subscribe_pname').val(name);
        });
		$('#subscribe_pemail').change(function() {
		 var name= $(this).val();
		  		$('#subscribe_pname').val(name);
		});


        //transition effect
        if($.cookie("shownewsletter") != 1){
			$('.newletter-popup').bPopup();
      
        }
		
        //if close button is clicked
        $('.b-modal').click(function (e) {
			$.cookie('shownewsletter', '1');
        });
		
		$('#newsletter_popup_dont_show_again').on('change', function(){
			if($.cookie("shownewsletter") != 1){   
				$.cookie("shownewsletter",'1')
			}else{
				$.cookie("shownewsletter",'0')
			}
		}); 
		

    });
</script>


</div><!-- /.box -->
