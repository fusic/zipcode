<?php
App::uses('ZipcodeAppModel', 'Zipcode.Model');

class Zipcode extends ZipcodeAppModel {
    public $name = 'Zipcode';
    public $displayField = 'zip';

    public function search($type = 'all', $zipcode, $limit = 10) {
        if ( $zipcode === null ) {
            return false;
        }

        $query = array();

        if ( mb_strlen($zipcode) < 7 ) {
            $query['conditions'] = array(
                $this->alias. '.zip LIKE' => $zipcode . '%',
            );
        } else {
            $query['conditions'] = array(
                $this->alias. '.zip' => $zipcode,
            );
        }

        if ( $limit !== false && $limit > 0 ) {
            $query['limit'] = $limit;
        }

        $query['order'] = array($this->alias.'.zip'=>'ASC');
        $query['recursive'] = -1;

        $data = $this->find($type, $query);

        return $data;
    }

    public function beforeSave($options = array()) {

        if ( empty($this->data[$this->alias]['pref_id']) && !empty($this->data[$this->alias]['jis']) ) {
            $this->data[$this->alias]['pref_id'] = (int)substr($this->data[$this->alias]['jis'], 0, 2);
        }

        // 以下に掲載が〜の住所は省く
        if ( !empty($this->data[$this->alias]['addr1']) ) {
            if ( preg_match('/^以下に掲載が/is', $this->data[$this->alias]['addr1']) ) {
                $this->data[$this->alias]['addr1'] = null;
            }
        }
        if ( !empty($this->data[$this->alias]['addr2']) ) {
            if ( preg_match('/^以下に掲載が/is', $this->data[$this->alias]['addr2']) ) {
                $this->data[$this->alias]['addr2'] = null;
            }
        }
        if ( !empty($this->data[$this->alias]['addr3']) ) {
            if ( preg_match('/^以下に掲載が/is', $this->data[$this->alias]['addr3']) ) {
                $this->data[$this->alias]['addr3'] = null;
            }
        }

        return parent::beforeSave($options);
    }

}