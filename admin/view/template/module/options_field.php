<?php 
/******************************************************
 * @package	SO Theme Framework for Opencart 2.0.x
 * @author	http://www.magentech.com
 * @license	GNU General Public License
 * @copyright(C) 2008-2015 Magentech.com. All rights reserved.
*******************************************************/
?>


<?php 
global  $storeid,$soconfig_general;
$storeid = $store["store_id"];

if (!function_exists('field_onOff')) {
	function field_onOff($nameconfig,$config,$element) {
		global $storeid ;
		$onClassActive = null;
		$offClassActive = null;
		$onCheck = null;
		$offCheck = null;
		
		$names	= $nameconfig.'['.$storeid.']['.$element.']';
		$values	= isset($config[$storeid][$element]) ? $config[$storeid][$element] : '';
		
		(($values == 1)? $onClassActive ='btn-success active' : $offClassActive='btn-success active');
		(($values == 1)? $onCheck ='checked="checked"' : $offCheck='checked="checked"');
		
		$fieldOnOff  = '<div class="btn-group btn-toggle" data-toggle="buttons">';
		$fieldOnOff .= '<label class="btn btn-default btn-sm '.$onClassActive.'">';
		$fieldOnOff .= '<input type="radio" name="'.$names.'" value="1" '.$onCheck.'>ON';
		$fieldOnOff .= '</label>';
		$fieldOnOff .= '<label class="btn btn-default btn-sm '.$offClassActive.'">';
		$fieldOnOff .= '<input type="radio" name="'.$names.'" value="0" '.$offCheck.'>OFF';
		$fieldOnOff .= '</label>';
		$fieldOnOff .=	'</div>';
		return $fieldOnOff;
	}
}


if (!function_exists('field_onOffFont')) {
	function field_onOffFont($nameconfig,$config,$element) {
		global $storeid ;
		$onClassActive = null;
		$offClassActive = null;
		$onCheck = null;
		$offCheck = null;
		
		
		$names	= $nameconfig.'['.$storeid.']['.$element.']';
		$values	= $config[$storeid][$element];
		
		(($values == 'standard')? $onClassActive ='btn-success active' : $offClassActive='btn-success active');
		(($values == 'standard')? $onCheck ='checked="checked"' : $offCheck='checked="checked"');
		
		$fieldOnOff  = '<div class="btn-group btn-toggle block-group " data-toggle="buttons">';
		$fieldOnOff .= '<label class="btn btn-default btn-sm '.$onClassActive.'">';
		$fieldOnOff .= '<input class="type-fonts" type="radio" name="'.$names.'" value="standard" '.$onCheck.'>Standard';
		$fieldOnOff .= '</label>';
		$fieldOnOff .= '<label class="btn btn-default btn-sm '.$offClassActive.'">';
		$fieldOnOff .= '<input class="type-fonts" type="radio" name="'.$names.'" value="google" '.$offCheck.'>Google Fonts';
		$fieldOnOff .= '</label>';
		$fieldOnOff .=	'</div>';
		return $fieldOnOff;
	}
}

if (!function_exists('field_text')) {
	function field_text($nameconfig='',$config='',$element='',$placeholder=''){
		global $storeid ;
		$names	= $nameconfig.'['.$storeid.']['.$element.']';
		$values	= isset($config[$storeid][$element]) ? $config[$storeid][$element] : '';
		
		return '<input type="text" name="'.$names.'" value="'.$values.'" placeholder="'.$placeholder.'"  class="form-control" />';
	}
}

if (!function_exists('field_textarea')) {
	function field_textarea($nameconfig,$config,$element,$placeholder){
		global $storeid ;
		$names	= $nameconfig.'['.$storeid.']['.$element.']';
		$values	= $config[$storeid][$element];
		
		return '<textarea name="'.$names.'" rows="5" placeholder="'.$placeholder.'" id="input-description-'.$element.'-'.$storeid.'" class="form-control">'.$values.'</textarea>';
	}
}


if (!function_exists('field_select')) {
	function field_select($nameconfig,$config,$element,$element_array,$element_class =''){
		global $storeid ;
		$names	= $nameconfig.'['.$storeid.']['.$element.']';
		$values	= $config[$storeid][$element];
		
		$fieldSelect  = '<select name="'.$names.'"  class="form-control '.$element_class.'">';
		foreach ($element_array as $fv => $fc){
			($fv == $values) ? $current = 'selected' : $current='';
			$fieldSelect .= '<option value="'.$fv.'" '.$current.' >'.$fc.'</option>	';
		}
		$fieldSelect .= '</select>';
		return $fieldSelect;
	}
}

if (!function_exists('field_langHori')) {
	function field_langHori($languages,$storeid , $nameconfig,$config,$element){
		
			
		$fieldLangHori   = '<div class="tab-horizontal">';
		$fieldLangHori  .= '<ul class="nav nav-tabs main_tabs_horizontal">';
		
		foreach ($languages as $language){
			$active = $language['language_id'] == 1 ? 'active' : ' ';
			$fieldLangHori .= '<li class="'.$active.'">
			<a href="#language-'.$element.$language['language_id'].$storeid.'" data-toggle="tab"><img src="language/'.$language['code'].'/'.$language['code'].'.png" title="'.$language['name'].'" /> '.$language['name'].'</a>
			</li>';
		}
		$fieldLangHori .= '</ul>';
		$fieldLangHori .= '<div class="tab-content">';
		foreach ($languages as $language){
			$active = $language['language_id'] == 1 ? 'active' : ' ';
			$names	= $nameconfig.'['.$language['language_id'].']['.$storeid.']['.$element.']';
			$values	= isset($config[$language['language_id']][$storeid][$element])?$config[$language['language_id']][$storeid][$element]: '';
			
			$fieldLangHori .= '<div class="tab-pane '.$active.'" id="language-'.$element.$language['language_id'].$storeid.'">';
			$fieldLangHori .= '<input type="text" name="'.$names.'" value="'.$values.'"  class="form-control" />';
			$fieldLangHori .= '</div>';
		}
		$fieldLangHori .= '</div>';
		$fieldLangHori .= '</div>';
		
		return $fieldLangHori;
	}
}

?>