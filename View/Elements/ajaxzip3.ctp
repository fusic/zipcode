<?php
/**
 * element呼び出し方サンプル
 * ajaxzip3が呼び出されている前提で下記を記述することで外部URL(ajaxzip3のJSONP URL)からZipcode PluginのAPIを利用する形に変更されます。
 *
    echo $this->element('ajaxzip3', array(              // エレメント名
            'zipcode_id' => 'zip',                      // 郵便番号TEXTBOXのID
            'pref' => 'data[Address][pref_id]',         // 都道府県のname
            'address' => 'data[Address][address1]',     // 住所1のname
            'keyup' => true                             // jQueryによるkeyUpイベントの自動付与
        ),
        array(
            'plugin'=>'Zipcode',                        // プラグイン名
        )
    );

 */
?>
<script type="text/javascript">
//<![CDATA[
    // URLを上書きする
    AjaxZip3.JSONDATA = '<?php echo $this->Html->url(array('plugin'=>'zipcode', 'controller'=>'api', 'action'=>'ajaxzip3')); ?>';

<?php if ($keyup && $zipcode_id && $pref && $address): ?>
    if (typeof jQuery === 'function') {
      jQuery(function(){
          // エレメントの呼出元から受取る変数
          var forms = {
              zipcode_id:'#<?php echo $zipcode_id; ?>',
              pref:'<?php echo $pref; ?>',
              address:'<?php echo $address; ?>'
          };

          // 郵便番号のkeyup
          jQuery(forms.zipcode_id).keyup(function(){
              AjaxZip3.zip2addr(this, '', forms.pref, forms.address);
          });
      });
    }
<?php endif; ?>

//]]>
</script>

