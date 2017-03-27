<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Prenda;

/**
 * PrendaSearch represents the model behind the search form about `app\models\Prenda`.
 */
class PrendaSearch extends Prenda
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idPrenda', 'dueno', 'idTalla', 'tipoPrendaId'], 'integer'],
            [['color', 'descripcion', 'estado'], 'safe'],
            [['Tipo.descripcion'], 'safe']
        ];
    }

    /**
     * @inheritdoc
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
        $query = Prenda::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'idPrenda' => $this->idPrenda,
            'dueno' => $this->dueno,
            'idTalla' => $this->idTalla,
            'tipoPrendaId' => $this->tipoPrendaId,

        ]);

        $query->andFilterWhere(['like', 'color', $this->color])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'estado', $this->estado]);

        return $dataProvider;
    }
}
