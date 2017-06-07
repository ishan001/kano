<?php
class ControllerExtensionModuleOclayerednavigation extends Controller
{
    private $error = array();

    public function install() {

        $this->load->model('setting/setting');
        $this->load->model('design/layout');

        $data = array(
            'oclayerednavigation_status' => 1,
            'oclayerednavigation_loader_img' => 'catalog/AjaxLoader.gif'
        );

        $this->model_setting_setting->editSetting('oclayerednavigation', $data);

    }

    public function index() {
        $this->load->language('extension/module/oclayerednavigation');

        $this->document->setTitle($this->language->get('page_title'));

        $this->load->model('setting/setting');

        $this->load->model('tool/image');

        $post_data = $this->request->post;

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('oclayerednavigation', $post_data);

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
            'href' => $this->url->link('extension/module/oclayerednavigation', 'token=' . $this->session->data['token'], true)
        );

        $data['action'] = $this->url->link('extension/module/oclayerednavigation', 'token=' . $this->session->data['token'], true);

        $data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);

        if (isset($this->request->post['oclayerednavigation_status'])) {
            $data['oclayerednavigation_status'] = $this->request->post['oclayerednavigation_status'];
        } else {
            $data['oclayerednavigation_status'] = $this->config->get('oclayerednavigation_status');
        }

        if (isset($this->request->post['oclayerednavigation_loader_img'])) {
            $data['oclayerednavigation_loader_img'] = $this->request->post['oclayerednavigation_loader_img'];
        } else {
            $data['oclayerednavigation_loader_img'] = $this->config->get('oclayerednavigation_loader_img');
        }

        if (isset($this->request->post['oclayerednavigation_loader_img']) && is_file(DIR_IMAGE . $this->request->post['oclayerednavigation_loader_img'])) {
            $data['thumb'] = $this->model_tool_image->resize($this->request->post['oclayerednavigation_loader_img'], 50, 50);
        } elseif (is_file(DIR_IMAGE . $this->config->get('oclayerednavigation_loader_img'))) {
            $data['thumb'] = $this->model_tool_image->resize($this->config->get('oclayerednavigation_loader_img'), 50, 50);
        } else {
            $data['thumb'] = $this->model_tool_image->resize('no_image.png', 50, 50);
        }

        $data['placeholder'] = $this->model_tool_image->resize('no_image.png', 50, 50);

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/oclayerednavigation', $data));
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'extension/module/oclayerednavigation')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }

}