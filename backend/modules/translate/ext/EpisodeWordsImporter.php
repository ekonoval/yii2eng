<?php
namespace backend\modules\translate\ext;

use common\models\Translate\TrWord;

class EpisodeWordsImporter
{
    private $episodeID;
    private $rawContents;

    private $wordsImported = 0;

    function __construct($episodeID, $wordsRawContents)
    {
        $this->episodeID = @intval($episodeID);
        $this->rawContents = $wordsRawContents;
    }

    public function mainImport()
    {
        $lines = preg_split("/\r\n|\n|\r/", $this->rawContents);

        $insertData = [];

        foreach ($lines as $row) {
            $parts = explode(' - ', $row);
            if (sizeof($parts) == 2) {
                $word = trim($parts[0]);
                $translation = trim($parts[1]);

                $insertData[] = [$this->episodeID, $word, $translation, 0, 0];

                $this->wordsImported++;
            }
        }

        if (!empty($insertData)) {
            yDb()->createCommand()->batchInsert(TrWord::tableName(),
                ['episodeID', 'wordEN', 'wordRU', 'isHard', 'superHard'],
                $insertData
            )->execute();
        }

        return $this->wordsImported;
    }
}
