<?php
class GetKenAllTask extends Shell {

    var $uses = array();

    var $_path = '/tmp/';

    var $menus = array(
        1 => array(
            'alt' => '読み仮名データの促音・拗音を小書きで表記しないもの(例：ホツカイドウ',
            'url' => 'http://www.post.japanpost.jp/zipcode/dl/oogaki/lzh/ken_all.lzh',
        ),
        2 => array(
            'alt' => '読み仮名データの促音・拗音を小書きで表記するもの(例：ホッカイドウ',
            'url' => 'http://www.post.japanpost.jp/zipcode/dl/kogaki/lzh/ken_all.lzh',
        ),
        'q' => array(
            'alt' => '戻る',
            'url' => null,
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
     * execute
     *
     * @access public
     */
    function execute() {

        $menuKeys = array_keys($this->menus);

        //メインメニュー表示
        $value = "";

        $msg = null;
        $msg .= "---------------------------------------------\n";
        $msg .= "> KEN_ALL.CSVを取得\n";
        foreach($this->menus as $k => $v) {
            $msg .= "[{$k}] {$v['alt']}\n";
        }
        $msg .= "---------------------------------------------\n";
        $msg .= "実行するメニューの番号を選択してください\n";

        while ($value <> "q") {
            $value = $this->in($msg, $menuKeys, "q" );

            if ($value <> 'q') {
                $this->_wget($this->menus[$value]['url']);
            }
        }
    }

    function _wget($url) {

        $archive = $this->_path.'ken_all.lzh';
        $csv = $this->_path.'ken_all.csv';

        $this->out($url."をダウンロード中...\n");
        exec('rm -rf '.$archive);
        exec('rm -rf '.$csv);
        exec('wget -P '.$this->_path.' '.$url);
        exec('lha ew='.$this->_path.' '.$archive);

        $this->out($csv."の文字コードと改行コードを変換中...\n");
        exec('nkf -w -Lu --overwrite '.$csv);
    }
}