<?php

namespace frontend\controllers;

use Yii;
use app\models\Items;
use app\models\ItemsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UploadForm;
use yii\web\UploadedFile;




/**
 * ItemsController implements the CRUD actions for Items model.
 */
class ItemsController extends Controller
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
     * Lists all Items models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ItemsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Items model.
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
     * Creates a new Items model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        
        $model = new Items(); 
      
      if ($model->load(Yii::$app->request->post())) {            
            $file = \yii\web\UploadedFile::getInstance($model, 'file');
            if (!empty($file))
                $model->item_image = $file;

            if($model->save())
            {
             if (!is_dir(Yii::getAlias('@root') .'/uploads/' . $model->item_name)){
                 mkdir(Yii::getAlias('@root') .'/uploads/' . $model->item_name);

             }
              $file->saveAs( Yii::getAlias('@root') .'/uploads/' . $model->item_name .'/'. $file);

              return $this->redirect(['view', 'id' => $model->item_id]);
            }
            return $this->render('create', ['model' => $model]);
        } else {
            return $this->render('create', ['model' => $model]);
        }
    }



        /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->item_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);*/
    

    /**
     * Updates an existing Items model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

       if ($model->load(Yii::$app->request->post())){           
            $file = \yii\web\UploadedFile::getInstance($model, 'file');
           if (!empty($file)){
                 $delete = $model->oldAttributes['item_image'];
                 $model->item_image= $file; 
            }
            else{
                $model->item_image = $model->oldAttributes['item_image'];
            }
            if($model->save())
            {
             if (!empty($file))
              $file->saveAs( Yii::getAlias('@root') .'/uploads/' . $file);

              return $this->redirect(['view', 'id' => $model->item_id]);
            }
            return $this->render('update', ['model' => $model]);
        } else {
            return $this->render('update', ['model' => $model]);
        }
    }

    /**
     * Deletes an existing Items model.
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
     * Finds the Items model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Items the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Items::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
