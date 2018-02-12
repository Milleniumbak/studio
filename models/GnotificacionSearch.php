<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Gnotificacion;

/**
 * GnotificacionSearch represents the model behind the search form of `app\models\Gnotificacion`.
 */
class GnotificacionSearch extends Gnotificacion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pkNotificacion', 'fkusuario'], 'integer'],
            [['codigo', 'codigoSol', 'titulo', 'cuerpo', 'estado', 'fecha'], 'safe'],
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
        $query = Gnotificacion::find();

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
            'pkNotificacion' => $this->pkNotificacion,
            'fecha' => $this->fecha,
            'fkusuario' => $this->fkusuario,
        ]);

        $query->andFilterWhere(['ilike', 'codigo', $this->codigo])
            ->andFilterWhere(['ilike', 'codigoSol', $this->codigoSol])
            ->andFilterWhere(['ilike', 'titulo', $this->titulo])
            ->andFilterWhere(['ilike', 'cuerpo', $this->cuerpo])
            ->andFilterWhere(['ilike', 'estado', $this->estado]);

        return $dataProvider;
    }
}
