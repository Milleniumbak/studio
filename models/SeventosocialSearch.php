<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Seventosocial;

/**
 * SeventosocialSearch represents the model behind the search form about `app\models\Seventosocial`.
 */
class SeventosocialSearch extends Seventosocial
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pkevento'], 'integer'],
            [['sdescripcion', 'sdireccion', 'sfecha', 'stelefono', 'sestado'], 'safe'],
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
     * @param integer es el id del usuario que esta conectado
     * @return ActiveDataProvider
     */
    public function search($params, $pkUsr)
    {
        $query = Seventosocial::find();
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
            'pkevento' => $this->pkevento,
            'sfecha' => $this->sfecha,
            'fkusuario' => $pkUsr,
        ]);

        $query->andFilterWhere(['like', 'sdescripcion', $this->sdescripcion])
            ->andFilterWhere(['like', 'sdireccion', $this->sdireccion])
            ->andFilterWhere(['like', 'stelefono', $this->stelefono])
            ->andFilterWhere(['like', 'sestado', $this->sestado]);

        return $dataProvider;
    }
}
