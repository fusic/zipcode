<?php
App::uses('AppModel', 'Model');

class ZipcodeAppModel extends AppModel {

    /**
     * truncate
     * 
     * @param type $tableName
     * @return bool
     */
    public function truncate($tableName = null) {
        if ( is_null($tableName) ) $tableName = $this->table;

        if ( !$tableName || is_null($tableName) ) {
            return false;
        }

        return $this->getDataSource()->truncate($tableName);
    }
}
