<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Simgevent;

/**
 * SimgeventSearch represents the model behind the search form about `app\models\Simgevent`.
 */
class SimgeventSearch extends Simgevent
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pkimgevent', 'fkevent'], 'integer'],
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
     * @param $fkevent Identificador de evento
     *
     * @return ActiveDataProvider
     */
    public function search($params, $fkevent)
    {
        $query = Simgevent::find()->where(['fkevent' => $fkevent]);

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
            'pkimgevent' => $this->pkimgevent,
            'fkevent' => $this->fkevent,
            'fechaing' => $this->fechaing,
        ]);

        $query->andFilterWhere(['like', 'path', $this->path]);

        return $dataProvider;
    }
}
