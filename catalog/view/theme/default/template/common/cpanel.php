<?php 
global $config;
$schemes_array = array(
	'orange' 	=> '#F4A137',
	'blue' 		=> '#03a9f4',
	'brown'		=> '#795548',
	'cyan' 		=> '#00bcd4',
	'lime' 		=> '#cddc39',
	'red' 		=> '#f44336',
);
$store_id = $config->get('config_store_id');
$template = $config->get('theme_default_directory');

if ($store_id == 0) {
    $soconfig_general = $config->get('soconfig_general');
    $soconfig_layout = $config->get('soconfig_layout');
} else {
	$soconfig_general = $config->get('soconfig_general_store');
    $soconfig_layout = $config->get('soconfig_layout_store');
	if (isset($soconfig_general[$store_id]['themecolor']))  {$soconfig_general['themecolor'] = $soconfig_general[$store_id]['themecolor'];}
	if (isset($soconfig_layout[$store_id]['layoutstyle'])) 	{$soconfig_layout['layoutstyle'] = $soconfig_layout[$store_id]['layoutstyle'];}
	if (isset($soconfig_layout[$store_id]['pattern'])) 	 	{$soconfig_layout['pattern'] = $soconfig_layout[$store_id]['pattern'];}
}

?>
<div id="sp-cpanel_btn" class="isDown visible-lg">
	<i class="fa fa-cog"></i>
</div>		

<div id="sp-cpanel" class="sp-delay">
	<h2 class="sp-cpanel-title"> Demo Options <span class="sp-cpanel-close"> <i class="fa fa-times"> </i></span></h2>
	<div id="sp-cpanel_settings">
		<div class="panel-group">
			<label>Color Scheme</label>
			<div class="group-schemes" >
				<?php foreach ($schemes_array as $schemes => $color){?>
					<span data-toggle="tooltip" title="<?php echo ucfirst($schemes) ?>" data-scheme="<?php echo $schemes?>"  class="item_scheme <?php echo (isset($soconfig_general["themecolor"]) && $soconfig_general["themecolor"]==$schemes) ? 'selected' : ''?>"><span style="background: <?php echo $color?>"></span></span>
				<?php } ?>
			 </div>
		</div>
		
		<div class="panel-group ">
			<label>Layout Box</label>
			<div class="group-boxed">
				<select id="cp-layoutbox" name="cplayoutbox" class="form-control" onchange="changeLayoutBox(this.value);">
					<option <?php echo (isset($soconfig_layout["layoutstyle"]) && $soconfig_layout["layoutstyle"]=="full") ? 'selected' : ''?>  value="full">Wide</option>
					<option <?php echo (isset($soconfig_layout["layoutstyle"]) && $soconfig_layout["layoutstyle"]=="boxed") ? 'selected' : ''?> value="boxed">Boxed</option>
					<option <?php echo (isset($soconfig_layout["layoutstyle"]) && $soconfig_layout["layoutstyle"]=="iframed") ? 'selected' : ''?> value="iframed">Iframed</option>
					<option <?php echo (isset($soconfig_layout["layoutstyle"]) && $soconfig_layout["layoutstyle"]=="rounded") ? 'selected' : ''?> value="rounded">Rounded</option>
				</select>
			</div>
		</div>
		
        <div class="panel-group">
			<label>Body Image</label>
			
			<div class="group-pattern">
				<?php for ($i = 28; $i <= 45; $i++) { ?>
				<div data-pattern="<?php echo $i?>"  class="img-pattern <?php echo (isset($soconfig_general["pattern"]) &&  $soconfig_general["pattern"]== $i) ? 'selected' : ''?>"><img src="catalog/view/theme/<?php echo $template?>/images/patterns/<?php echo $i?>.png" alt="pattern <?php echo $i?>"></div>
				<?php } ?>
			</div>
			<p class="label-sm">Background only applies for Boxed,Framed, Rounded Layout</p>
		</div>
		
		<div class="reset-group">
		    <a href="index.php" class="btn btn-success " onclick="ResetAll()">Reset</a>
		</div>
		
	</div>

</div>

<script type="text/javascript"><!--
var themes = '<?php echo $template?>', $direction = '<?php echo $direction?>';
//--></script>
<link rel='stylesheet' property='stylesheet'  href='catalog/view/theme/<?php echo $template ?>/css/cpanel.css' type='text/css' media='all' />
<script type="text/javascript" src="catalog/view/theme/<?php echo $template ?>/js/cpanel.js"></script>
