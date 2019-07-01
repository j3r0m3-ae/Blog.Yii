<?php

namespace app\models;

use yii\db\ActiveRecord;

class Messages extends ActiveRecord
{
    public $file;

    public function rules()
    {
        return [
            [['author', 'message'], 'required'],
            [['author', 'message'], 'string', 'min' => 2],
            ['file', 'file', 'mimeTypes' => 'image/*']
        ];
    }

    public function getDate()
    {
        return date('H:i:s d.m.Y', $this->date);
    }

    public function getPathToFile()
    {
        return $this->file ? 'uploads/'.$this->date.'_'.$this->file->baseName.'.'.$this->file->extension : null;
    }

    public function saveImage()
    {
        $this->file->saveAs($this->path_to_file);
    }
}