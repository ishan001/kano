<?php
class ControllerModuleSohtmlcontent extends Controller {
	public function index($setting) {
		
		
		
		if (isset($setting['module_description'][$this->config->get('config_language_id')])) {
			$data['heading_title'] = html_entity_decode($setting['module_description'][$this->config->get('config_language_id')]['title'], ENT_QUOTES, 'UTF-8');
			$data['html'] = html_entity_decode($setting['module_description'][$this->config->get('config_language_id')]['description'], ENT_QUOTES, 'UTF-8');
			if(!isset($setting['class_suffix'])) $setting['class_suffix'] = '';
			$data['class_suffix'] 	= $setting['class_suffix'] ;
			
			//var_dump($data['class_suffix'] );die();
			// Check Version
			if(version_compare(VERSION, '2.1.0.2', '>')) {
				return $this->load->view('module/so_html_content/default.tpl', $data);
			} else {
				if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/so_html_content/default.tpl')) {
					return $this->load->view($this->config->get('config_template') . '/template/module/so_html_content/default.tpl', $data);
				} else {
					return $this->load->view('default/template/module/so_html_content/default.tpl', $data);
				}
			}
			
		}
	}
}
