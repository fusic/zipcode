<?php

class ZipcodeAppModel extends AppModel {

    /**
     * truncate
     */
    function truncate($tableName = null) {
        if ( is_null($tableName) ) $tableName = $this->table;

        if ( !$tableName || is_null($tableName) ) {
            return false;
        }

        return $this->getDataSource()->truncate($tableName);
    }
}