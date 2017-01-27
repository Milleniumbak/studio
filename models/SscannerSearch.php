<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Sscanner;

/**
 * SscannerSearch represents the model behind the search form about `app\models\Sscanner`.
 */
class SscannerSearch extends Sscanner
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pkscanner', 'fkusuario', 'fkimgevent'], 'integer'],
            [['estado', 'fechaing'], 'safe'],
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
        $query = Sscanner::find();

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
            'pkscanner' => $this->pkscanner,
            'fkusuario' => $this->fkusuario,
            'fkimgevent' => $this->fkimgevent,
            'fechaing' => $this->fechaing,
        ]);

        $query->andFilterWhere(['like', 'estado', $this->estado]);

        return $dataProvider;
    }
}
