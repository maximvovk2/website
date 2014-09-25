<?php

/**
 * This is the model class for table "staticpages".
 *
 * The followings are the available columns in table 'projects':
 * @property integer $id
 * @property string $title
 * @property string $activelink
 * @property string $text
 * @property string $etc
 *

 */
class Staticpages extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'staticpages';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
       return array(
            array('title', 'required', 'message' => 'This field is required'),
            array('id, title, activelink, text, etc', 'safe'),
            array('title', 'length', 'max' => 150, 'tooLong' => 'So big string'),
        );
    }

    /**
     * @return array relational rules.
     */
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
            'title' => 'Title',
            'activelink' => 'URL',
            'text' => 'Description',
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
        $criteria->compare('text',$this->text,true);
        $criteria->compare('activelink',$this->activelink,true);

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
     * @return Projects the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    protected function beforeValidate()
    {
        $this->title = trim($this->title);
        $this->activelink = trim($this->activelink);
        $this->text = trim($this->text);
        return parent::beforeValidate();
    }

    protected function beforeSave()
    {
        if ($this->isNewRecord){
//            $this->dateCreate = new CDbExpression('NOW()');
            $this->dateCreate = date( "Y-m-d H:i:s" );
        }
//        $this->dateUpdate = new CDbExpression('NOW()');
        $this->dateUpdate = date( "Y-m-d H:i:s" );
        $this->title = str_replace (' ','_',$this->title);
        $this->activelink = '/' . $this->title;
        return parent::beforeSave();
    }
}
