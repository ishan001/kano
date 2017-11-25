<?php
class ControllerExtensionPaymentKomoju extends Controller {
    public function index() {
        $this->load->language('extension/payment/komoju');

        $data['text_credit_card'] = $this->language->get('text_credit_card');
        $data['text_start_date'] = $this->language->get('text_start_date');
        $data['text_wait'] = $this->language->get('text_wait');
        $data['text_loading'] = $this->language->get('text_loading');

        $data['entry_cc_type'] = $this->language->get('entry_cc_type');
        $data['entry_cc_number'] = $this->language->get('entry_cc_number');
        $data['entry_cc_expire_date'] = $this->language->get('entry_cc_expire_date');
        $data['entry_cc_cvv2'] = $this->language->get('entry_cc_cvv2');

        $data['help_start_date'] = $this->language->get('help_start_date');
        $data['help_issue'] = $this->language->get('help_issue');

        $data['button_confirm'] = $this->language->get('button_confirm');

        $data['cards'] =[
            [
                'text'  => 'Visa',
                'value' => 'VISA'
            ],
            [
                'text'  => 'MasterCard',
                'value' => 'MASTERCARD'
            ],
            [
                'text'  => 'American Express',
                'value' => 'AMEX'
            ],
            [
                'text'  => 'JCB',
                'value' => 'JCB'
            ],
            [
                'text'  => 'Diners Club ',
                'value' => 'DINERS_CLUB'
            ]
        ];

        $data['months'] = array();

        for ($i = 1; $i <= 12; $i++) {
            $data['months'][] = array(
                'text'  => strftime('%B', mktime(0, 0, 0, $i, 1, 2000)),
                'value' => $i
            );
        }

        $today = getdate();

        $data['year_valid'] = array();

        for ($i = $today['year'] - 10; $i < $today['year'] + 1; $i++) {
            $data['year_valid'][] = array(
                'text'  => strftime('%Y', mktime(0, 0, 0, 1, 1, $i)),
                'value' => strftime('%Y', mktime(0, 0, 0, 1, 1, $i))
            );
        }

        $data['year_expire'] = array();

        for ($i = $today['year']; $i < $today['year'] + 11; $i++) {
            $data['year_expire'][] = array(
                'text'  => strftime('%Y', mktime(0, 0, 0, 1, 1, $i)),
                'value' => strftime('%Y', mktime(0, 0, 0, 1, 1, $i))
            );
        }

        return $this->load->view('extension/payment/komoju', $data);
    }

    public function send() {

        if (!$this->request->post['cc_number']) {
            $json['error'] = 'Please enter credit card number';
        }

        $this->load->model('checkout/order');

        $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
        
        $request  = 'payment_details[type]=credit_card';
        $request .= '&currency=JPY';
        $request .= '&amount='. urlencode($order_info['total']);
        //$request .= '&payment_details=' . urlencode($this->config->get('komoju_secret_key'));
        $request .= '&external_order_num=' . (int)$order_info['order_id'];
        $request .= '&payment_details[number]=' . $this->request->post['cc_number'];
        $request .= '&payment_details[month]=' . urlencode($this->request->post['cc_expire_date_month']);

        $request .= '&payment_details[year]=' . urlencode($this->request->post['cc_expire_date_year']);
        $request .= '&payment_details[verification_value]=' . urlencode($this->request->post['cc_cvv2']);

        $request .= '&payment_details[given_name]=' . urlencode($order_info['payment_firstname']);
        $request .= '&payment_details[family_name]=' . urlencode($order_info['payment_lastname']);
        $request .= '&payment_details[email]=' . urlencode($order_info['email']);

        if (!$this->config->get('komoju_test')) {
            $curl = curl_init('https://komoju.com/api/v1/payments');
        } else {
            $curl = curl_init('https://sandbox.komoju.com/api/v1/payments');
        }

        curl_setopt($curl, CURLOPT_PORT, 443);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_USERPWD, $this->config->get('komoju_secret_key') . ":" . '');
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($curl, CURLOPT_FRESH_CONNECT, 1);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $request);

        $response = curl_exec($curl);

        $response_info = json_decode($response);

        $json = array();

        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if (( $http_code == 200 && $response_info->status == 'captured')) {
            $message = '';

            $this->model_checkout_order->addOrderHistory($this->session->data['order_id'], $this->config->get('komoju_order_status_id'), $message, false);

            $json['success'] = $this->url->link('checkout/success');
        } else {
            $json['error'] = $response_info->error->message;
        }

        // Form validation
        if (!$this->request->post['cc_number']) {
            $json['error'] = 'Please enter credit card number';
        }

        if (!$this->request->post['cc_cvv2']) {
            $json['error'] = 'Please enter security code';
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
}