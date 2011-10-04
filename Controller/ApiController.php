<?php
App::uses('ZipcodeAppController', 'Zipcode.Controller');

class ApiController extends ZipcodeAppController {
    public $name = 'Api';
    public $uses = array('Zipcode.Zipcode');
//    public $helpers = array('Form', 'Html', 'Session', 'Js', 'Xml');
    public $helpers = array('Form', 'Html', 'Session', 'Js');

    /**
     * beforeFilter
     *
     * @access public
     */
    public function beforeFilter() {
        parent::beforeFilter();
        Configure::write('debug', 2);
        $this->autoRender = false;
        $this->layout = 'ajax';
    }

    /**
     * json
     * /zipcode/api/json/1234567/
     *
     * @param <string> $zipcode
     * @param <integer> $limit
     * @return <type>
     */
    public function json($zipcode = null, $limit = false) {
        if ( $zipcode === null ) {
            $this->_error();
            return;
        }

        $data = $this->Zipcode->search('all', $zipcode, $limit);
        if ( empty($data) ) {
            $this->_empty();
            return;
        }

        $this->set('data', $data);
        header("Content-Type: application/json; charset=utf-8");
        $this->render('json');
    }

    /**
     * xml
     * /zipcode/api/xml/1234567/5
     *
     * @param <string> $zipcode
     * @param <integer> $limit
     * @return <type>
     */
    /**
     * [@todo] XmlHelperの代替手段が見つからないのでとりあえずコメントアウトします
     * 
    public function xml($zipcode = null, $limit = false) {
        if ( $zipcode === null ) {
            $this->_error();
            return;
        }

        $data = $this->Zipcode->search('all', $zipcode, $limit);
        if ( empty($data) ) {
            $this->_empty();
            return;
        }

        $xml = array();
        foreach ($data as $key => $val) {
            $xml[] = $val[$this->Zipcode->alias];
        }

        $this->set('data', $xml);
        $this->set('pluralize', Inflector::pluralize($this->Zipcode->alias));
        $this->set('singularize', Inflector::singularize($this->Zipcode->alias));
        header("Content-type: text/xml");
        $this->render('xml');
    }
     */

    /**
     * ajaxzip3
     * /zipcode/api/ajaxzip3/zip-812.js
     *
     * @param <type> $source
     */
    public function ajaxzip3($source = null) {
        if ( !preg_match('/^zip\-([0-9]{3})\.js$/', $source, $matches) ) {
            $this->_error();
            return;
        }
        if ( empty($matches[1]) ) {
            $this->_error();
            return;
        }
        // ３桁のみ有効
        if (strlen($matches[1]) != 3 ) {
            $this->_error();
            return;
        }

        $zipcode = $matches[1];

        $data = $this->Zipcode->search('all', $zipcode, false);
        if ( empty($data) ) {
            $this->_empty();
            return;
        }

        $json = array();
        foreach ($data as $key => $val) {

            // 都道府県ID
            $j = array($val['Zipcode']['pref_id']);

            if ( !empty($val['Zipcode']['addr2']) ) {
                $j = Set::merge($j, $val['Zipcode']['addr2']);
            }
            if ( !empty($val['Zipcode']['addr3']) ) {
                $j = Set::merge($j, $val['Zipcode']['addr3']);
            }

            $json[$val['Zipcode']['zip']] = $j;
        }

        $this->set('data', $json);
        header("Content-Type: text/javascript; charset=utf-8");
        $this->render('ajaxzip3');
    }

    /**
     * _error
     *
     * @access private
     */
    public function _error() {
        $this->cakeError('error404');
    }

    /**
     * _empty
     *
     * @access private
     */
    public function _empty() {
        $this->cakeError('error404');
    }

}