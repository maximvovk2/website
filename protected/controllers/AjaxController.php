<?php

class AjaxController extends Controller
{
    public function actionDocuments()
    {
        $overwrite = false;
        unset($_POST['email']);
        $post_count = count($_POST);

        if($post_count > 1){
            $filename = 'documents/download/documents.zip';
            if(file_exists($filename)&&!$overwrite) { unlink($filename); }

            $files = array();

            foreach($_POST as $item)
            {
                $files[] = $item;
            }

            $zip = new ZipArchive();

            if($zip->open($filename,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) === true)
            {
                foreach($files as $file)
                {
                    $zip->addFile('documents/'.$file, $file);
                }
                $zip->close();
                echo CJSON::encode(array('true'=> 'download/documents.zip'));

            } else echo 'failed';
        } else
            {
                foreach($_POST as $item)
                {
                    echo CJSON::encode(array('true'=> $item));
                }
            }
    }

	
	public function actionDocumentsemail()
	{		
		$post_email = Yii::app()->request->getPost('email');

		if(empty($post_email)) {
			echo CJSON::encode(array('error'=> 'Please enter your Email'));
		}elseif(filter_var($post_email, FILTER_VALIDATE_EMAIL)) {
					
			$mailer = new YiiMailer();
			$mailer->setFrom('chisw_info@chisw.us', 'Download');
			$mailer->setSubject('CHI');			
			$mailer->setView('cv');
			$mailer->setData(array('msg' => ''));
			$mailer->render();
			$mailer->IsSMTP(true);
			$mailer->setTo($post_email);
			$mailer->SMTPAuth = true;
			$mailer->Host = 'mail.ukraine.com.ua';
			$mailer->Username = 'chisw_info@chisw.us';
			$mailer->Password = 'eL533Nbd';			

			unset($_POST['email']);
			$post_count = count($_POST);

            if($post_count > 1){
                $filename = 'documents/download/documents.zip';
                if(file_exists($filename)) { unlink($filename); }

                $files = array();

                foreach($_POST as $item)
                {
                    $files[] = $item;
                }

                $zip = new ZipArchive();

                if($zip->open($filename,ZIPARCHIVE::CREATE) === true)
                {
                    foreach($files as $file)
                    {
                        $zip->addFile('documents/'.$file, $file);
                    }
                    $zip->close();
                    $mailer->setAttachment($filename);

                } else echo 'failed';
            } else
            {
                foreach($_POST as $item)
                {
                    $mailer->setAttachment('documents/'.$item);
                }
            }


			$mailer->send();
			echo CJSON::encode(array('true'=> 'Thank you, checked documents has been sent to your Email ('. $post_email .').'));
				
		}else{
			echo CJSON::encode(array('error'=> 'Your Email seems to be wrong. Please check it.'));
		}	
	}

    public function actionSummarySend()
    {
        $post_email = Yii::app()->request->getPost('email');

        if(empty($post_email)) {
            echo CJSON::encode(array('error'=> 'Please enter your Email'));
        }elseif(filter_var($post_email, FILTER_VALIDATE_EMAIL)) {
            $mailer = new YiiMailer();
            $mailer->setFrom('chisw_info@chisw.us', 'Summary');
            $mailer->setSubject('CHI');
            $mailer->setView('cv');
            $mailer->setData(array('msg' => ''));
            $mailer->render();
            $mailer->IsSMTP(true);
            $mailer->setTo('flaksa@list.ru');
            $mailer->SMTPAuth = true;
            $mailer->Host = 'mail.ukraine.com.ua';
            $mailer->Username = 'chisw_info@chisw.us';
            $mailer->Password = 'eL533Nbd';

            $mailer->send();
            echo CJSON::encode(array('true'=> 'Thank you, the document has been sent to your Email ().'));

        }
    }
}
//	public function actionDocuments()
//	{
//		unset($_POST['email']);
//		$post_count = count($_POST);
//
//		if($post_count > 1){
//			if(is_file('documents/download/documents.zip')){
//				unlink('documents/download/documents.zip');
//			}
//
//			$filename = 'documents/download/documents.zip';
//			try {
//				$zipArchive = new ZipArchive($filename);
//                ZIPARCHIVE::CREATE;
//                if ($zipArchive->open($filename)) {
//                    foreach($_POST as $item){
//                        $zipArchive->addFile('documents/'.$item);
//                    }
//                    $zipArchive->close();
//                }
//
//
//				echo CJSON::encode(array('true'=> 'download/documents.zip'));
//			} catch (Exception $e) {
//				print "Exception: " . $e;
//			}
//		}else{
//			foreach($_POST as $item){
//				echo CJSON::encode(array('true'=> $item));
//			}
//		}
//	}

//unset($_POST['email']);
//$post_count = count($_POST);
//
//if($post_count > 1){
//    if(file_exists('documents/download/documents.zip')){
//        unlink('documents/download/documents.zip');
//    }
//
//    $filename = 'documents/download/documents.zip';
//    try {
//        $zipArchive = new ZipArchive($filename);
//
//        foreach($_POST as $item){
//            $zipArchive->addFile('documents/'.$item);
//        }
//
//        $mailer->setAttachment($filename);
//    } catch (Exception $e) {
//        print "Exception: " . $e;
//    }
//}else{
//    foreach($_POST as $item){
//        $mailer->setAttachment('documents/'.$item);
//    }
//}
//
//$mailer->send();
//echo CJSON::encode(array('true'=> 'Thank you, the document has been sent to your e-mail ('. $post_email .').'));
//
//}else{
//    echo CJSON::encode(array('error'=> 'Your e-mail seems to be wrong. Please check it.'));
//}