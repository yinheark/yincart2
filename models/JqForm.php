<?php
/**
 * @link http://www.yincart.com/
 * @copyright Copyright (c) 2014 Yincart
 * @license http://www.yincart.com/license/
 */

namespace yincart\models;

use yii\data\ActiveDataProvider;
use yii\helpers\Json;

class JqForm extends ModelForm
{
    public $sortField = 'sidx';

    public $sortType = 'sord';

    public $pageSize = 'rows';

    public $defaultPageSize = 10;

    /**
     * @param array $filter
     * @param bool $returnProvider
     * @return array|ActiveDataProvider
     */
    public function search($filter = [], $returnProvider = false)
    {
        $query = $this->model->find(false);
        if ($filter) {
            $query = $query->where($filter);
        }

        $sortField = \Yii::$app->getRequest()->get($this->sortField);
        if ($sortField) {
            $sortType = \Yii::$app->getRequest()->get($this->sortType);
            $sortType = $sortType == 'desc' ? SORT_DESC : SORT_ASC;
            $query->orderBy([$sortField => $sortType]);
        }

        $pageSize = \Yii::$app->getRequest()->get('rows', $this->defaultPageSize);

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $pageSize,
            ],
        ]);

        if ($returnProvider) return $provider;

        $data = [
            'list' => $provider->getModels(),
            'page' => $provider->pagination->page + 1,
            'totalPage' => $provider->pagination->pageCount,
            'totalCount' => $provider->totalCount,
        ];

        return $data;
    }

    public $oper = 'oper';

    /**
     * @param bool $returnJson
     * @return bool|string
     */
    public function save($returnJson = true)
    {
        $primaryKeys = $this->model->primaryKey();
        $primaryKey = $primaryKeys[0];

        $operation = \Yii::$app->getRequest()->post($this->oper);
        if ($operation == 'edit') {
            $id = \Yii::$app->getRequest()->post($primaryKey);
            if (empty($id)) {
                $id = \Yii::$app->getRequest()->post('id');
            }

            if (empty($id) || !$this->model = $this->model->findOne($id)) {
                return $returnJson ? $this->renderJson() : false;
            }
        }

        if (in_array($operation, ['edit', 'add'])) {
            $this->model->setAttributes(\Yii::$app->getRequest()->post());
            $result = $this->model->save();
            return $returnJson ? $this->renderJson() : $result;
        }

        if ($operation == 'del') {
            $ids = \Yii::$app->getRequest()->post('id');
            if ($ids) {
                $ids = explode(',', $ids);
                if ($this->model->deleteAll([$primaryKey => $ids])) {
                    return Json::encode(['success' => 1, 'message' => \Yii::t('yincart', 'Delete Success!')]);
                }
            }
            return Json::encode(['success' => 0, 'message' => \Yii::t('yincart', 'Error ID!'), 'errors' => []]);
        }
        return false;
    }
} 