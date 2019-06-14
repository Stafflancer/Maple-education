<?php
/**
 * FaqCategorySearch model class file.
 */

namespace app\module\admin\module\faq\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

/**
 * FaqCategorySearch represents the model behind the search form of `app\module\admin\module\faq\models\FaqCategory`.
 */
class FaqCategorySearch extends FaqCategory
{
    /** @var string $faqCategoryName */
    public $faqCategoryName;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['faq_category_id', 'sort_order', 'created_at', 'updated_at'], 'integer'],
            [['status', 'faqCategoryName'], 'safe'],
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
        $query = FaqCategory::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        /**
         * Setup sorting attributes.
         */
        $dataProvider->setSort([
            'attributes' => [
                'faq_category_id',
                'faqCategoryName' => [
                    'asc' => ['tbl_faq_category_description.name' => SORT_ASC],
                    'desc' => ['tbl_faq_category_description.name' => SORT_DESC],
                    'label' => 'Категория'
                ],
                'status',
                'sort_order',
                'created_at',
                'updated_at',
            ],
            'defaultOrder' => [
                'sort_order' => SORT_ASC,
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'faq_category_id' => $this->faq_category_id,
            'status' => $this->status,
            'sort_order' => $this->sort_order,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->joinWith(['faqCategoryDescription' => function ($q) {
            /** @var ActiveQuery $q */
            $q->where('tbl_faq_category_description.name LIKE "%' . $this->faqCategoryName . '%"');
        }]);

        return $dataProvider;
    }
}
