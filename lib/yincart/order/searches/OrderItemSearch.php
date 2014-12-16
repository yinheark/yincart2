<?php

namespace yincart\order\searches;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yincart\order\models\OrderItem;

/**
 * OrderItemSearch represents the model behind the search form about `yincart\order\models\OrderItem`.
 */
class OrderItemSearch extends OrderItem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_item_id', 'order_id', 'item_id', 'qty'], 'integer'],
            [['price'], 'number'],
            [['name', 'picture'], 'safe'],
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
        $query = OrderItem::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'order_item_id' => $this->order_item_id,
            'order_id' => $this->order_id,
            'item_id' => $this->item_id,
            'price' => $this->price,
            'qty' => $this->qty,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'picture', $this->picture]);

        return $dataProvider;
    }
}
