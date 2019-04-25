<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\httpclient\Client;

class SearchForm extends Model
{
    public $q;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['q'], 'required'],
            [['q'], 'string'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'q' => 'Search by ...',
        ];
    }

    /**
     * @param $start_from
     * @param $size
     * @return bool|mixed
     * @throws \yii\httpclient\Exception
     */
    public function getPosts($start_from, $size)
    {
        if ($this->validate()) {

            $client = new Client();

            $params = [
                'q' => $this->q,
            ];

            if ($start_from != 1) {
                $params['start_from'] = $start_from;
            }

            $response = $client->post("https://api.vk.com/method/newsfeed.search?&access_token=076e98a7076e98a7076e98a7b50704bf320076e076e98a75bd0ac0fdd84633c32a00df9&v=5.58&count=$size", $params)->send();

            foreach (json_decode($response->getContent())->response->items as $item) {
                if (\Yii::$app->cache->get("newsfeed{$item->id}") == false) {
                    \Yii::$app->cache->set("newsfeed{$item->id}", $item, 20 * 60); // 20 minute store in cache
                }
            }

            return json_decode($response->getContent())->response;
        }
        return false;
    }
}
