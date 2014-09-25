<?php
class ImageDimensions extends CValidator{
    public $minWidth = 0;              
    public $minHeight = 0;             
    public $maxWidth;                  
    public $maxHeight;                 
    public $errorIfNotImage = true;    
     
    public $minWidthNotMatch = 'Width less than {value}';
    public $minHeightNotMatch = 'Less than the height {value}';
    public $maxWidthNotMatch = 'Width is greater than {value}';
    public $maxHeightNotMatch = 'Height more than{value}';
    public $notImage = 'Upload file not an image';
     
                  
    protected static $allowedMime = array(
        'image/jpeg',
        'image/JPEG',
        'image/JPG',
        'image/jpg',
        'image/PNG',
        'image/png',
        'image/GIF',
        'image/gif'
    );
     
    protected function validateAttribute($object, $attribute) {
         
        if ($this->minHeight > $this->maxHeight || $this->minWidth > $this->maxWidth)
            throw new CException('Wrong parametr set in ImageDimensions validator');
        $file = $object->$attribute;
         
        if(!$file instanceof CUploadedFile){
            $file = CUploadedFile::getInstance($object, $attribute);
            if(null===$file)
                    return;
        }
        $image = $file->getTempName();
         
        $imgInfo = getimagesize($image);
        $mime = $imgInfo['mime'];
        $width = $imgInfo[0];
        $height = $imgInfo[1];
         
        if (!in_array($mime, self::$allowedMime)){
            if ($this->errorIfNotImage){
                $this->addError ($object, $attribute, $this->notImage, array('{field_name}' => $attribute));
            }
            return;
        }
         
        if ($width < $this->minWidth)
            $this->addError ($object, $attribute, $this->minWidthNotMatch, array('{field_name}' => $attribute, '{value}' => $this->minWidth));
        if ($height < $this->minHeight)
            $this->addError ($object, $attribute, $this->minHeightNotMatch, array('{field_name}' => $attribute, '{value}' => $this->minHeight));
        if ($width > $this->maxWidth)
            $this->addError ($object, $attribute, $this->maxWidthNotMatch, array('{field_name}' => $attribute, '{value}' => $this->maxWidth));
        if ($height > $this->maxHeight)
            $this->addError ($object, $attribute, $this->maxHeightNotMatch, array('{field_name}' => $attribute, '{value}' => $this->maxHeight));
    }
}