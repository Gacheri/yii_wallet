<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Deposit;

/**
 * DepositSearch represents the model behind the search form of `frontend\models\Deposit`.
 */
class DepositSearch extends Deposit
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['transId', 'MerchantRequestId', 'walletId', 'createdBy', 'status'], 'integer'],
            [['transAmount'], 'number'],
            [['details', 'reciept', 'transDate'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Deposit::find();

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
            'transId' => $this->transId,
            'MerchantRequestId' => $this->MerchantRequestId,
            'walletId' => $this->walletId,
            'transAmount' => $this->transAmount,
            'transDate' => $this->transDate,
            'createdBy' => $this->createdBy,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'details', $this->details])
            ->andFilterWhere(['like', 'reciept', $this->reciept]);

        return $dataProvider;
    }
}
