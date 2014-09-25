<?php

/**
 * This is the model class for table "clients".
 *
 * The followings are the available columns in table 'clients':
 * @property integer $id
 * @property string $title
 * @property string $link
 * @property integer $position
 */
class Clients extends CActiveRecord
{
    public $pic;

    public function tableName()
	{
		return 'clients';
	}

	public function rules()
	{
        return array(
			array('title', 'required'),
			array('position', 'numerical', 'integerOnly'=>true),
			array('title, link', 'length', 'max'=>255),
			array('id, title, link, logo, position, dateUpdate, dateCreate', 'safe', 'on'=>'search'),
            array('logo', 'ImageDimensions',
                'maxWidth'  => 120,
                'maxHeight' => 120,
                'minHeight' => 120,
                'minWidth'  => 120,
                'errorIfNotImage' => true),
            array('logo', 'unsafe'),
		);
	}

    public function behaviors()
    {
        return array(
            'AttachmentBehavior' => array(
                'class' => 'AttachmentBehavior',
                'attribute' => 'logo',
                'path' => "images/clients/:custom:filename",
                'custom' => microtime(true),
                'fallback_image' => 'images/stories/default.png',
            ),
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
                        'position' => 'Position',
			'id' => 'ID',
			'title' => 'Title',
			'logo' => 'Logo',
			'link' => 'Link',
			'dateCreate' => 'dateCreate',
			'dateUpdate' => 'dateUpdate',
		);
	}


	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('position',$this->position);
		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('logo',$this->logo,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('dateCreate',$this->dateCreate);
		$criteria->compare('dateUpdate',$this->dateUpdate);

        $pagination = new CPagination; $pagination->pageSize = Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']);
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination' => $pagination,
            'sort' => array(
                'defaultOrder' => 'position',
            ),
        ));
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    protected function beforeSave(){
                $position = Yii::app()->db->createCommand()
                ->select('MAX(position)')
                ->from(' clients')
                ->queryAll();

        $this->position = $position[0]['MAX(position)'] + 1;
        
        if ($this->isNewRecord){
            $this->dateCreate = date( "Y-m-d H:i:s" );
        }
        $this->dateUpdate = date( "Y-m-d H:i:s" );
        if(!parent::beforeSave())
            return false;

        if ($this->scenario == 'update' && !$this->logo) {
            unset($this->logo);
        }
        return true;
    }

}
