<?php

namespace app\models;

use Yii;
use yii\base\Model;

class Blog extends Model
{
    const TABLE_NAME = 'messages';

    public $author;
    public $message;
    public $date;
    public $file = null;

    public function rules()
    {
        return [
            [['author', 'message'], 'required'],
            [['author', 'message'], 'string', 'min' => 2],
            ['file', 'file', 'mimeTypes' => 'image/*']
        ];
    }

    public function getMessagesList()
    {
        $sql = "SELECT author, date, message, path_to_file FROM ".self::TABLE_NAME." ORDER BY id DESC";

        $result = Yii::$app->db->createCommand($sql)->queryAll();

        return $result;
    }

    public function saveMessage()
    {
        if ($this->validate()) {
            $path = null;

            if ($this->file) {
                $path = 'uploads/'.$this->date.'_'.$this->file->baseName.'.'.$this->file->extension;
                $this->file->saveAs($path);
            }

            $sql = "INSERT INTO ".self::TABLE_NAME."(author, date, message, path_to_file) ".
                "VALUES (:author, :date, :message, :path_to_file)";

            return Yii::$app->db->createCommand($sql)
                ->bindParam(':author', $this->author)
                ->bindParam(':date', $this->date)
                ->bindParam(':message', $this->message)
                ->bindParam(':path_to_file', $path)
                ->execute();
        }
    }
}