<?php
class ControllerExtensionModuleOccmsblock extends Controller {
	private $error = array();
	
	public function install() {
		$this->load->model('cmsblock/info');
       	$this->model_cmsblock_info->install();
       	$this->load->model('setting/setting');
	}
	
	public function uninstall() { 
		$this->load->model('cmsblock/info');
        $this->model_cmsblock_info->uninstall();
        $this->load->model('setting/setting');
	}
	
	public function index() {
		$this->load->language('extension/module/occmsblock');

		$this->document->setTitle($this->language->get('page_title'));

		$this->load->model('extension/module');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (!isset($this->request->get['module_id'])) {
				$this->model_extension_module->addModule('occmsblock', $this->request->post);
			} else {
				$this->model_extension_module->editModule($this->request->get['module_id'], $this->request->post);
			}
			
			$this->cache->delete('product');

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true));
		}

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_cmsblock_slide'] = $this->language->get('text_cmsblock_slide');
		$data['text_cmsblock'] = $this->language->get('text_cmsblock');
		
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_limit'] = $this->language->get('entry_limit');
		$data['entry_width'] = $this->language->get('entry_width');
		$data['entry_height'] = $this->language->get('entry_height');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_position'] = $this->language->get('entry_position');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_cmsblock'] = $this->language->get('entry_cmsblock');
		$data['entry_store'] = $this->language->get('entry_store');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

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

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true)
		);

		if (!isset($this->request->get['module_id'])) {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('extension/module/occmsblock', 'token=' . $this->session->data['token'], true)
			);
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('extension/module/occmsblock', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], true)
			);			
		}

		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('extension/module/occmsblock', 'token=' . $this->session->data['token'], true);
		} else {
			$data['action'] = $this->url->link('extension/module/occmsblock', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], true);
		}
		
		$data['cms_link'] = $this->url->link('extension/module/occmsblock/cmslist', 'token=' . $this->session->data['token'], true);

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);
		
		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_extension_module->getModule($this->request->get['module_id']);
		}
		
		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($module_info)) {
			$data['name'] = $module_info['name'];
		} else {
			$data['name'] = '';
		}
		
		if (isset($this->request->post['cmsblock'])) {
			$data['cmsblock'] = $this->request->post['cmsblock'];
		} elseif (!empty($module_info)) {
			$data['cmsblock'] = $module_info['cmsblock'];
		} else {
			$data['cmsblock'] = '';
		}
		
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($module_info)) {
			$data['status'] = $module_info['status'];
		} else {
			$data['status'] = '';
		}
		
		$this->load->model('cmsblock/info');
		$data['cmsblocks'] = $this->model_cmsblock_info->getcmsblocks();

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/occmsblock/config.tpl', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/occmsblock')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}
		
		return !$this->error;
	}

	public function cmslist() {
		$this->language->load('extension/module/occmsblock');

		$this->document->setTitle($this->language->get('page_title'));
		
		$data['action'] = $this->url->link('extension/module/occmsblock', 'token=' . $this->session->data['token'], true);
		$data['cms_link'] = $this->url->link('extension/module/occmsblock/cmslist', 'token=' . $this->session->data['token'], true);

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);
		
		$data['token'] = $this->session->data['token'];

		$data['modules'] = array();
		 
		$this->load->model('cmsblock/info');

		$this->getList();
	}

	public function insert() {
		$this->language->load('extension/module/occmsblock');

		$this->document->setTitle($this->language->get('page_title'));
		
		$this->load->model('cmsblock/info');
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			
			$this->model_cmsblock_info->addcmsblock($this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			
			$this->response->redirect($this->url->link('extension/module/occmsblock/cmslist', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}

	public function update() {
		$this->language->load('extension/module/occmsblock');

		$this->document->setTitle($this->language->get('page_title'));
		
		$this->load->model('cmsblock/info');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) { 
			$this->model_cmsblock_info->editCmsblock($this->request->get['cmsblock_id'], $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$this->response->redirect($this->url->link('extension/module/occmsblock/cmslist', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}
 
	public function delete() {
		$this->language->load('extension/module/occmsblock');

		$this->document->setTitle($this->language->get('page_title'));
		
		$this->load->model('cmsblock/info');
		
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $cmsblock_id) {
				$this->model_cmsblock_info->deletecmsblock($cmsblock_id);
			}
			
			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$this->response->redirect($this->url->link('extension/module/occmsblock', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getList();
	}

	protected function getList() {
		$this->language->load('extension/module/occmsblock');

		$this->document->setTitle($this->language->get('page_title'));

		$data['text_list'] = $this->language->get('text_list');
		$data['text_confirm'] = $this->language->get('text_confirm');

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'id.title';
		}
		
		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		
		$url = '';
			
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
   		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true)
		);
		
   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('extension/module/occmsblock', 'token=' . $this->session->data['token'], true)
   		);
							
		$data['insert'] = $this->url->link('extension/module/occmsblock/insert', 'token=' . $this->session->data['token'] . $url, true);
		$data['delete'] = $this->url->link('extension/module/occmsblock/delete', 'token=' . $this->session->data['token'] . $url, true);

		$data['infos'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$info_total = $this->model_cmsblock_info->getTotalcmsblocks();
	
		$results = $this->model_cmsblock_info->getcmsblocks($filter_data);
		//echo "<Pre>"; print_r($results); 
		$data['cmsblocks'] = array();
		if($results) {
			foreach ($results as $result) {
				$action = array();
							
				$action[] = array(
					'text' => $this->language->get('text_edit'),
					'href' => $this->url->link('extension/module/occmsblock/update', 'token=' . $this->session->data['token'] . '&cmsblock_id=' . $result['cmsblock_id'] . $url, true)
				);

							
				$data['cmsblocks'][] = array(
					'cmsblock_id' => $result['cmsblock_id'],
					'title'          => $result['title'],
					'status'          => $result['status'],
					'sort_order'     => $result['sort_order'],
					'selected'       => isset($this->request->post['selected']) && in_array($result['cmsblock_id'], $this->request->post['selected']),
					'action'         => $action
				);
			}	
		}
	
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_no_results'] = $this->language->get('text_no_results');

		$data['column_title'] = $this->language->get('column_title');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_sort_order'] = $this->language->get('column_sort_order');
		$data['column_action'] = $this->language->get('column_action');		
		
		$data['button_add'] = $this->language->get('button_add');
		$data['button_delete'] = $this->language->get('button_delete');
 
 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		$data['sort_title'] = $this->url->link('cmsblock', 'token=' . $this->session->data['token'] . '&sort=id.title' . $url, true);
		$data['sort_sort_order'] = $this->url->link('cmsblock', 'token=' . $this->session->data['token'] . '&sort=i.sort_order' . $url, true);
		
		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
												
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $info_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('extension/module/occmsblock/cmslist', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);
			

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($info_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($info_total - $this->config->get('config_limit_admin'))) ? $info_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $info_total, ceil($info_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;
			
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/occmsblock/cmsblock_list.tpl', $data));
	}

	protected function getForm() {
		$data['heading_title'] = $this->language->get('page_title');

		$data['text_default'] = $this->language->get('text_default');
		$data['text_enabled'] = $this->language->get('text_enabled');
    	$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_link'] = $this->language->get('text_link');
    	$data['text_description'] = $this->language->get('text_description');
		
		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_description'] = $this->language->get('entry_description');
		$data['entry_store'] = $this->language->get('entry_store');
		$data['entry_keyword'] = $this->language->get('entry_keyword');
		$data['entry_bottom'] = $this->language->get('entry_bottom');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_identify'] = $this->language->get('entry_identify');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_layout'] = $this->language->get('entry_layout');
		$data['entry_link'] = $this->language->get('entry_link');
		$data['entry_type'] = $this->language->get('entry_type');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
    	
		$data['tab_general'] = $this->language->get('tab_general');
    	$data['tab_data'] = $this->language->get('tab_data');
		$data['tab_design'] = $this->language->get('tab_design');

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

 		if (isset($this->error['title'])) {
			$data['error_title'] = $this->error['title'];
		} else {
			$data['error_title'] = array();
		}
		 if (isset($this->error['identify'])) {
			$data['error_identify'] = $this->error['identify'];
		} else {
			$data['error_identify'] = array();
		}
	 	if (isset($this->error['description'])) {
			$data['error_description'] = $this->error['description'];
		} else {
			$data['error_description'] = array();
		}
		
		$url = '';
			
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
   		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
				'text'      => $this->language->get('heading_title'),
				'href'      => $this->url->link('extension/module/occmsblock', 'token=' . $this->session->data['token'], true)
		);
							
		if (!isset($this->request->get['cmsblock_id'])) {
			$data['action'] = $this->url->link('extension/module/occmsblock/insert', 'token=' . $this->session->data['token'] . $url, true);
		} else {
			$data['action'] = $this->url->link('extension/module/occmsblock/update', 'token=' . $this->session->data['token'] . '&cmsblock_id=' . $this->request->get['cmsblock_id'] . $url, true);
		}
		
		$data['cancel'] = $this->url->link('extension/module/occmsblock', 'token=' . $this->session->data['token'] . $url, true);

		if (isset($this->request->get['cmsblock_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$info_info = $this->model_cmsblock_info->getCmsBlockInfo($this->request->get['cmsblock_id']);
		}
		
		$data['token'] = $this->session->data['token'];
		
		$this->load->model('localisation/language');
		
		$data['languages'] = $this->model_localisation_language->getLanguages();
		
		if (isset($this->request->post['cmsblock_description'])) {
			$data['cmsblock_description'] = $this->request->post['cmsblock_description'];
		} elseif (isset($this->request->get['cmsblock_id'])) {
			$data['cmsblock_description'] = $this->model_cmsblock_info->getcmsblockDescriptions($this->request->get['cmsblock_id']);
		} else {
			$data['cmsblock_description'] = array();
		}

		$this->load->model('setting/store');
		
		$data['stores'] = $this->model_setting_store->getStores();
		$data['stores'][] = array('store_id'=>0,'name'=>'Default Store');
		if (isset($this->request->post['info_store'])) {
			$data['info_store'] = $this->request->post['info_store'];
		} elseif (isset($this->request->get['cmsblock_id'])) {
			$data['info_store'] = $this->model_cmsblock_info->getCmsblockStores($this->request->get['cmsblock_id']);
		} else {
			$data['info_store'] = array(0);
		}		

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($info_info)) {
			$data['status'] = $info_info['status'];
		} else {
			$data['status'] = 1;
		}
			
		if (isset($this->request->post['type'])) {
			$data['type'] = $this->request->post['type'];
		} elseif (!empty($info_info)) {
			$data['type'] = $info_info['type'];
		} else {
			$data['type'] = 1;
		}
				
		if (isset($this->request->post['sort_order'])) {
			$data['sort_order'] = $this->request->post['sort_order'];
		} elseif (!empty($info_info)) {
			$data['sort_order'] = $info_info['sort_order'];
		} else {
			$data['sort_order'] = '';
		}

		if (isset($this->request->post['identify'])) {
			$data['identify'] = $this->request->post['identify'];
		} elseif (!empty($info_info)) {
			$data['identify'] = $info_info['identify'];
		} else {
			$data['identify'] = '';
		}
		
		if (isset($this->request->post['link'])) {
			$data['link'] = $this->request->post['link'];
		} elseif (!empty($info_info)) {
			$data['link'] = $info_info['link'];
		} else {
			$data['link'] = '';
		}

		$this->load->model('design/layout');
		$data['layouts'] = $this->model_design_layout->getLayouts();
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/occmsblock/cmsblock_form.tpl', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'extension/module/occmsblock')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}
			
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'extension/module/occmsblock')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		$this->load->model('setting/store');

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
}
?>