<?php
namespace frontend\controllers;
header('content-type:text/html;charset=utf-8');

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\Index;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class IndexController extends Controller
{
	/**
	 * 首页展示  index
	 * @author baixiaoyu
	 * @param
	 * @return void
	 */
	public function actionIndex()
	{
		$userinfo='';
		$session=Yii::$app->session;
		$session->open();
		$userinfo=$session['user'];
		// var_dump($userinfo);die;
		
		//分类树
		$type=Yii::$app->db->createCommand("select * from job_type")->queryAll();
		$type_tree=$this->gettree($type);
		return $this->renderPartial('index',['userinfo'=>$userinfo,'type_tree'=>$type_tree]);
	}

	/**
	 * 分类树 
	 * @author baixiaoyu
	 * @param
	 * @return void
	 */	
	public function gettree($type,$parent_id=0)
	{
		$result=array();
		if($type)
		{
			foreach($type as $key=>$v)
			{
				if($v['p_id']==$parent_id)
				{
					$result[$key]=$v;
					$result[$key]['son']=$this->gettree($type,$v['id']);

				}
			}
			return $result;
		}
		
	}	
		
}