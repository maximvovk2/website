<?php

/**
 * This is the model class for table "tech".
 *
 * The followings are the available columns in table 'tech':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string info
 * @property string $url
 * @property int $position
 *
 * The followings are the available model relations:
 * @property TechList[] $techLists
 * @property TechProject[] $techProjects
 */
class Tech extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tech';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, info', 'required'),
			array('title', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, description, info, url', 'safe'),
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
			'techLists' => array(self::HAS_MANY, 'TechList', 'tech_id'),
			'projects' => array(self::MANY_MANY, 'Projects', 'tech_project(tech_id, project_id)')
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
                        'info'=>'Page Content',
                        'url' => 'Url',
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
		$criteria->compare('position',$this->position,true);

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
	 * @return Tech the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function behaviors(){
        return array('EAdvancedArBehavior' =>
        array('class' => 'application.components.EAdvancedArBehavior'));
    }

    public static function titleList()
    {
        $techRes = Tech::model()->findAll();
        $techList = array();
        $techList[0] = '';
        array_map(function($element) use (&$techList) {
            $techList[$element->id] = $element->title;
        }, $techRes);
        return $techList;
    }

    public static function techList()
    {
        $techRes = Tech::model()->findAll();
        $techList = array();
        //$titleList[0] = '';
        array_map(function($element) use (&$techList) {
            $techList[$element->id] = $element->title;
        }, $techRes);
        return $techList;
    }
    
    protected function beforeSave()
    {
        $position = Yii::app()->db->createCommand()
                    ->select('MAX(position)')
                    ->from('tech')
                    ->queryAll();
        
        $this->position = $position[0]['MAX(position)'] + 1;
        
        if ($this->isNewRecord){
           $this->dateCreate = date( "Y-m-d H:i:s" );
        }
        $this->dateUpdate = date( "Y-m-d H:i:s" );
        return parent::beforeSave();
    }
    
    
}
