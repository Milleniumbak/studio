<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Gsolicitud;

/**
 * GsolicitudSearch represents the model behind the search form about `app\models\Gsolicitud`.
 */
class GsolicitudSearch extends Gsolicitud
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pksolicitud', 'fkusuario'], 'integer'],
            [['fecha', 'fecha_req', 'glosa', 'estado'], 'safe'],
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
        $query = Gsolicitud::find();

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
            'pksolicitud' => $this->pksolicitud,
            'fecha' => $this->fecha,
            'fecha_req' => $this->fecha_req,
            'fkusuario' => $this->fkusuario,
        ]);

        $query->andFilterWhere(['like', 'glosa', $this->glosa])
            ->andFilterWhere(['like', 'estado', $this->estado]);

        return $dataProvider;
    }
}
