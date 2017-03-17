<?php 

namespace frontend\controllers;
use yii\web\Controller;
use frontend\models\Company;
use Yii;
// use yii\data\Pagination;

class CompanyController extends Controller 
{
	public $layout = false;
	public function actionIndex()
    {
    	$model=new Company;
    	$company_info=$model->getAll();
    	// echo '<pre>';
    	// print_r($data);
    	return $this->render('company_index',['company_info'=>$company_info]);
    }
}