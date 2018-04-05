<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Vuelos;

/**
 * VuelosSearch represents the model behind the search form of `app\models\Vuelos`.
 */
class VuelosSearch extends Vuelos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'origen_id', 'destino_id', 'compania_id'], 'integer'],
            [['salida', 'llegada'], 'safe'],
            [['codigo', 'origen.codigo', 'destino.codigo'], 'filter', 'filter' => 'mb_strtoupper'],
            [['plazas', 'precio'], 'number'],
            [['compania.denominacion'], 'safe'],
        ];
    }

    public function attributes()
    {
        return array_merge(parent::attributes(), [
            'origen.codigo',
            'destino.codigo',
            'compania.denominacion',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Vuelos::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // Combino con la tabla origen para poder acceder a sus datos.
        // Ahora a origen se accederá con el alias "o" para aeropuertos origen
        // y "d" para aeropuertos destino.
        $query->joinWith(['origen o', 'destino d', 'compania c']);

        // Establezco como ordenar por atributos fuera de esta tabla
        $dataProvider->sort->attributes['origen.codigo'] = [
            'asc' => ['o.codigo' => SORT_ASC],
            'desc' =>['o.codigo' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['destino.codigo'] = [
            'asc' => ['d.codigo' => SORT_ASC],
            'desc' =>['d.codigo' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['compania.denominacion'] = [
            'asc' => ['c.denominacion' => SORT_ASC],
            'desc' =>['c.denominacion' => SORT_DESC],
        ];

        // grid filtering conditions
        $query->andFilterWhere([
            'vuelos.codigo' => $this->codigo,
            'o.codigo' => $this->getAttribute('origen.codigo'),
            'd.codigo' => $this->getAttribute('destino.codigo'),
            'c.denominacion' => $this->getAttribute('compania.denominacion'),
            'salida' => $this->salida,
            'llegada' => $this->llegada,
            'plazas' => $this->plazas,
            'precio' => $this->precio,
        ]);

        return $dataProvider;
    }
}
