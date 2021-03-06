<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Simgusuario;

/**
 * SimgusuarioSearch represents the model behind the search form about `app\models\Simgusuario`.
 */
class SimgusuarioSearch extends Simgusuario
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pkimgusuario', 'fkusuario'], 'integer'],
            [['path', 'fechaing'], 'safe'],
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
    public function search($params, $pkusuario)
    {
        $query = Simgusuario::find()->where(['fkusuario' => $pkusuario]);

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
            'pkimgusuario' => $this->pkimgusuario,
            'fkusuario' => $this->fkusuario,
            'fechaing' => $this->fechaing,
        ]);

        $query->andFilterWhere(['like', 'path', $this->path]);

        return $dataProvider;
    }
}
