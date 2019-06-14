<?php
/**
 * SocialNetworkSearch model class file.
 */

namespace app\module\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SocialNetworkSearch represents the model behind the search form of `app\module\admin\models\SocialNetwork`.
 */
class SocialNetworkSearch extends SocialNetwork
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['social_network_id', 'status', 'sort_order'], 'integer'],
            [['title', 'css_class', 'link'], 'safe'],
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
        $query = SocialNetwork::find();

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
            'social_network_id' => $this->social_network_id,
            'status' => $this->status,
            'sort_order' => $this->sort_order,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'css_class', $this->css_class])
            ->andFilterWhere(['like', 'link', $this->link]);

        return $dataProvider;
    }
}
