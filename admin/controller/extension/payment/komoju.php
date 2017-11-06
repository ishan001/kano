<?php

class ControllerExtensionPaymentKomoju extends Controller
{
    private $error = [];

    public function index()
    {
        $this->load->language('extension/payment/komoju');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

            $this->model_setting_setting->editSetting('komoju', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', true));
        }

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_edit'] = $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_all_zones'] = $this->language->get('text_all_zones');
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');
        $data['text_authorization'] = $this->language->get('text_authorization');
        $data['text_sale'] = $this->language->get('text_sale');

        $data['entry_merchant_uuid'] = $this->language->get('entry_merchant_uuid');
        $data['entry_test'] = $this->language->get('entry_test');
        $data['entry_secret_key'] = $this->language->get('entry_secret_key');
        $data['entry_debug'] = $this->language->get('entry_debug');
        $data['entry_total'] = $this->language->get('entry_total');
        $data['entry_transaction'] = $this->language->get('entry_transaction');
        $data['entry_order_status'] = $this->language->get('entry_order_status');
        $data['entry_voided_status'] = $this->language->get('entry_voided_status');
        $data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_sort_order'] = $this->language->get('entry_sort_order');

        $data['help_test'] = $this->language->get('help_test');
        $data['help_debug'] = $this->language->get('help_debug');
        $data['help_total'] = $this->language->get('help_total');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        $data['tab_general'] = $this->language->get('tab_general');
        $data['tab_order_status'] = $this->language->get('tab_order_status');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['email'])) {
            $data['error_email'] = $this->error['email'];
        } else {
            $data['error_email'] = '';
        }

        $data['breadcrumbs'] = [];

        $data['breadcrumbs'][] = [
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true),
        ];

        $data['breadcrumbs'][] = [
            'text' => $this->language->get('text_extension'),
            'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', true),
        ];

        $data['breadcrumbs'][] = [
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/payment/komoju', 'token=' . $this->session->data['token'], true),
        ];

        $data['action'] = $this->url->link('extension/payment/komoju', 'token=' . $this->session->data['token'], true);

        $data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', true);

        if (isset($this->request->post['komoju_merchant_uuid'])) {
            $data['komoju_merchant_uuid'] = $this->request->post['komoju_merchant_uuid'];
        } else {
            $data['komoju_merchant_uuid'] = $this->config->get('komoju_merchant_uuid');
        }

        if (isset($this->request->post['komoju_secret_key'])) {
            $data['komoju_secret_key'] = $this->request->post['komoju_secret_key'];
        } else {
            $data['komoju_secret_key'] = $this->config->get('komoju_secret_key');
        }

        if (isset($this->request->post['komoju_transaction'])) {
            $data['komoju_transaction'] = $this->request->post['komoju_transaction'];
        } else {
            $data['komoju_transaction'] = $this->config->get('komoju_transaction');
        }

        if (isset($this->request->post['komoju_test'])) {
            $data['komoju_test'] = $this->request->post['komoju_test'];
        } else {
            $data['komoju_test'] = $this->config->get('komoju_test');
        }

        $this->load->model('localisation/order_status');

        $data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

        if (isset($this->request->post['komoju_geo_zone_id'])) {
            $data['komoju_geo_zone_id'] = $this->request->post['komoju_geo_zone_id'];
        } else {
            $data['komoju_geo_zone_id'] = $this->config->get('komoju_geo_zone_id');
        }

        $this->load->model('localisation/geo_zone');

        $data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

        if (isset($this->request->post['komoju_status'])) {
            $data['komoju_status'] = $this->request->post['komoju_status'];
        } else {
            $data['komoju_status'] = $this->config->get('komoju_status');
        }

        if (isset($this->request->post['komoju_sort_order'])) {
            $data['komoju_sort_order'] = $this->request->post['komoju_sort_order'];
        } else {
            $data['komoju_sort_order'] = $this->config->get('komoju_sort_order');
        }

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['merchant_uuid'])) {
            $data['error_merchant_uuid'] = $this->error['merchant_uuid'];
        } else {
            $data['error_merchant_uuid'] = '';
        }

        if (isset($this->error['secret_key'])) {
            $data['error_secret_key'] = $this->error['secret_key'];
        } else {
            $data['error_secret_key'] = '';
        }

        if (isset($this->error['signature'])) {
            $data['error_signature'] = $this->error['signature'];
        } else {
            $data['error_signature'] = '';
        }


        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/payment/komoju', $data));
    }

    private function validate()
    {
        if (!$this->user->hasPermission('modify', 'extension/payment/komoju')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (!$this->request->post['komoju_merchant_uuid']) {
            $this->error['merchant_uuid'] = $this->language->get('error_merchant_uuid');
        }

        if (!$this->request->post['komoju_secret_key']) {
            $this->error['secret_key'] = $this->language->get('error_secret_key');
        }

        return !$this->error;
    }
}