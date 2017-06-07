<div class="col-lg-3 col-md-3 vermagemenu-container">
<div class="vermagemenu visible-lg visible-md">
    <div class="content-vermagemenu"> 
        <h2><i class="fa fa-align-justify"></i><?php echo $heading_title;?></h2>
        <div class="navleft-container">
            <div id="pt_vmegamenu" class="pt_vmegamenu">
                <?php echo $vermegamenu ?> 
            </div>	
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
//<![CDATA[
var CUSTOMMENU_POPUP_EFFECT = <?php echo $effect; ?>;
var CUSTOMMENU_POPUP_TOP_OFFSET = <?php echo $top_offset ; ?>
//]]>
        $('.vermagemenu h2').click(function () {
            $( ".navleft-container" ).slideToggle();
			$(this).toggleClass('no-padding');
			$('.content-vermagemenu').toggleClass('small-padding');
        });
</script>