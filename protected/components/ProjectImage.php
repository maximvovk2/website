<?php

class ProjectImage
{
    const PIC_SALT = 'rt3f6h';
    protected $allowedMimeTypes = array(
       'image/jpeg',
        'image/png',
        'image/gif'
    );
    const DS = DIRECTORY_SEPARATOR;
    const PREVIEW_WIDTH = 400;
    const PREVIEW_HEIGHT = 250;
    public function makePreview($images) {
        if (!is_array($images)) {
            return false;
        }
        if (empty($images['name']) || empty($images['type']) || empty($images['size'])) {
            return false;
        }

        foreach ($images['name'] as $id => $imageName) {
            if (($imageName != '') && in_array($images['type'][$id], $this->allowedMimeTypes)) {
                $this->_createDirectory('preview' . self::DS . md5(session_id()));
                $previewDir = 'preview' . self::DS . md5(session_id()) . self::DS;
                move_uploaded_file($images['tmp_name'][$id], $previewDir . $imageName);
            }
        }
        return true;
    }

    public function makePreviewFromPics($pics, $postedPics, $projectId) {
        $previewDir = 'preview' . self::DS . md5(session_id()) . self::DS;
        foreach ($pics as $pic) {
            if (in_array(md5($pic->filename), $postedPics)) {
                $picFileName = 'pics' . self::DS . $projectId . $pic->filename;
                if (is_file($picFileName)) {
                    copy($picFileName, $previewDir . $pic->filename);
                }
            }
        }
    }

    public function getPreviews() {
        $previewDir = 'preview' . self::DS . md5(session_id());
        if (!is_dir($previewDir)) {
            return array();
        }
        $files = scandir($previewDir);
        $previews = array();
        foreach ($files as $file) {
            $isFile = is_file($previewDir . self::DS . $file);
            if ($file == 'title') {
                $title = scandir($previewDir . self::DS . 'title', 1);
                if (is_file($previewDir . self::DS . 'title' . self::DS . $title[0])) {
                    $previews[] = array(
                        'url' => Yii::app()->baseUrl . '/preview/' . md5(session_id()) . '/title/' . $title[0],
                        'filename' => $title[0],
                        'title' => 1
                    );
                }
            }
            if (!$isFile) {
                continue;
            }
            $previews[] = array('url' => Yii::app()->baseUrl . '/preview/' . md5(session_id()) . '/' . $file, 'filename' => $file, 'title' => 0);
        }
        return $previews;
    }

    public function getTitlePreview() {
        $previewDir = 'preview' . self::DS . md5(session_id()) . self::DS . 'title' . self::DS;
        if (!is_dir($previewDir)) {
            return array();
        }
        $files = scandir($previewDir, 1);
        if (!is_file($previewDir . $files[0])) {
            return false;
        }
        return array('url' => Yii::app()->baseUrl . '/' . $previewDir . $files[0], 'filename' => $previewDir . $files[0]);
    }

    public function loadTitlePreview($postedTitle, $loadedTitle) {

        $isPosted = !empty($postedTitle);
        $isLoaded = !empty($loadedTitle['name']);
        if ($isPosted && !$isLoaded) {
            return false;
        }
        $this->cleanTitlePreview($postedTitle);
        if ($isLoaded) {
            $this->makeTitlePreview($loadedTitle, $postedTitle);

        }
        return true;
    }

    public function makeTitlePreview($title, $postedAvatar) {
        $this->cleanTitlePreview($postedAvatar);
        $titlePicsDir = 'preview' . self::DS . md5(session_id()) . self::DS . 'title' . self::DS;

        $this->_createDirectory('preview');
        $this->_createDirectory('preview' . self::DS . md5(session_id()));
        $this->_createDirectory($titlePicsDir);
        move_uploaded_file($title['tmp_name'], $titlePicsDir . $title['name']);
    }

    public function cleanPreviews($postedPreviews, $cleanTitle = true) {
        $oldPreviews = $this->getPreviews();
        $previewDir = 'preview' . self::DS . md5(session_id());
        foreach ($oldPreviews as $preview) {
            if (!in_array(md5($preview['filename']), $postedPreviews)) {
                if (!$cleanTitle && ($preview['filename'] == 'title')) {
                    continue;
                }
                if (is_file($previewDir . self::DS . $preview['filename'])) {
                    unlink($previewDir . self::DS . $preview['filename']);
                }
            }
        }
        return true;
    }

