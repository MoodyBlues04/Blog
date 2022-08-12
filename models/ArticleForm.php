<?php

namespace app\models;

use yii\base\Model;

class ArticleForm extends Model
{
    /** @var string $header */
    public $header;

    /** @var string $content */
    public $content;

    /** @var string|null $tags */
    public $tags;

    public function rules() {
        return [
            [['header', 'content'], 'required', 'message' => 'please fill in header and content'],
            [['tags'], 'validateTags', 'message' => 'Incorrect tags format.'],
        ];
    }

    /**
     * Loads form data to database
     * 
     * @throws \Exception
     * @return void
     */
    public function upload() {
        $article = new Article();
        $article->user_id = \Yii::$app->user->identity->id;
        $article->header = $this->header;
        $article->content = $this->content;

        $tags = explode('#', $this->tags);
        array_shift($tags);
        if (!empty($tags)) {
            $article->tags = json_encode($tags, JSON_UNESCAPED_UNICODE);
        }
        
        $article->created_at = date('Y-m-d H:i:s');
        if (!$article->save()) {
            throw new \Exception('model not saved');
        }

        foreach ($tags as $name) {
            $tag = new Tag();
            $tag->name = $name;
            if (!$tag->save()) {
                throw new \Exception('tag not saved');
            }

            $article->link('tags', $tag);
        }
    }

    /**
     * Validates tags
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateTags($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $tags = explode('#', $this->tags);
            array_shift($tags);
            foreach ($tags as $tag) {
                if (!ctype_alnum($tag)) {
                    $this->addError($attribute, 'Incorrect tags format.');
                    return;
                }
            }
        }
    }
}