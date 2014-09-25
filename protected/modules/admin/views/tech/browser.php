<?php
$this->widget('ext.fm.ElFinderSelectWidget',array(
    'lang' => Yii::app()->getLanguage(),
    'url'  => CHtml::normalizeUrl(array('tech/fmanager')),
    'editorCallback'=>'js:function(url) {
        var funcNum = window.location.search.replace(/^.*CKEditorFuncNum=(\d+).*$/, "$1");
        window.opener.CKEDITOR.tools.callFunction(funcNum, url);
        window.close();
    }',
))?>

<?php
//$this->widget('ext.fm.ElFinderWidget', array(
//    'connectorRoute' => 'admin/pages/items/connector',
//));