    public function cleanTitlePreview($postedAvatar) {
        $previewDir = 'preview' . self::DS . md5(session_id()) . self::DS . 'title' . self::DS;
        if (!is_dir($previewDir)) {
            return false;
        }
        $oldFiles = scandir($previewDir , 1);
        var_dump(base64_decode($postedAvatar));

        foreach ($oldFiles as $file) {
            if (is_file($previewDir . $file) && ($postedAvatar != base64_encode($file))) {
                unlink($previewDir . $file);
            }
        }
        return true;
    }

    protected function _createDirectory($dir) {
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        return true;
    }


    public function loadAvatar($avatar, $projectId) {
        if (!empty($avatar['name'])) {
            $imageDir = 'pics' . self::DS . $projectId . self::DS . 'title' . self::DS;
            $this->_createDirectory($imageDir);
            $oldAvatars = scandir($imageDir, 1);
            unset($oldAvatars[count($oldAvatars) - 1]);
            unset($oldAvatars[count($oldAvatars) - 1]);
            if (count($oldAvatars) > 0) {
                foreach ($oldAvatars as $oldAvatar) {
                    if (is_file($imageDir . $oldAvatar)) {
                        unlink ($imageDir . $oldAvatar);
                    }
                }
            }
            move_uploaded_file($avatar['tmp_name'], $imageDir . $avatar['name']);


            ProjectsPics::model()->deleteAllByAttributes(array('project_id' =>  $projectId, 'preview' => '1'));
            $modelImage = new ProjectsPics();
            $modelImage->url = '/pics/' . $projectId . '/title/' . $avatar['name'];
            $modelImage->project_id = $projectId;
            $modelImage->preview = 1;
            $modelImage->insert();
        }
    }
    public function loadImages($images, $projectId) {
       $this->loadImagesFromPreviews($projectId);
        if (!is_array($images)) {
            return false;
        }
        if (count($images) == 0) {
            return false;
        }
        $this->_createDirectory('pics' . self::DS . $projectId);

        foreach ($images['name'] as $id => $imageName) {
            if (in_array($images['type'][$id], $this->allowedMimeTypes)) {
                $imageDir = 'pics' . self::DS . $projectId . self::DS;
                $this->_createDirectory('preview' . self::DS . md5(session_id()));
                $this->_createDirectory($imageDir);
                $imageDir = 'pics' . self::DS . $projectId . self::DS;
                move_uploaded_file($images['tmp_name'][$id], $imageDir . $imageName);
                $modelImage = new ProjectsPics();
                $modelImage->url = '/pics/' . $projectId . '/' . $imageName;
                $modelImage->project_id = $projectId;
                $modelImage->preview = 0;
                $modelImage->insert();
            }
        }

        return true;
    }

    public function loadImagesFromPreviews($projectId) {

        $previews = $this->getPreviews();
        if (count($previews) > 0) {
            foreach ($previews as $preview) {
                $isTitle = (!empty($preview['title']));
                $oldName = 'preview' . self::DS . md5(session_id()) . self::DS;
                if ($isTitle) {
                    $oldName .= 'title' . self::DS;
                }
                $oldName .= $preview['filename'];
                $newName = 'pics' . self::DS . $projectId . self::DS;
                if ($isTitle) {
                    $newName .= 'title' . self::DS;
                }
                $this->_createDirectory($newName);
                $newName .= $preview['filename'];
                rename($oldName, $newName);
                $modelImage = new ProjectsPics();
                $modelImage->url = '/pics/' . $projectId . '/' ;
                if ($isTitle) {
                    $modelImage->url .= 'title/';
                }
                $modelImage->url .= $preview['filename'];
                $modelImage->project_id = $projectId;
                $modelImage->preview = ($isTitle) ? 1 : 0;
                $modelImage->insert();
            }
            if (is_dir('preview' . self::DS . md5(session_id()) . self::DS . 'title')) {
                rmdir('preview' . self::DS . md5(session_id()) . self::DS . 'title');
            }
            rmdir('preview' . self::DS . md5(session_id()));
        }
    }



}