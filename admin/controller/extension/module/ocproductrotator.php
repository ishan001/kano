<?php 
class ControllerExtensionModuleOcproductrotator extends Controller
{
	private $error = array();

    public function install() {
        $config = array(
            'ocproductrotator_status'   => 1
        );

        $this->load->model('catalog/ocproductrotator');
        $this->load->model('setting/setting');

        $this->model_catalog_ocproductrotator->installProductRotator();
        $this->model_setting_setting->editSetting('ocproductrotator', $config);
    }

    public function index() {
        $this->load->language('extension/module/ocproductrotator');

        $this->document->setTitle($this->language->get('page_title'));

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $post_data = $this->request->post;

            // Parse all the coming data to Setting Model to save it in database.
            $this->model_setting_setting->editSetting('ocproductrotator', $post_data);

            // To display the success text on data save
            $this->session->data['success'] = $this->language->get('text_success');

            // Redirect to the Module Listing
            $this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true));
        }

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_edit'] = $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');

        $data['entry_status'] = $this->language->get('entry_status');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_extension'),
            'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/module/ocproductrotator', 'token=' . $this->session->data['token'], true)
        );

        $data['action'] = $this->url->link('extension/module/ocproductrotator', 'token=' . $this->session->data['token'], true);
        $data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);

        if (isset($this->request->post['ocproductrotator_status'])) {
            $data['ocproductrotator_status'] = $this->request->post['ocproductrotator_status'];
        } else {
            $data['ocproductrotator_status'] = $this->config->get('ocproductrotator_status');
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/ocproductrotator', $data));
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'extension/module/ocproductrotator')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }
}