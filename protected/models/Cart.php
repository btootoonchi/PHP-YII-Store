<?php

/**
 * This is the model class for table "tbl_cart".
 *
 * The followings are the available columns in table 'tbl_cart':
 * @property integer $RecordId
 * @property string $CartId
 * @property integer $AlbumId
 * @property integer $Count
 * @property string $DateCreated
 *
 * The followings are the available model relations:
 * @property Album $album
 */
class Cart extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_cart';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CartId, AlbumId, Count, DateCreated', 'required'),
			array('AlbumId, Count', 'numerical', 'integerOnly'=>true),
			array('CartId', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('RecordId, CartId, AlbumId, Count, DateCreated', 'safe', 'on'=>'search'),
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
			'album' => array(self::BELONGS_TO, 'Album', 'AlbumId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'RecordId' => 'Record',
			'CartId' => 'Cart',
			'AlbumId' => 'Album',
			'Count' => 'Count',
			'DateCreated' => 'Date Created',
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

		$criteria->compare('RecordId',$this->RecordId);
		$criteria->compare('CartId',$this->CartId,true);
		$criteria->compare('AlbumId',$this->AlbumId);
		$criteria->compare('Count',$this->Count);
		$criteria->compare('DateCreated',$this->DateCreated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cart the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
