<?php

class Successstories extends CActiveRecord
{
    public $pic;

    public function tableName()
	{
		return 'successstories';
	}

	public function rules()
	{

		return array(
			array('client, task, solution, result', 'required', 'message'=>'This field is required'),
			array('id, client, task, solution, result, pic', 'safe', 'on'=>'search'),
                        array('pic', 'ImageDimensions',
                                     'maxWidth'  => 200,
                                     'maxHeight' => 200,
                                     'minHeight' => 100,
                                     'minWidth'  => 100,
                                     'errorIfNotImage' => true),
                        array('pic', 'unsafe'),
                    );
	}

    public function behaviors()
    {
        return array(
            'AttachmentBehavior' => array(
                'class' => 'AttachmentBehavior',
                'attribute' => 'pic',
                'path' => "images/stories/:custom:filename",
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

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'position' => 'Position',
			'client' => 'Client',
			'task' => 'Task',
			'solution' => 'Solution',
			'result' => 'Result',
			'pic' => 'Picture',
                        'dateCreate'=>'Created',
                        'dateUpdate'=>'Updated',
		);
	}

	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('client',$this->client,true);
		$criteria->compare('task',$this->task,true);
		$criteria->compare('solution',$this->solution,true);
		$criteria->compare('result',$this->result,true);
		$criteria->compare('pic',$this->pic);
		$criteria->compare('position',$this->position);

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
                ->from('successstories')
                ->queryAll();

        $this->position = $position[0]['MAX(position)'] + 1;
        
        if ($this->isNewRecord){
           $this->dateCreate = date( "Y-m-d H:i:s" );
        }
        $this->dateUpdate = date( "Y-m-d H:i:s" );
        if(!parent::beforeSave())
            return false;

        if ($this->scenario == 'update' && !$this->pic) {
            unset($this->pic);
        }
        return true;
    }

    protected function beforeDelete(){
        if(!parent::beforeDelete())
            return false;
        return true;
    }
}

