<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reservas".
 *
 * @property int $id
 * @property int $usuario_id
 * @property int $vuelo_id
 * @property string $asiento
 * @property string $created_at
 *
 * @property Usuarios $usuario
 * @property Vuelos $vuelo
 */
class Reservas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reservas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario_id', 'vuelo_id', 'asiento'], 'required'],
            [['usuario_id', 'vuelo_id'], 'default', 'value' => null],
            [['usuario_id', 'vuelo_id'], 'integer'],
            [['asiento'], 'number'],
            [['created_at'], 'safe'],
            [['vuelo_id', 'asiento'], 'unique', 'targetAttribute' => ['vuelo_id', 'asiento']],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['usuario_id' => 'id']],
            [['vuelo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vuelos::className(), 'targetAttribute' => ['vuelo_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'usuario_id' => 'Usuario ID',
            'vuelo_id' => 'Vuelo ID',
            'asiento' => 'Asiento',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'usuario_id'])->inverseOf('reservas');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVuelo()
    {
        return $this->hasOne(Vuelos::className(), ['id' => 'vuelo_id'])->inverseOf('reservas');
    }
}
