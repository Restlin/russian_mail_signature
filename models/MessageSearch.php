<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Message;
use yii\data\Sort;

/**
 * MessageSearch represents the model behind the search form of `app\models\Message`.
 */
class MessageSearch extends Message
{
    public $replyEmpty = false;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'status'], 'integer'],
            [['message', 'date_create', 'reply_to_message_id', 'replyEmpty'], 'safe'],
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
        $query = Message::find()->alias('t');
        $query->joinWith(['reply rr']);

        // add conditions that should always apply here

        $sort = new Sort([
            'attributes' => [
                'id', 'user_id', 'status'
            ],
            'defaultOrder' => ['status' => SORT_DESC],
        ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => $sort,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            't.user_id' => $this->user_id,
            't.status' => $this->status,
            't.date_create' => $this->date_create,
        ]);

        if ($this->replyEmpty) {
            $query->andWhere(['rr.id' => null]);
        }


        $query->andWhere(['t.reply_to_message_id' => $this->reply_to_message_id]);

        $query->andFilterWhere(['ilike', 't.message', $this->message]);

        return $dataProvider;
    }
}
