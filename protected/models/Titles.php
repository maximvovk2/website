<?php

/**
 * This is the model class for table "titles".
 *
 * The followings are the available columns in table 'titles':
 * @property integer $id
 * @property string $title
 */
class Titles extends CActiveRecord
{
	public function tableName()
	{
		return 'titles';
	}

	public function rules()
	{
		return array(
			array('title', 'required', 'message' => 'Please enter the title'),
			array('title', 'unique', 'message' => 'That title is already exists'),
			array('title', 'length', 'max'=>255),
            array('id, title', 'safe'),
		);
	}

	public function relations()
	{
        return array(
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
                        'dateCreate'=>'Created',
                        'dateUpdate'=>'Updated',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);

        $pagination = new CPagination; $pagination->pageSize = Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']);
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination' => $pagination,
		));
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function titleList()
    {
        $titleRes = Titles::model()->findAll();
        $titleList = array();
        //$titleList[0] = '';
        array_map(function($element) use (&$titleList) {
            $titleList[$element->id] = $element->title;
        }, $titleRes);
        return $titleList;
    }
    
    protected function beforeSave()
    {
        if ($this->isNewRecord){
           $this->dateCreate = date( "Y-m-d H:i:s" );
        }
        $this->dateUpdate = date( "Y-m-d H:i:s" );
        return parent::beforeSave();
    }
}
