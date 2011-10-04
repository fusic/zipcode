<?php
class ZipSearchComponent extends Component {
    
    var $Zipcode = array();
    var $_controller = array();

	function initialize($controller, $settings = array()) {
        $this->_controller = $controller;
        $this->Zipcode = ClassRegistry::init('Zipcode.Zipcode');
	}

    function first($zipcode=null) {
        return $this->Zipcode->search('first', $zipcode, false);
    }
    function all($zipcode=null, $limit=false) {
        return $this->Zipcode->search('all', $zipcode, $limit);
    }
}
