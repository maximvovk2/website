<?php

/**
 * This is the model class for table "documents".
 *
 * The followings are the available columns in table 'documents':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $file
 * @property integer $downloaded
 * @property integer $position
 */
class Documents extends CActiveRecord
{  
    public $file;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'documents';
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
			array('downloaded, position, idTitle', 'numerical', 'integerOnly'=>true),
			array('title, file', 'length', 'max'=>255),
			array('idTitle', 'unique', 'allowEmpty' => true,'message' => 'This title already has attachment:',),
			array('file', 'file', 'allowEmpty' => false, 'types' => 'pdf', 'on' => 'insert'),
            array('file', 'file', 'allowEmpty' => true, 'types' => 'pdf', 'on' => 'update'),
			array('id, title, description, file, downloaded, position, idTitle', 'safe')
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
			'file' => 'File',
			'downloaded' => 'Downloaded',
			'position' => 'Position',
			'idTitle' => 'Connected with',
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
		$criteria->compare('file',$this->file,true);
		$criteria->compare('downloaded',$this->downloaded);
		$criteria->compare('position',$this->position);
		$criteria->compare('idTitle',$this->idTitle);

        $pagination = new CPagination; $pagination->pageSize = Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']);
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination' => $pagination,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Documents the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function titleDocument ($id)
    {
        $titleDoc = Yii::app()->db->createCommand()
            ->select('id, title')
            ->from('documents')
            ->where('idTitle=:id', array(':id'=>$id))
            ->queryAll();
        $idTitle[0] = $titleDoc[0]["title"];
        $idTitle[1] = $titleDoc[0]["id"];

        return $idTitle;
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
