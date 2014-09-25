<?php

foreach($model as $item) {
	echo '<strong>'. $item->title .'</strong><br />';
	echo $item->description;
	echo '<a href="'. Yii::app()->request->baseUrl .'/mdocs/download?file='. $item->file .'">Download</a> <br /> downloaded - '. $item->downloaded .' <hr />';
}
