<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Position;
use frontend\models\Company;

/**
 * Work controller
 */
class WorkController extends Controller
{
	//公司首页
	public function actionSearch()
    {
        // $model=new Position;
        $search_data=Yii::$app->request->post();
        $search=$search_data['kd'];
        $infos=Position::find()->joinWith('company')->where(['like','positionName',$search])->asArray()->all();
        foreach($infos as $k=>$v)
        {
            $id=$v['company']['id'];
            $sql = "select username from createc where id='$id'";
            $c_info=yii::$app->db->createCommand($sql)->queryOne();
            $infos[$k]['createc']=$c_info;
        }
        // echo '<pre>';
        // print_r($infos);
        // print_r($c_info);
        // print_r($jobs);
        return $this->renderPartial('work_search',['infos'=>$infos,'search'=>$search ]);
    }

    //职位详情页
        public function actionDeliver()
        {
            $p_id = 7;
            $sql = "select * from position as p join company as c on c.id=p.c_id where p.id='$p_id'";
            $data = Yii::$app->db->createCommand($sql)->queryAll();
            // print_r($data[0]);die;
            
            // $infos=Search::find()->joinWith('company')->where(['like','positionName',$search])->asArray()->all();
            
            return $this->renderPartial('work_deliver',['data'=>$data[0]]);
        }

}


?>