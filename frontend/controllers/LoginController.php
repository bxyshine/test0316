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
use frontend\models\Login;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class LoginController extends Controller
{
	/**
	 * 登录 login
	 * @author baixiaoyu
	 * @param
	 * @return void
	 */
	public function actionLogin()
	{
		//接受表单提交的值
		$post=Yii::$app->request->post();
		if($post)
		{
			$email=$post['email'];
			$password=$post['password'];
			// $sql="select * from user where email=:email";
			// $arr=Yii::$app->db->createCommand($sql)->queryOne();
			$arr=Login::find()->where('email=:email',[':email'=>$email])->asArray()->one();
			// var_dump($arr);die;
			//判断邮箱是否存在
			if($arr)
			{
				//判断密码
				if(md5($password)==$arr['password'])
				{
					$next_time=time();
					$limit_time=$arr['limit_time'];
					$cha1=$next_time-$limit_time;
					if($cha1<30*60)
					{
						$ch1=ceil(30-$cha1/60);
						echo "<script> alert('请".$ch1."分钟以后再登录');location.href='?r=login/login'</script>";
					}else
					{
						$last_time=time();
						$last_ip=Yii::$app->request->userIp;
						// echo $last_ip;die;
			
						$info=Login::find()->where('u_id=:u_id',[':u_id'=>$arr['u_id']])->one();
						$info->limit_time=0;
						$info->error_num=0;
						$info->last_time=$last_time;
						$info->save();
						//登录成功后 开启session 存值
						$session=Yii::$app->session;
						$session->open();
						$session['user']=$arr;
						$this->redirect('?r=index/index');
					}
				}else
				{
					$error_num=$arr['error_num']+1;
					if($error_num<=5)
					{
						$info1=Login::find()->where('u_id=:u_id',[':u_id'=>$arr['u_id']])->one();
						$info1->error_num=$error_num;						
						$info1->save();
						$limit_num=5-$error_num;
						echo "<script> alert('密码错误输入".$error_num."次,还可以输入".$limit_num."次');location.href='?r=login/login'</script>";
					}
					if($error_num==5)
					{
						$limit_time=time();
						$info2=Login::find()->where('u_id=:u_id',[':u_id'=>$arr['u_id']])->one();
						$info2->limit_time=$limit_time;						
						$info2->save();
						echo "<script> alert('密码错误输入5次,请您30分钟以后再登录');location.href='?r=login/login'</script>";
					}
					if($error_num>5)
					{
						$next_time=time();
						$limit_time=$arr['limit_time'];
						$cha=$next_time-$limit_time;
						if($cha<30*60)
						{
							$ch=ceil(30-$cha/60);
							echo "<script> alert('请".$ch."分钟以后再登录');location.href='?r=login/login'</script>";
						}else
						{
							// Yii::$app->db->createCommand("update user set limit_time=0,error_num=0 where u_id='{$arr['u_id']}'")->execute();
							$info3=Login::find()->where('u_id=:u_id',[':u_id'=>$arr['u_id']])->one();
							$info3->limit_time=0;						
							$info3->error_num=0;						
							$info3->save();
						}
					}
					
				}
			}else
			{
				echo "<script > alert('邮箱不正确，请重新登录或注册');location.href='?r=login/login'</script>";
			}
		}else
		{
			return $this->renderPartial('login');
		}
	}

	/**
	 * 退出登录 loginout
	 * @author baixiaoyu
	 * @param
	 * @return void
	 */
	public function actionLoginout()
	{
		$session=Yii::$app->session;
		$session->open();
		unset($session['user']);
		$this->redirect('?r=index/index');
	}

	/**
	 * 注册 Register
	 * @author baixiaoyu
	 * @param
	 * @return void
	 */
	public function actionRegister()
	{
		//接受表单提交的值
		$post=Yii::$app->request->post();
		if($post)
		{

			$email=$post['email'];
			$arr=Yii::$app->db->createCommand("select * from user where email='{$email}'")->queryOne();
			if($email==$arr['email'])
			{
				echo "<script > alert('该邮箱已注册,请直接登录');location.href='?r=login/login'</script>";
			}else
			{
				$password=md5($post['password']);
				$type=$post['type'];
				$reg_time=time();
				$sql="insert into user (u_id,password,email,type) values (null,'{$password}','{$email}','{$type}')";
				Yii::$app->db->createCommand($sql)->execute();
			}
		}else
		{
			return $this->renderPartial('register');
		}
	}
}