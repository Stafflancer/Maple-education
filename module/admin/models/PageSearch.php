<?php
/**
 * PageSearch model class file.
 */

namespace app\module\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * PageSearch represents the model behind the search form of `app\module\admin\models\Page`.
 */
class PageSearch extends Page
{
    public $pageName;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['page_id', 'top', 'status', 'sort_order', 'created_at', 'updated_at'], 'integer'],
            [['pageName'], 'safe']
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
        $query = Page::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        /**
         * Setup your sorting attributes
         * Note: This is setup before the $this->load($params)
         * statement below
         */
        $dataProvider->setSort([
            'attributes' => [
                'page_id',
                'pageName' => [
                    'asc' => ['tbl_page_description.title' => SORT_ASC],
                    'desc' => ['tbl_page_description.title' => SORT_DESC],
                    'label' => 'Название'
                ],
                'status',
                'sort_order',
                'created_at',
                'updated_at',
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $query->joinWith(['page_description']);
            return $dataProvider;
        }

        $query->andFilterWhere([
            'page_id' => $this->page_id,
            'top' => $this->top,
            'status' => $this->status,
            'sort_order' => $this->sort_order,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->joinWith(['pageDescription' => function ($q) {
            $q->where('tbl_page_description.title LIKE "%' . $this->pageName . '%"');
        }]);

        return $dataProvider;
    }
}
