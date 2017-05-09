<?php  
class ControllerExtensionModuleOccmsblock extends Controller {
	public function index($setting) { 

		$this->load->model('cmsblock/info');
		$this->load->model('tool/image');

		$data = array();

		$data['cmsblocks'] = array();
		
		if (isset($setting['cmsblock'])) {
			$results = $this->model_cmsblock_info->getcmsblocks();
			$store_id  = $this->config->get('config_store_id'); 
			$banner_store = array();
			foreach ($results as $result) {
				  if(isset($result['banner_store'])) {
					$banner_store = explode(',',$result['banner_store']);
				  }
				  
				  if(in_array($store_id,$banner_store)) {
					if($result['cmsblock_id'] == $setting['cmsblock']) {
						$data['cmsblocks'][] = array(
							'title' => $result['title'],
							'link'  => $result['link'],
							'description'  => $result['description'],
                            'id_cmsblock' =>$result['cmsblock_id']
						);
					}
				  }	
			}
		}

		if($data['cmsblocks']) {
			return $this->load->view('extension/module/occmsblock.tpl', $data);
		}
	}
}
?>