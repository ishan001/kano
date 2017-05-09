<?php
class ControllerModuleNewsletters extends Controller {
	public function index() {
		$this->load->language('module/newsletter');
		$this->load->model('module/newsletters');
		
		$this->model_module_newsletters->createNewsletter();

		$data['heading_title'] = $this->language->get('heading_title');
		$data['description'] = $this->language->get('description');

		$data['text_brands'] = $this->language->get('text_brands');
		$data['text_index'] = $this->language->get('text_index');
		
		$data['brands'] = array();
		
		return $this->load->view('module/newsletters', $data);
	}
	public function news()
	{
		$this->load->model('module/newsletters');
		
		$json = array();
		$json['message'] = $this->model_module_newsletters->subscribes($this->request->post);
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
		
	}
	
}
