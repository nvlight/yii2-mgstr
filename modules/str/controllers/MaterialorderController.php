<?php

namespace app\modules\str\controllers;

use app\components\Debug;
use Yii;
use app\modules\str\models\Materialorder;
use app\modules\str\models\MaterialorderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\str\models\Project;
use app\modules\str\models\Room;
use app\modules\str\models\Material;

/**
 * MaterialorderController implements the CRUD actions for Materialorder model.
 */
class MaterialorderController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Materialorder models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MaterialorderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Materialorder model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Materialorder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Materialorder();

        if ($model->load(Yii::$app->request->post()) ) {

            $room_id = intval(Yii::$app->request->get('id'));
            $project_id = null;
            if ($room_id){
                $project_id = Room::find()->where(['id' => $room_id])->one();
            }
            if ($project_id) $project_id = $project_id->id_parent;
            if (! $room_id || ! $project_id){
                return $this->render('/str/room/view?id='.$room_id, [
                    'model' => $model,
                ]);
            }
            $model->id_room = $room_id;
            $model->id_project = $project_id;
            $material = Material::find()->where(['id' => $model->id_material])->one();

            //echo Debug::d($model,'model'); die;
            // если price заполнен берем его иначае про прайсу считаем
            if (!$model->price){
                $model->price = $material->price;
            }
            $model->summ = $model->price * $model->count;

            //echo 'id: '. $id;
            //echo Debug::d($model,'model'); die;
            $model->save();

            return $this->redirect(['/str/room/view', 'id' => $room_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Materialorder model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            //echo Debug::d($model,'model'); die;
            //$model->id_room = $room_id;
            //$model->id_project = $project_id;

            // если price заполнен берем его иначае про прайсу считаем
            $material = Material::find()->where(['id' => $model->id_material])->one();
            if (!$model->price){
                $model->price = $material->price;
            }
            $model->summ = $model->price * $model->count;

            //echo 'id: '. $id;
            //echo Debug::d($model,'model'); die;
            $model->save();

            return $this->redirect(['/str/room/view', 'id' => $model->id_room]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Materialorder model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        //$this->findModel($id)->delete();
        $item = $this->findModel($id);
        $id_room = $item->id_room;
        $item->delete();

        return $this->redirect(['/str/room/view?id='.$id_room]);
    }

    /**
     * Finds the Materialorder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Materialorder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Materialorder::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
