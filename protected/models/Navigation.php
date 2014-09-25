<?php

/**
 * This is the model class for table "navigation".
 *
 * The followings are the available columns in table 'navigation':
 * @property integer $id
 * @property string $title
 * @property string $url
 * @property integer $parent
 * @property integer $position
 */
class Navigation extends CActiveRecord
{
    public $Cat;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'navigation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required'),
			array('parent, position', 'numerical', 'integerOnly'=>true),
			array('title, url', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, url, parent, category, position, cat', 'safe'),
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
			'url' => 'Url',
			'parent' => 'Parent',
                        'dateCreate'=>'Created',
                        'dateUpdate'=>'Updated',
                        'category' => 'Category',
			'position' => 'Position',
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
		$criteria->compare('url',$this->url,true);
		$criteria->compare('parent',$this->parent);
        $criteria->compare('category',$this->category);
		$criteria->compare('position',$this->position);

        $pagination = new CPagination; $pagination->pageSize = Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>$pagination,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Navigation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function titleList()
    {
        $navRes = Navigation::model()->findAll(array('order' => 'position'));
        $navList = array();
        $navList[0] = '';
        array_map(function($element) use (&$navList) {
            $navList[$element->id] = $element->title;
        }, $navRes);
        return $navList;
    }

    public static function menuItems($rootId = 0, $categoryId)
    {
        return self::model()->findAllByAttributes(array('parent' => $rootId, 'category' => $categoryId), array('order' => 'position'));
    }

    public function getMenu()
    {
       $menu = Yii::app()->db->createCommand()
            ->select('navigation.id, navigation.title, navigation_categories.title as category_title')
            ->from('navigation')
            ->join('navigation_categories', 'navigation_categories.id = navigation.category')
            ->queryAll();

        return $menu ;
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
