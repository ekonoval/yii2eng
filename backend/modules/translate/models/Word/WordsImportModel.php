<?php
namespace backend\modules\translate\models\Word;

use yii\base\Model;
use yii\web\UploadedFile;

class WordsImportModel extends Model
{
    /**
     * @var UploadedFile
     */
    public $importFile;

    public function rules()
    {
        return [
            [['importFile'], 'file', 'extensions' => 'txt', 'mimeTypes' => 'text/plain'],
            [['importFile'], 'required']
        ];
    }



}
