# Zipcode Plugin for CakePHP #

JP Post Zipcode Plugin for CakePHP.

Zipcode Pluginは日本郵便の郵便番号のデータを活用するCakePHPプラグインです。

郵便番号データ取得と、実際に検索するためのいくつかのインターフェースを提供します。

## インストール ##

app/plugins以下に、ダウンロードした圧縮ファイルをzipcodeディレクトリとして展開・設置してください。

いつものCakePHPプラグインの設置と同様です。

## セットアップ ##

Zipcode Pluginを利用する前に、たった2つですが手続きを踏む必要があります。

それは「1.郵便番号用テーブルの作成」と「2.郵便番号データのインポート」です。

それぞれにcakeコマンドを用意しているので安心してください。

### 0.準備 ###

以下のコマンドが実行できるか事前に確認して下さい。

* wget
* lha
* nkf

### 1.郵便番号用テーブル作成 ###

郵便番号インポート用テーブルを作成します。

schemaコマンドを使用する場合

    $ cake schema create Zipcode -path app/plugins/zipcode/schema

SQLでテーブルを生成する場合

    CREATE TABLE IF NOT EXISTS `zipcodes` (
      `id` int(11) NOT NULL auto_increment,
      `jis` varchar(10) collate utf8_unicode_ci default NULL,
      `zip_old` varchar(5) collate utf8_unicode_ci default NULL,
      `pref_id` int(11) default NULL,
      `zip` varchar(7) collate utf8_unicode_ci default NULL,
      `addr1_kana` varchar(100) collate utf8_unicode_ci default NULL,
      `addr2_kana` varchar(100) collate utf8_unicode_ci default NULL,
      `addr3_kana` varchar(100) collate utf8_unicode_ci default NULL,
      `addr1` varchar(100) collate utf8_unicode_ci default NULL,
      `addr2` varchar(100) collate utf8_unicode_ci default NULL,
      `addr3` varchar(100) collate utf8_unicode_ci default NULL,
      `c1` int(11) default NULL,
      `c2` int(11) default NULL,
      `c3` int(11) default NULL,
      `c4` int(11) default NULL,
      `c5` int(11) default NULL,
      `c6` int(11) default NULL,
      `created` datetime default NULL,
      `modified` datetime default NULL,
      PRIMARY KEY  (`id`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


### 2.郵便番号データをインポート ###

    $ cake zipcode_import

メニューが表示されるので「1.KEN_ALL.CSVを取得」「2.郵便番号データをインポート」の順番に実行して下さい。

## 使い方 ##

Zipcode Pluginは大きく分けて2つの使用方法があります。

### 1.APIを利用した検索 ###

Zipcode PluginではAjax等で利用するためのHTTPインターフェースを提供しています。

* JSON (/zipcode/api/json/8120042/)
* XML (/zipcode/api/xml/8120042/)
* ajaxzip3 (JSONP) (/zipcode/api/ajaxzip3/zip-812.js)

郵便番号検索のJavaScriptライブラリは [ajaxzip3](http://code.google.com/p/ajaxzip3/) が非常に素晴らしく、基本的にはそれで十分です。

しかし、様々な理由で外部URLにリクエストを投げることができないことがあります。

その時にajaxzip3から、わずかな変更で内部の郵便番号データでの郵便番号検索に変更できます。

詳しくは ```views/elements/ajaxzip3.ctp``` を確認してください。

またJSONインターフェースやXMLインターフェースを利用して独自に郵便番号検索機能を実装することも可能です。

### 2.Zipcodeモデルを直接利用する検索 ###

Zipcode::search()を直接利用して前方一致の郵便番号検索ができます。

また、直接Zipcode::find()をしてもいいかもしれません。

詳しくは ```models/zipcode.php``` を確認してください。

# TODO #

* APIの汎用化(郵便番号以外のデータでも検索できるように変更する予定)
* cronによる郵便番号データ更新対応

# Contributors #

Kagasawa-san : make basic.

# License #

The MIT Lisence

Copyright (c) 2011 Fusic Co., Ltd. (http://fusic.co.jp)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
