<?php

class ControllerCommonFooter extends Controller
{
    public function index()
    {
        $this->load->language('common/footer');

        $data['text_footer'] = $this->language->get('text_footer');
        $data['text_version'] = '';

        return $this->load->view('common/footer', $data);
    }
}
