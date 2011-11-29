<?php
App::import('Model', 'CakeSchema', false);
App::import('Model', 'AppModel', false);
App::import('Model', 'Zipcode.ZipcodeAppModel', false);
App::import('Model', 'Zipcode.Zipcode', false);
// @todo more better code
require_once dirname(__FILE__) . '/../../../models/zipcode.php';

class ImportTask extends Shell {

    var $_path = '/tmp/';

    /**
     * initialize
     *
     * @access public
     */
    function initialize() {
        parent::initialize();
    }

    /**
     * startup
     *
     * @access public
     */
    function startup(){
        // overrideでcakeメッセージ除去
    }

    /**
     * execute
     *
     * @access public
     */
    function execute() {
        $connection = 'default';
        if (!empty($this->params['connection'])) {
            $connection = $this->params['connection'];
        }
        App::import('Model', 'Zipcode.Zipcode', false);
        $this->Zipcode = new Zipcode(array('ds' => $connection));

        $csvFile = $this->_path.'ken_all.csv';

        // CSVファイルの存在チェック
        if ( !file_exists($csvFile) ) {
            $this->out($csvFile." がありません。KEN_ALL.CSVを取得を先に行って下さい。\n");
            return;
        }

        // 郵便番号テーブルを破棄
        if ( !$this->Zipcode->truncate() ) {
            $this->out($this->Zipcode->alias.' テーブルが truncate に失敗しました');
            return;
        }

        // ファイルOPEN
        $fp = fopen($csvFile, "r");

        // データ作成
        while($line = $this->_fgetcsv_reg($fp)){
            $_data = array(
                'id' => 0,
                'jis' => $line[0],
                'zip_old' => $line[1],
                'zip' => $line[2],
                'addr1_kana' => $line[3],
                'addr2_kana' => $line[4],
                'addr3_kana' => $line[5],
                'addr1' => $line[6],
                'addr2' => $line[7],
                'addr3' => $line[8],
                'c1' => $line[9],
                'c2' => $line[10],
                'c3' => $line[11],
                'c4' => $line[12],
                'c5' => $line[13],
                'c6' => $line[14],
            );

            $this->Zipcode->create();
            if ( !$this->Zipcode->save($_data, false) ) {
                $this->out(print_r($_data));
                fclose($fp);
                return;
            }

            $this->out('['.$_data['zip'].'] '.$_data['addr1'].$_data['addr2'].$_data['addr3']);
        }

        $this->out("-- COMPLEET --\n");

        fclose($fp);
    }

    /**
     * fgetcsv_reg
     * fgetcsv文字化け対策関数
     *
     * @param mixed $handle
     * @param mixed $length
     * @param string $d
     * @param ' $'
     * @param string $e
     * @access public
     * @return void
     */
    function _fgetcsv_reg (&$handle, $length = null, $d = ',', $e = '"') {
        $d = preg_quote($d);
        $e = preg_quote($e);
        $_line = "";
        $eof = false;
        while ($eof != true) {
            $_line .= (empty($length) ? fgets($handle) : fgets($handle, $length));
            $itemcnt = preg_match_all('/'.$e.'/', $_line, $dummy);
            if ($itemcnt % 2 == 0) $eof = true;
        }
        $_csv_line = preg_replace('/(?:\\r\\n|[\\r\\n])?$/', $d, trim($_line));
        $_csv_pattern = '/('.$e.'[^'.$e.']*(?:'.$e.$e.'[^'.$e.']*)*'.$e.'|[^'.$d.']*)'.$d.'/';
        preg_match_all($_csv_pattern, $_csv_line, $_csv_matches);
        $_csv_data = $_csv_matches[1];
        for($_csv_i=0; $_csv_i<count($_csv_data); $_csv_i++) {
            $_csv_data[$_csv_i] = preg_replace('/^'.$e.'(.*)'.$e.'$/s','$1',$_csv_data[$_csv_i]);
            $_csv_data[$_csv_i] = str_replace($e.$e, $e, $_csv_data[$_csv_i]);
        }
        return empty($_line) ? false : $_csv_data;
    }

}