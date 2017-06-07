<?php
class ControllerModuleSomegamenu extends Controller {
    public function index($setting) {
        $this->load->model('module/so_megamenu');
        $this->document->addStyle('catalog/view/javascript/so_megamenu/so_megamenu.css');
        $this->document->addStyle('catalog/view/javascript/so_megamenu/wide-grid.css');
        $this->document->addScript('catalog/view/javascript/so_megamenu/so_megamenu.js');
		$module_id = (isset($setting['moduleid']) && $setting['moduleid']) ? $setting['moduleid'] : 0;
        $data['menu'] = $this->model_module_so_megamenu->getMenu($module_id);
		foreach($data['menu'] as &$menu){
			if(isset($menu['link']) && $menu['link']){
				$menu['link'] = trim($menu['link']);
				$link = (isset($menu['link']) && ($menu['link'])) ? unserialize($menu['link']) : array();
				$menu['route'] = '';
				$menu['path'] = '';
				if($link){
					if(isset($menu['type_link']) && $menu['type_link'] == 1){
						$menu['link'] = $this->url->link('product/category', 'path=' . $link['category']);
						$menu['route'] = 'product/category';
						$menu['path']	= $link['category'];
					}else
						$menu['link'] = $link['url'];
				}
				else
					$menu['link'] = '';
			}	
		}
        $lang_id = $this->config->get('config_language_id');
        $data['ustawienia'] = array(
            'orientation' => $setting['orientation'],
            'search_bar' => $setting['search_bar'],
            'navigation_text' => $setting['navigation_text'],
            'full_width' => $setting['full_width'],
            'home_item' => $setting['home_item'],
            'home_text' => $setting['home_text'],
            'animation' => $setting['animation'],
            'show_itemver' => $setting['show_itemver'],
            'animation_time' => $setting['animation_time'],
			'disp_title_module' => isset($setting['disp_title_module']) ? $setting['disp_title_module'] : ''
        );
        $data['navigation_text'] = 'Navigation';
        if(isset($setting['navigation_text'][$lang_id])) {
            if(!empty($setting['navigation_text'][$lang_id])) {
                $data['navigation_text'] = $setting['navigation_text'][$lang_id];
            }
        }
        if(isset($setting['head_name'][$lang_id])) {
            if(!empty($setting['head_name'][$lang_id])) {
                $data['head_name'] = $setting['head_name'][$lang_id];
            }
        }		
        $data['home_text'] = 'Home';
        if(isset($setting['home_text'][$lang_id])) {
            if(!empty($setting['home_text'][$lang_id])) {
                $data['home_text'] = $setting['home_text'][$lang_id];
            }
        }
        $data['home'] = $this->url->link('common/home');
        $data['lang_id'] = $this->config->get('config_language_id');
		
        // Search
        $this->language->load('common/header');
		
		// Check Version
		if(version_compare(VERSION, '2.1.0.2', '>')) {
			return $this->load->view('module/so_megamenu/default.tpl', $data);
		} else {
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/so_megamenu/default.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/module/so_megamenu/default.tpl', $data);
			} else {
				return $this->load->view('default/template/module/so_megamenu/default.tpl', $data);
			}
		}
		
        

    }
}
?>