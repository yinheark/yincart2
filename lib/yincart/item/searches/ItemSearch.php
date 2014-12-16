<?php

namespace yincart\item\searches;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yincart\item\models\Item;

/**
 * ItemSearch represents the model behind the search form about `yincart\item\models\Item`.
 */
class ItemSearch extends Item
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'stock_qty', 'min_sale_qty', 'max_sale_qty', 'is_free_shipping', 'sort', 'status', 'store_id'], 'integer'],
            [['sku', 'name', 'description', 'short_description', 'meta_keywords', 'meta_description', 'pictures'], 'safe'],
            [['original_price', 'price', 'weight', 'shipping_fee'], 'number'],
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
        $query = Item::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'item_id' => $this->item_id,
            'original_price' => $this->original_price,
            'price' => $this->price,
            'stock_qty' => $this->stock_qty,
            'min_sale_qty' => $this->min_sale_qty,
            'max_sale_qty' => $this->max_sale_qty,
            'weight' => $this->weight,
            'shipping_fee' => $this->shipping_fee,
            'is_free_shipping' => $this->is_free_shipping,
            'sort' => $this->sort,
            'status' => $this->status,
            'store_id' => $this->store_id,
        ]);

        $query->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'short_description', $this->short_description])
            ->andFilterWhere(['like', 'meta_keywords', $this->meta_keywords])
            ->andFilterWhere(['like', 'meta_description', $this->meta_description])
            ->andFilterWhere(['like', 'pictures', $this->pictures]);

        return $dataProvider;
    }
}
