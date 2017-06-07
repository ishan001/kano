<?php
class ControllerExtensionModuleOcquickview extends Controller 
{
	private $error = array();

	public function install() {
		$config = array(
            'ocquickview_status' => 1,
            'ocquickview_loader_img' => 'catalog/AjaxLoader.gif'
        );
        $this->load->model('setting/setting');
        $this->model_setting_setting->editSetting('ocquickview', $config);
	}

	public function index() {
        $this->load->language('extension/module/ocquickview');

        $this->document->setTitle($this->language->get('page_title'));

        $this->load->model('setting/setting');
        $this->load->model('tool/image');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $post_data = $this->request->post;

            $this->model_setting_setting->editSetting('ocquickview', $post_data);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true));
        }

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_edit'] = $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_module'] = $this->language->get('text_module');
        $data['text_edit'] = $this->language->get('text_edit');
        $data['text_success'] = $this->language->get('text_success');

        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_image'] = $this->language->get('entry_image');
        $data['entry_container'] = $this->language->get('entry_container');
        $data['entry_parent_element'] = $this->language->get('entry_parent_element');
        $data['entry_children_element'] = $this->language->get('entry_children_element');

        $data['help_quickview'] = $this->language->get('help_quickview');
        $data['note_guide'] = $this->language->get('note_guide');

        $data['button_upload'] = $this->language->get('button_upload');
        $data['button_clear'] = $this->language->get('button_clear');
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
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_extension'),
            'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/module/ocquickview', 'token=' . $this->session->data['token'], true)
        );

        $data['action'] = $this->url->link('extension/module/ocquickview', 'token=' . $this->session->data['token'], true);

        $data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);

        if (isset($this->request->post['ocquickview_status'])) {
            $data['ocquickview_status'] = $this->request->post['ocquickview_status'];
        } else {
            $data['ocquickview_status'] = $this->config->get('ocquickview_status');
        }

        if (isset($this->request->post['ocquickview_container'])) {
            $data['ocquickview_container'] = $this->request->post['ocquickview_container'];
        } else {
            $data['ocquickview_container'] = $this->config->get('ocquickview_container');
        }

        if (isset($this->request->post['ocquickview_children_element'])) {
            $data['ocquickview_children_element'] = $this->request->post['ocquickview_children_element'];
        } else {
            $data['ocquickview_children_element'] = $this->config->get('ocquickview_children_element');
        }

        if (isset($this->request->post['ocquickview_parent_element'])) {
            $data['ocquickview_parent_element'] = $this->request->post['ocquickview_parent_element'];
        } else {
            $data['ocquickview_parent_element'] = $this->config->get('ocquickview_parent_element');
        }

        if (isset($this->request->post['ocquickview_loader_img'])) {
            $data['ocquickview_loader_img'] = $this->request->post['ocquickview_loader_img'];
        } else {
            $data['ocquickview_loader_img'] = $this->config->get('ocquickview_loader_img');
        }

        if (isset($this->request->post['ocquickview_loader_img']) && is_file(DIR_IMAGE . $this->request->post['ocquickview_loader_img'])) {
            $data['thumb'] = $this->model_tool_image->resize($this->request->post['ocquickview_loader_img'], 50, 50);
        } elseif (is_file(DIR_IMAGE . $this->config->get('ocquickview_loader_img'))) {
            $data['thumb'] = $this->model_tool_image->resize($this->config->get('ocquickview_loader_img'), 50, 50);
        } else {
            $data['thumb'] = $this->model_tool_image->resize('no_image.png', 50, 50);
        }

        $data['placeholder'] = $this->model_tool_image->resize('no_image.png', 50, 50);

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/ocquickview', $data));
	}

	protected function validate() {
        if (!$this->user->hasPermission('modify', 'extension/module/ocquickview')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }
}