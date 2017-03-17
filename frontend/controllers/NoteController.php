<?php

namespace frontend\controllers;
use Yii;
use yii\web\Controller;
use frontend\models\EntryForm;
header('content-type:text/html;charset=utf8');
class NoteController extends Controller
{
	public function _getsql($sql){
		 return Yii::$app->db->createCommand($sql);
	}


	// 删除
	public function actionDel()
	{
		$id = Yii::$app->request->get('id');
		/*$sql="delete from note where id=$id";
		$this->_getsql($sql);*/
    	Yii::$app->db->createCommand()->delete('note' , 'id=:id' , [':id' => $id] )->execute();
		$this->redirect('?r=note/index');
			
	}
	//查询
	public function actionIndex(){
		 $sql= "select * from fen_test";  
    	 $arr=Yii::$app->db->createCommand($sql)->queryAll();
    	      echo '<pre>';
    	      print_r($arr);die;
    	 
    	return $this->render('say',['arr'=>$arr]);
    	
	}
	//更新数据
	public function actionUpdate(){
		
    	$id = Yii::$app->request->get('id');
    	$row=Yii::$app->db->createCommand("select * from note where id=$id")->queryOne();
		$model = new EntryForm;
		$model->username=$row['username'];
		$model->pwd=$row['pwd'];
		$model->status=$row['status'];
		$model->flag=1;
		     
	if ($model->load(Yii::$app->request->post())) {
			$post=Yii::$app->request->post()['EntryForm'];
		    Yii::$app->db->createCommand()->update('note' , ['username'=>$post['username'],'pwd'=>$post['pwd'],'status'=>$post['status']], 'id=:id' , [':id' => $id])->execute();
			return $this->redirect('?r=note/index');
            
        } else {
            return $this->render('form', [
                'model' => $model,
            ]);
        }
		
	}

	public function actionAdd(){
		$model = new EntryForm;
		$model->flag=0; 
        if ($model->load(Yii::$app->request->post())) {
			$post=Yii::$app->request->post()['EntryForm'];
		    $db = Yii::$app->db->createCommand();
			$db->insert('note' , ['username'=>$post['username'],'pwd'=>$post['pwd'],'status'=>$post['status']])->execute();
			return $this->redirect('?r=note/index');
            
        } else {
            return $this->render('form', [
                'model' => $model,
            ]);
        }
	}

	public function actionAjax(){
		 echo json_encode('我是来自内蒙古的美女黑大雪');
	}
}

?>