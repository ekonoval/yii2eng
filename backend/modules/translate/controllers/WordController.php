<?php
namespace backend\modules\translate\controllers;

use backend\modules\translate\ext\EpisodeWordsImporter;
use backend\modules\translate\models\Word\WordsImportModel;
use backend\modules\translate\models\Word\BWordSave;
use backend\modules\translate\models\Word\BWordSearch;
use common\ext\Misc\FlashMessageCreator;
use common\models\Translate\TrEpisode;
use common\models\Translate\TrWord;
use Yii;
use yii\web\UploadedFile;

class WordController extends TranslateController
{
    /**
     * @var TrEpisode
     */
    public $episodeCurrent;

    protected function breadcrumps()
    {
        parent::breadcrumps();

        $episodeID = yR()->get('episodeID');

        if (in_array($this->action->id, ['update'])) {
            $wordID = yR()->get('id');
            $word = TrWord::find()->select('episodeID')->filterWhere(['wordID' => $wordID])->one();

            if ($word) {
                $episodeID = $word->episodeID;
            }
        }

        if ($episodeID > 0) {
            /** @var TrEpisode $episode */
            $episode = TrEpisode::find()
                //->with('movie')
                ->where('episodeID = :episodeID', [':episodeID' => $episodeID])
                ->one()
            ;

            if (!empty($episode)) {
                $this->episodeCurrent = $episode;
                $this->bcMovieEpisodes($episode->movieID);

                $this->addBreadcrump(
                    $this->composeEpisodePlusSeasonString($episode),
                    $this->composeWordsIndex($episodeID)
                );
            }
        }
    }

    public function actionIndex($episodeID)
    {
        $searchModel = new BWordSearch();
        $searchModel->setEpisodeID($episodeID);
        //$dataProvider = $searchModel->search(Yii::$app->request->post());
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        $filterUrl = $this->createWordsListUrl($episodeID);

        return $this->renderActionTpl([
            'title' => $this->composeEpisodePlusSeasonString($this->episodeCurrent),
            'filterUrl' => $filterUrl,
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    public function actionUpdate($id)
    {
        $model = BWordSave::findModel($id);

        if (
            $model->load(yR()->post())
            && $model->save()
        ) {
            return $this->redirect($this->composeWordsIndex($model->episodeID));
        } else {
            //pa($model->getErrors());
            return $this->render('edit_tpl', [
                'model' => $model,
                'title' => 'title1'
            ]);
        }
    }

    public function actionCreate()
    {
        $model = new BWordSave();

        $modelLoaded = $model->load(yR()->post());
        $model->episodeID = $this->episodeCurrent->episodeID;

        if ($modelLoaded && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect($this->composeWordsIndex($model->episodeID));
        } else {
            //pa($model->getErrors());
            return $this->render('edit_tpl', [
                'model' => $model,
                'title' => "Create a word",
            ]);
        }
    }

    public function actionDelete($id)
    {
        $model = BWordSave::findModel($id);

        if ($model) {
            $model->delete();
        }

        return $this->redirect($this->composeWordsIndex($model->episodeID));
    }

    public function actionImport($episodeID)
    {
        $model = new WordsImportModel();

//        $wordsImporter = new EpisodeWordsImporter($episodeID, file_get_contents('/home/ekonoval/Documents/eng-work.txt'));
//        $wordsImporter->mainImport();exit;

        if (yR()->isPost) {
            $model->importFile = UploadedFile::getInstance($model, 'importFile');

            if ($model->importFile && $model->validate()) {
                $contents = file_get_contents($model->importFile->tempName);
                $wordsImporter = new EpisodeWordsImporter($episodeID, $contents);
                $wordsAmountImported = $wordsImporter->mainImport();

                $fm = new FlashMessageCreator();
                if ($wordsAmountImported > 0) {
                    $fm->addSuccess("Amount of words imported: {$wordsAmountImported}");
                } else {
                    $fm->addWarning('No words have been imported!');
                }

                return $this->redirect($this->composeWordsIndex($episodeID));
            }
        }

        return $this->renderActionTpl([
            'model' => $model
        ]);
    }

    public function composeEpisodePlusSeasonString(TrEpisode $episode)
    {
        return "S{$episode->seasonNum}-E{$episode->episodeNum}";
    }

    protected function composeWordsIndex($episodeID)
    {
        return $this->composeModuleUrl('index', 'word', ['episodeID' => $episodeID]);
    }

}
