<?php
class ControllerExtensionModuleOcsearchcategory extends Controller {
    private $error = array();

    public function install() {

        $config = array(
            'ocsearchcategory_status' => 1,
            'ocsearchcategory_ajax_enabled' => 1,
            'ocsearchcategory_product_img' => 1,
            'ocsearchcategory_product_price' => 1,
            'ocsearchcategory_loader_img' => 'catalog/AjaxLoader.gif'
        );
        $this->load->model('setting/setting');
        $this->model_setting_setting->editSetting('ocsearchcategory', $config);

    }

    public function index() {
        $this->load->language('extension/module/ocsearchcategory');

        $this->document->setTitle($this->language->get('page_title'));

        $this->load->model('setting/setting');
        $this->load->model('tool/image');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $post_data = $this->request->post;

            $this->model_setting_setting->editSetting('ocsearchcategory', $post_data);

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
        $data['entry_ajax_enabled'] = $this->language->get('entry_ajax_enabled');
        $data['entry_image'] = $this->language->get('entry_image');
        $data['entry_product_image'] = $this->language->get('entry_product_image');
        $data['entry_product_price'] = $this->language->get('entry_product_price');

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
            'href' => $this->url->link('extension/module/ocsearchcategory', 'token=' . $this->session->data['token'], true)
        );

        $data['action'] = $this->url->link('extension/module/ocsearchcategory', 'token=' . $this->session->data['token'], true);

        $data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);

        if (isset($this->request->post['ocsearchcategory_status'])) {
            $data['ocsearchcategory_status'] = $this->request->post['ocsearchcategory_status'];
        } else {
            $data['ocsearchcategory_status'] = $this->config->get('ocsearchcategory_status');
        }

        if (isset($this->request->post['ocsearchcategory_ajax_enabled'])) {
            $data['ocsearchcategory_ajax_enabled'] = $this->request->post['ocsearchcategory_ajax_enabled'];
        } else {
            $data['ocsearchcategory_ajax_enabled'] = $this->config->get('ocsearchcategory_ajax_enabled');
        }

        if (isset($this->request->post['ocsearchcategory_product_img'])) {
            $data['ocsearchcategory_product_img'] = $this->request->post['ocsearchcategory_product_img'];
        } else {
            $data['ocsearchcategory_product_img'] = $this->config->get('ocsearchcategory_product_img');
        }

        if (isset($this->request->post['ocsearchcategory_product_price'])) {
            $data['ocsearchcategory_product_price'] = $this->request->post['ocsearchcategory_product_price'];
        } else {
            $data['ocsearchcategory_product_price'] = $this->config->get('ocsearchcategory_product_price');
        }

        if (isset($this->request->post['ocsearchcategory_loader_img'])) {
            $data['ocsearchcategory_loader_img'] = $this->request->post['ocsearchcategory_loader_img'];
        } else {
            $data['ocsearchcategory_loader_img'] = $this->config->get('ocsearchcategory_loader_img');
        }

        if (isset($this->request->post['ocsearchcategory_loader_img']) && is_file(DIR_IMAGE . $this->request->post['ocsearchcategory_loader_img'])) {
            $data['thumb'] = $this->model_tool_image->resize($this->request->post['ocsearchcategory_loader_img'], 50, 50);
        } elseif (is_file(DIR_IMAGE . $this->config->get('ocsearchcategory_loader_img'))) {
            $data['thumb'] = $this->model_tool_image->resize($this->config->get('ocsearchcategory_loader_img'), 50, 50);
        } else {
            $data['thumb'] = $this->model_tool_image->resize('no_image.png', 50, 50);
        }
        $data['placeholder'] = $this->model_tool_image->resize('no_image.png', 50, 50);

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/ocsearchcategory.tpl', $data));
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'extension/module/ocsearchcategory')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }
}