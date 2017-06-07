<?php
class ControllerExtensionModuleOcajaxlogin extends Controller {
    private $error = array();

    public function install() {
        $config = array(
            'ocajaxlogin_status' => 1,
            'ocajaxlogin_loader_img' => 'catalog/AjaxLoader.gif'
        );
        $this->load->model('setting/setting');
        $this->model_setting_setting->editSetting('ocajaxlogin', $config);
    }

    public function index() {
        $this->load->language('extension/module/ocajaxlogin');

        $this->document->setTitle($this->language->get('page_title'));

        $this->load->model('setting/setting');
        $this->load->model('tool/image');
        $this->load->model('extension/module');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('ocajaxlogin', $this->request->post);

            $this->cache->delete('product');

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

        $data['entry_image'] = $this->language->get('entry_image');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_redirect_status'] = $this->language->get('entry_redirect_status');
        $data['entry_loader_img'] = $this->language->get('entry_loader_img');

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
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_extension'),
            'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/module/ocajaxlogin', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['action'] = $this->url->link('extension/module/ocajaxlogin', 'token=' . $this->session->data['token'], 'SSL');

        $data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);

        if (isset($this->request->post['ocajaxlogin_status'])) {
            $data['ocajaxlogin_status'] = $this->request->post['ocajaxlogin_status'];
        } else {
            $data['ocajaxlogin_status'] = $this->config->get('ocajaxlogin_status');
        }

        if (isset($this->request->post['ocajaxlogin_redirect_status'])) {
            $data['ocajaxlogin_redirect_status'] = $this->request->post['ocajaxlogin_redirect_status'];
        } else {
            $data['ocajaxlogin_redirect_status'] = $this->config->get('ocajaxlogin_redirect_status');
        }

        if (isset($this->request->post['ocajaxlogin_loader_img'])) {
            $data['ocajaxlogin_loader_img'] = $this->request->post['ocajaxlogin_loader_img'];
        } else {
            $data['ocajaxlogin_loader_img'] = $this->config->get('ocajaxlogin_loader_img');
        }

        if (isset($this->request->post['ocajaxlogin_loader_img']) && is_file(DIR_IMAGE . $this->request->post['ocajaxlogin_loader_img'])) {
            $data['thumb'] = $this->model_tool_image->resize($this->request->post['ocajaxlogin_loader_img'], 50, 50);
        } elseif (is_file(DIR_IMAGE . $this->config->get('ocajaxlogin_loader_img'))) {
            $data['thumb'] = $this->model_tool_image->resize($this->config->get('ocajaxlogin_loader_img'), 50, 50);
        } else {
            $data['thumb'] = $this->model_tool_image->resize('no_image.png', 50, 50);
        }

        $data['placeholder'] = $this->model_tool_image->resize('no_image.png', 50, 50);

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/ocajaxlogin', $data));
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'extension/module/ocajaxlogin')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }
}