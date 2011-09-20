<?php
class ZipcodeImportShell extends Shell {

    var $tasks = array('GetKenAll', 'Import');

    var $uses = array();

    var $menus = array(
        1 => array(
            'task' => 'GetKenAll',
            'alt' => 'KEN_ALL.CSVを取得',
        ),
        2 => array(
            'task' => 'Import',
            'alt' => '郵便番号データをインポート',
        ),
        'q' => array(
            'task' => null,
            'alt' => '終了',
        ),
    );

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
     * main
     *
     * @access public
     */
    function main() {

        $menuKeys = array_keys($this->menus);

        //メインメニュー表示
        $value = "";

        $msg = null;
        $msg .= "---------------------------------------------\n";
        $msg .= "> main menu\n";
        foreach($this->menus as $k => $v) {
            $msg .= "[{$k}] {$v['alt']}\n";
        }
        $msg .= "---------------------------------------------\n";
        $msg .= "実行するメニューの番号を選択してください\n";

        while ($value <> "q") {
            $value = $this->in($msg, $menuKeys, "q" );
            if ($value <> 'q') {
                $this->{$this->menus[$value]['task']}->execute();
            }
        }
    }

}