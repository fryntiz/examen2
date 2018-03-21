<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "companias".
 *
 * @property int $id
 * @property string $denominacion
 *
 * @property Vuelos[] $vuelos
 */
class Companias extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'companias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['denominacion'], 'required'],
            [['denominacion'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'denominacion' => 'Denominación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVuelos()
    {
        return $this->hasMany(Vuelos::className(), ['compania_id' => 'id'])->inverseOf('compania');
    }
}
