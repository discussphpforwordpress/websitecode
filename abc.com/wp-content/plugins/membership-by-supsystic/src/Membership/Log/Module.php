<?php
class Membership_Log_Module extends Membership_Base_Module {

	private $_enbLog = false;
	public function afterModulesLoaded() {

	}

	public function addLine( $data ) {
		if(!$this->_enbLog) return;
		$logDir = $this->getEnvironment()->getConfig()->get('plugin_log');
		if($logDir) {
			$eol = "\n";
			if(is_array( $data )) {
				$data = implode( $eol, $data );
			}
			$data .= $eol;
			$filePath = $logDir. '/'. date('d-m-Y'). '.log';
			file_put_contents($filePath, $data, FILE_APPEND);
		}
	}
	public function enbLog( $set = true ) {
		$this->_enbLog = $set;
	}
}