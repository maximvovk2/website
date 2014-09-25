<?php

/**
 * This is the model class for table "testmonials".
 *
 * The followings are the available columns in table 'testmonials':
 * @property integer $id
 * @property string $title
 * @property string $description
 */

class Testmonials extends CActiveRecord
{
	public function tableName()
	{
		return 'testmonials';
	}

    public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, description', 'required'),
			array('title', 'length', 'max'=>100),
			array('id, title, description', 'safe'),
		);
	}

	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'description' => 'Description',
                        'dateCreate'=>'Created',
                        'dateUpdate'=>'Updated',
		);
	}

	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);

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
        
        protected function beforeSave()
        {
            if ($this->isNewRecord){
               $this->dateCreate = date( "Y-m-d H:i:s" );
            }
            $this->dateUpdate = date( "Y-m-d H:i:s" );
            return parent::beforeSave();
        }
    
}
