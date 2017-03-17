<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $pwd
 * @property integer $status
 */
class Jobtype extends ActiveRecord
{
	//表名
	public static function tableName()
    {
        return '{{job_type}}';
    }
    /**
	 * 分类树
	 * @author lidingran
	 * @param 数组  父id
	 * @return array
	 */
	public function get_cat_tree($cat_list,$parent_id=0){
		$result=array();
		if($cat_list){
			foreach ($cat_list as $key => $val) {
				if($val['p_id']==$parent_id){
					$result[$key]=$val;
					$result[$key]['son']=$this->get_cat_tree($cat_list,$val['id']);
				}
			}
		}
		return $result;
	}

}
?>