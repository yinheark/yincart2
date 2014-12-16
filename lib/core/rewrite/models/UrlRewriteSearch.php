<?php

namespace core\rewrite\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use core\rewrite\models\UrlRewrite;

/**
 * UrlRewriteSearch represents the model behind the search form about `core\rewrite\models\UrlRewrite`.
 */
class UrlRewriteSearch extends UrlRewrite
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url_rewrite_id'], 'integer'],
            [['request_path', 'route', 'params'], 'safe'],
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
        $query = UrlRewrite::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'url_rewrite_id' => $this->url_rewrite_id,
        ]);

        $query->andFilterWhere(['like', 'request_path', $this->request_path])
            ->andFilterWhere(['like', 'route', $this->route])
            ->andFilterWhere(['like', 'params', $this->params]);

        return $dataProvider;
    }
}
