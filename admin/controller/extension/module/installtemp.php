<?php
class ControllerExtensionModuleInstalltemp extends Controller {
	private $error = array(); 
	public function install() { 
		$this->load->model('installtemp/install');
       	$this->model_installtemp_install->settup();
		
       	$this->load->model('setting/setting');
       	$this->model_setting_setting->editSetting('installtemp', array('installtemp'=>1));
	}
	

	public function uninstall() { 
		$this->load->model('installtemp/install');
		$this->model_installtemp_install->reset(); 
	}
	
	public function index() {   
		$this->language->load('extension/module/installtemp');

		$this->document->setTitle($this->language->get('page_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('installtemp', $this->request->post);		
			
			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true));
		}

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_sample_data'] = $this->language->get('text_sample_data');

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], true)
   		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true)
		);
		
   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('extension/module/installtemp', 'token=' . $this->session->data['token'], true)
   		);
		
		$data['action'] = $this->url->link('extension/module/installtemp', 'token=' . $this->session->data['token'], true);

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);
		
		$data['token'] = $this->session->data['token'];

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/installtemp', $data));
	}
	
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/installtemp')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
}
?>