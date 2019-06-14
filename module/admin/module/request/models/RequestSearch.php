<?php
/**
 * RequestSearch model class file.
 */

namespace app\module\admin\module\request\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * RequestSearch represents the model behind the search form of `app\module\admin\module\request\models\Request`.
 */
class RequestSearch extends Request
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['request_id', 'status', 'created_at'], 'integer'],
            [['name', 'phone', 'email', 'education', 'english_level', 'birthday_date'], 'safe'],
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
        $query = Request::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'request_id' => $this->request_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'education', $this->education])
            ->andFilterWhere(['like', 'english_level', $this->english_level])
            ->andFilterWhere(['like', 'birthday_date', $this->birthday_date]);

        return $dataProvider;
    }
}
