<?php
class ControllerModuleSosearchpro extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('module/so_searchpro');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('extension/module');
		// Delete Module
		if( isset($this->request->get['module_id']) && isset($this->request->get['delete']) ){
			$this->model_extension_module->deleteModule( $this->request->get['module_id'] );
			$this->response->redirect($this->url->link('module/so_searchpro', 'token=' . $this->session->data['token'], 'SSL'));
		}
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$action = isset($this->request->post["action"]) ? $this->request->post["action"] : "";
			
			if (!isset($this->request->get['module_id'])) {
				$module_id = $this->addModule('so_searchpro', $this->request->post);
			} else {
				$module_id = $this->request->get['module_id'];
				$this->model_extension_module->editModule($this->request->get['module_id'], $this->request->post);
			}
			
			$this->session->data['success'] = $this->language->get('text_success');
			if($action == "save_edit") {
				$this->response->redirect($this->url->link('module/so_searchpro', 'module_id='.$module_id.'&token=' . $this->session->data['token'], 'SSL'));
			}elseif($action == "save_new"){
				$this->response->redirect($this->url->link('module/so_searchpro', 'token=' . $this->session->data['token'], 'SSL'));
			}else{
				$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
			}
		}

		$data['heading_title'] = $this->language->get('heading_title');
		$data['heading_title_so'] = $this->language->get('heading_title_so');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_yes'] 		= $this->language->get('text_yes');
		$data['text_no'] 		= $this->language->get('text_no');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_class'] = $this->language->get('entry_class');
		$data['entry_so_searchpro'] = $this->language->get('entry_so_searchpro');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_showcategory'] = $this->language->get('entry_showcategory');
		$data['entry_showimage'] = $this->language->get('entry_showimage');
		$data['entry_showprice'] = $this->language->get('entry_showprice');
		$data['entry_width'] = $this->language->get('entry_width');
		$data['entry_height'] = $this->language->get('entry_height');
		$data['entry_limit'] = $this->language->get('entry_limit');
		$data['entry_character'] = $this->language->get('entry_character');
		$data['entry_name_desc'] 	= $this->language->get('entry_name_desc');
		$data['entry_head_name_desc'] 			= $this->language->get('entry_head_name_desc');
		$data['entry_head_name'] 				= $this->language->get('entry_head_name');
		$data['entry_display_title_module']     = $this->language->get('entry_display_title_module');
		$data['entry_button_add'] 				= $this->language->get('entry_button_add');
		$data['entry_button_delete'] 			= $this->language->get('entry_button_delete');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_save_and_edit'] = $this->language->get('button_save_and_edit');
		$data['button_save_and_new'] = $this->language->get('button_save_and_new');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}
		
		if (isset($this->error['class'])) {
			$data['error_class'] = $this->error['class'];
		} else {
			$data['error_class'] = '';
		}		

		if (isset($this->error['width'])) {
			$data['error_width'] = $this->error['width'];
		} else {
			$data['error_width'] = '';
		}

		if (isset($this->error['height'])) {
			$data['error_height'] = $this->error['height'];
		} else {
			$data['error_height'] = '';
		}
		
		if (isset($this->error['limit'])) {
			$data['error_limit'] = $this->error['limit'];
		} else {
			$data['error_limit'] = '';
		}

		if (isset($this->error['character'])) {
			$data['error_character'] = $this->error['character'];
		} else {
			$data['error_character'] = '';
		}	

		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();
		foreach($data['languages'] as $language){
			$name = 'module_description['.$language['language_id']."]['head_name']";
			if (isset($this->error[$name])) {
				$data['error_head_name'] = $this->error[$name];
				break;
			} else {
				$data['error_head_name'] = '';
			}
		}	

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
		);

		if (!isset($this->request->get['module_id'])) {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('module/so_searchpro', 'token=' . $this->session->data['token'], 'SSL')
			);
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('module/so_searchpro', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL')
			);
		}

		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('module/so_searchpro', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$data['action'] = $this->url->link('module/so_searchpro', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL');
		}

		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_extension_module->getModule($this->request->get['module_id']);
		}
		else
			$module_info = array();

		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($module_info) && isset($module_info['name'])) {
			$data['name'] = $module_info['name'];
		} else {
			$data['name'] = '';
		}		
		
		if (isset($this->request->get['module_id'])) {
			$data['moduleid'] = $this->request->get['module_id'];
		} elseif (!empty($module_info) && isset($module_info['moduleid'])) {
			$data['moduleid'] = $module_info['moduleid'];
		} else {
			$data['moduleid'] = '';
		}
		
		if (isset($this->request->post['module_description'])) {
			$data['module_description'] = $this->request->post['module_description'];
		} elseif (!empty($module_info)) {
			$data['module_description'] = $module_info['module_description'];
		} else {
			$data['module_description'] = array();
		}
		
		if (isset($this->request->post['disp_title_module'])) {
			$data['disp_title_module'] = $this->request->post['disp_title_module'];
		} elseif (!empty($module_info) && isset($module_info['disp_title_module'])) {
			$data['disp_title_module'] = $module_info['disp_title_module'];
		} else {
			$data['disp_title_module'] = 1;
		}		
		
		if (isset($this->request->post['class'])) {
			$data['class'] = $this->request->post['class'];
		} elseif (!empty($module_info)) {
			$data['class'] = $module_info['class'];
		} else {
			$data['class'] = 'so-search';
		}		

		if (isset($this->request->post['showcategory'])) {
			$data['showcategory'] = $this->request->post['showcategory'];
		} elseif (!empty($module_info)) {
			$data['showcategory'] = $module_info['showcategory'];
		} else {
			$data['showcategory'] = 1;
		}

		if (isset($this->request->post['showimage'])) {
			$data['showimage'] = $this->request->post['showimage'];
		} elseif (!empty($module_info)) {
			$data['showimage'] = $module_info['showimage'];
		} else {
			$data['showimage'] = 1;
		}
		
		if (isset($this->request->post['showprice'])) {
			$data['showprice'] = $this->request->post['showprice'];
		} elseif (!empty($module_info)) {
			$data['showprice'] = $module_info['showprice'];
		} else {
			$data['showprice'] = 1 ;
		}		
	
		if (isset($this->request->post['height'])) {
			$data['height'] = $this->request->post['height'];
		} elseif (!empty($module_info)) {
			$data['height'] = $module_info['height'];
		} else {
			$data['height'] = 100;
		}
		
		if (isset($this->request->post['width'])) {
			$data['width'] = $this->request->post['width'];
		} elseif (!empty($module_info)) {
			$data['width'] = $module_info['width'];
		} else {
			$data['width'] = 100;
		}

		if (isset($this->request->post['character'])) {
			$data['character'] = $this->request->post['character'];
		} elseif (!empty($module_info)) {
			$data['character'] = $module_info['character'];
		} else {
			$data['character'] = 3;
		}
		
		if (isset($this->request->post['limit'])) {
			$data['limit'] = $this->request->post['limit'];
		} elseif (!empty($module_info)) {
			$data['limit'] = $module_info['limit'];
		} else {
			$data['limit'] = 5;
		}		

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($module_info)) {
			$data['status'] = $module_info['status'];
		} else {
			$data['status'] = 1;
		}		
		
		// ---------------------------Load module --------------------------------------------
		$data['modules'] = array( 0=> $module_info );
		$data['moduletabs'] = $this->model_extension_module->getModulesByCode( 'so_searchpro');
		$data['link'] = $this->url->link('module/so_searchpro', 'token=' . $this->session->data['token'] . '', 'SSL');

		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('module/so_searchpro.tpl', $data));
	}
	
	public function addModule($code, $data) {
		$this->db->query("INSERT INTO `" . DB_PREFIX . "module` SET `name` = '" . $this->db->escape($data['name']) . "', `code` = '" . $this->db->escape($code) . "', `setting` = '" . $this->db->escape(json_encode($data)) . "'");
		$result = $this->db->query("SELECT LAST_INSERT_ID() as module_id");
		return $result->row['module_id'];
	}	

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/so_searchpro')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}

		$this->load->model('localisation/language');
		$languages = $this->model_localisation_language->getLanguages();
		
		foreach($languages as $language){
			$module_description = $this->request->post['module_description'];
			if ((utf8_strlen($module_description[$language['language_id']]['head_name']) < 3) || (utf8_strlen($module_description[$language['language_id']]['head_name']) > 64)) {
				$this->error['module_description['.$language['language_id']."]['head_name']"] = $this->language->get('error_head_name');
			}
		}
		
		if ($this->request->post['width'] != '0' && !filter_var($this->request->post['width'],FILTER_VALIDATE_INT) || $this->request->post['width'] < 0) {
			$this->error['width'] = $this->language->get('error_width');
		}
		
		if ($this->request->post['height'] != '0' && !filter_var($this->request->post['height'],FILTER_VALIDATE_INT) || $this->request->post['height'] < 0) {
			$this->error['height'] = $this->language->get('error_height');
		}		

		if ($this->request->post['limit'] != '0' && !filter_var($this->request->post['limit'],FILTER_VALIDATE_INT) || $this->request->post['limit'] < 0) {
			$this->error['limit'] = $this->language->get('error_limit');
		}
		
		if ($this->request->post['character'] != '0' && !filter_var($this->request->post['character'],FILTER_VALIDATE_INT) || $this->request->post['character'] < 0) {
			$this->error['character'] = $this->language->get('error_character');
		}

		return !$this->error;
	}
}