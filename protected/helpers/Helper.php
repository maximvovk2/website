<?php
class Helper {
    public static function class_exists($className)
    {
        return file_exists(Yii::getPathOfAlias('application.models').DIRECTORY_SEPARATOR.$className.'.php');
    }
    public static function prepare($className)
    {
        return $className = ucfirst(strtolower(str_replace("_","",$className)));
    }

}