<?php

namespace app\controllers;

use app\components\Debug;
use Yii;
use app\modules\str\models\Room;
use app\modules\str\models\RoomSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\str\models\Order;
use app\modules\str\models\Materialorder;

/**
 * RoomController implements the CRUD actions for Room model.
 */
class RoomController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all Room models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RoomSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Room model.
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
     * Creates a new Room model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Room();

        if ($model->load(Yii::$app->request->post())  )
        {
            $model->id_parent = Yii::$app->request->get('id');
            //echo Debug::d($model,'model');
            //echo Debug::d(Yii::$app->request->get(),'Yii::$app->request->get()'); die;
            //&& $model->load(Yii::$app->request->get());
            if ($model->save())
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Room model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Room model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $item = $this->findModel($id);
        $id_project = $item->id_parent;
        // нужно узнать есть ли записи из таблиц РаботаЗаказ и МатериалЗаказ соотв. этой комнате
        // если есть, то комнату нельзя удалить
        $job_order = Order::find()->where(['id_room' => $item->id])->count();
        $material_order = Materialorder::find()->where(['id_room' => $item->id])->count();
        //echo Debug::d($job_order,'j_order');
        //echo Debug::d($material_order,'m_order');

        if ($job_order || $material_order){
            Yii::$app->session->setFlash('room_delete',
                ['success' => 'no', 'message' => 'Нельзя удалить комнату, если за ним закреплена работа и/или материалы']
            );
            return $this->redirect(['/str/room/view?id='.$item->id]);
        }
        //die;
        $item->delete();
        Yii::$app->session->setFlash('room_delete',
            ['success' => 'yes', 'message' => 'комната удалена']
        );

        //echo Debug::d(Yii::$app->session); die;

        return $this->redirect(['/str/project/view?id='.$id_project]);
    }

    /**
     * Finds the Room model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Room the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Room::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
