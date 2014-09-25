<?php

class MdocsController extends Controller
{
	public function actionIndex()
	{
		$model = Documents::model()->findAll(array('order' => 'position'));		
		$this->render('index', array('model' => $model));
	}
	
	public function actionDownload($file)
	{		
		$model = Documents::model()->find('file = :file', array(':file' => $file));
		$count_downloaded = $model->downloaded + 1;
		
		$model->downloaded = $count_downloaded;
		$model->update();		
		
		$file = 'documents/'.$file;
		if (file_exists($file)) { 
			if (ob_get_level()) {
				ob_end_clean();
			}
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename=' . basename($file));
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($file));
			readfile($file);
			exit;
		}		
	}
}
