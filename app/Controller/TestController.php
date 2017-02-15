<?php
class TestController extends AppController {
	
	public function beforeFilter() {
		//纯服务，不需要view
		$this->autoRender = false;
	}
	
	public function index() {
		//请求例子：http://qxu1590160017.my3w.com/cms_t_01/test
		//请求例子：http://[域名]/[cms主目录]/[api名]
		$this->response->body("Hello,cakephp.<br>This is in test api index().<br>");
	}
	
	public function getClasses() {
		//这里没有用到
		$ret = array (
				'result' => [ ] 
		);
		
		//get请求的参数数组
		$query = $this->request->query;
		//post请求的参数数组
		$data = $this->request->data;
		
		//关联model
		$classes_model = $this->loadAppModel("TestModel");

		$s_id=5;
		
		$options = array ();
		$options ['order'] = 'id';
		
		//检索条件"id=5"
		$options ['conditions'] = array("id" => $s_id);
		
		$list = $classes_model->find ( "all", $options );
		
		$ret = array ();
		foreach ( $list as $row ) {
			if ($row [$classes_model->alias]) {
				$ret [] = $row [$classes_model->alias];
			}
		}

		$result=$ret[0];
		
		//查询结果数据自动对应数据库中的列名
		$id = $result["id"];
		$name = $result["name_cn"];

		$this->response->body("Hello,cakephp.<br>This is in test api getClasses().<br>search result: id = ".$id." name = ".$name);
	}
}