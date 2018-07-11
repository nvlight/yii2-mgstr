<?php

namespace app\modules\str\controllers;

use http\Url;
use Yii;
use app\modules\str\models\Material;
use app\modules\str\models\MaterialSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\Debug;
use yii\web\UploadedFile;

/**
 * MaterialController implements the CRUD actions for Material model.
 */
class MaterialController extends Controller
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
     * Lists all Material models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MaterialSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Material model.
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
     * Creates a new Material model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Material();

        if ($model->load(Yii::$app->request->post())) {

            $model->image_id = rand(15,9999);
            $model->img = UploadedFile::getInstance($model, 'img');
            if ($model->img){
                $model->upload();
            }else{
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
            $model->image_id = $model->img->baseName . '.' . $model->img->extension;
            $sv = $model->save();
            //if (!$sv) die('sv is false');

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Material model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            //$model->image_id = rand(15,9999);
            $model->img = UploadedFile::getInstance($model, 'img');
            //echo Debug::d($model->img,'$model->img'); die;
            if ($model->img){
                $model->upload();
                $model->image_id = $model->img->baseName . '.' . $model->img->extension;
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Material model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Material model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Material the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Material::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    //
    public function actionChange(){

        //
        $from_dir = Yii::$app->params['img_toconvert'];
        $to_dir =   Yii::$app->params['img_converted'];

        $from_img_arr = [];
        foreach (glob($from_dir . "*.*") as $img_name){
            $from_img_arr[] = $img_name;
        }
        //echo Debug::d($from_img_arr);

        //$image = \yii\helpers\Url::to(['@web/'.Yii::$app->params['img_uploads'] . 'img1.png' ],true);
        //die($image . ' fe: ' . intval(file_exists($image)));

        // далее пройдемся по всем изображениям и
        foreach($from_img_arr as $k => $v) {
            $maxwidth = 260;
            $maxheight = 280;

            $img = imagecreatefrompng($v);
            //or imagecreatefrompng,imagecreatefromgif,etc. depending on user uploaded file extension

            $width = imagesx($img); //get width and height of original image
            $height = imagesy($img);

            //determine which side is the longest to use in calculating length of the shorter side, since the longest will be the max size for whichever side is longest.
            if ($height > $width) {
                $ratio = $maxheight / $height;
                $newheight = $maxheight;
                $newwidth = $width * $ratio;
            } else {
                $ratio = $maxwidth / $width;
                $newwidth = $maxwidth;
                $newheight = $height * $ratio;
            }

            //create new image resource to hold the resized image
            $newimg = imagecreatetruecolor($newwidth, $newheight);

            $palsize = ImageColorsTotal($img);  //Get palette size for original image
            for ($i = 0; $i < $palsize; $i++) //Assign color palette to new image
            {
                $colors = ImageColorsForIndex($img, $i);
                ImageColorAllocate($newimg, $colors['red'], $colors['green'], $colors['blue']);
            }

            //copy original image into new image at new size.
            imagecopyresized($newimg, $img, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

            //echo $newimg;
            $new_filename = \yii\helpers\Url::to(['@web/' . Yii::$app->params['img_uploads'] . 'img1222.png'], true);
            $new_filename = Yii::$app->params['img_uploads'] . 'img1222.png';
            // изменяем папку сохранения картинки
            $new_filename = $to_dir . explode('/', $v)[1];

            //header('Content-Type: image/png');
            imagepng($newimg, $new_filename); //$output file is the path/filename where you wish to save the file.
            //Have to figure that one out yourself using whatever rules you want.  Can use imagegif() or imagepng() or whatever.
        }

    }
}
