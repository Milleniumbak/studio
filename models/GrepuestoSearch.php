<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Grepuesto;

/**
 * GrepuestoSearch represents the model behind the search form of `app\models\Grepuesto`.
 */
class GrepuestoSearch extends Grepuesto
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pkarticulo', 'fkgrupo', 'fksubgrupo', 'fkfabricante', 'fkmodelo', 'fksistema', 'fkunidad', 'fkubicacion'], 'integer'],
            [['descripcion', 'codigo_completo', 'nroparte'], 'safe'],
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
        $query = Grepuesto::find();

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
            'pkarticulo' => $this->pkarticulo,
            'fkgrupo' => $this->fkgrupo,
            'fksubgrupo' => $this->fksubgrupo,
            'fkfabricante' => $this->fkfabricante,
            'fkmodelo' => $this->fkmodelo,
            'fksistema' => $this->fksistema,
            'fkunidad' => $this->fkunidad,
            'fkubicacion' => $this->fkubicacion,
        ]);

        $query->andFilterWhere(['ilike', 'descripcion', $this->descripcion])
            ->andFilterWhere(['ilike', 'codigo_completo', $this->codigo_completo])
            ->andFilterWhere(['ilike', 'nroparte', $this->nroparte]);

        return $dataProvider;
    }
}
