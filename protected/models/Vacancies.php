<?php

/**
 * This is the model class for table "vacancies".
 *
 * The followings are the available columns in table 'vacancies':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $position
 */
class Vacancies extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'vacancies';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, description', 'required'),
			array('position', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, description, position', 'safe'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
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
			'title' => 'Title',
			'description' => 'Description',
			'position' => 'Position',
                        'dateCreate'=>'Created',
                        'dateUpdate'=>'Updated',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
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

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Vacancies the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        protected function beforeSave()
        {        
        
        $position = Yii::app()->db->createCommand()
                ->select('MAX(position)')
                ->from('vacancies')
                ->queryAll();

        $this->position = $position[0]['MAX(position)'] + 1;
            
            if ($this->isNewRecord){
               $this->dateCreate = date( "Y-m-d H:i:s" );
            }
            $this->dateUpdate = date( "Y-m-d H:i:s" );
            return parent::beforeSave();
        }
}
