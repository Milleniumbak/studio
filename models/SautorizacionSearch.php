<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Sautorizacion;

/**
 * SautorizacionSearch represents the model behind the search form about `app\models\Sautorizacion`.
 */
class SautorizacionSearch extends Sautorizacion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['token', 'topic', 'imei_device', 'fecha_registro'], 'safe'],
            [['fkusuario'], 'integer'],
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
        $query = Sautorizacion::find();

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
            'fkusuario' => $this->fkusuario,
            'fecha_registro' => $this->fecha_registro,
        ]);

        $query->andFilterWhere(['like', 'token', $this->token])
            ->andFilterWhere(['like', 'topic', $this->topic])
            ->andFilterWhere(['like', 'imei_device', $this->imei_device]);

        return $dataProvider;
    }
}
