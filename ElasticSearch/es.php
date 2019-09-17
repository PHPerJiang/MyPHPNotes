<?php
use Elasticsearch\ClientBuilder;
/**
 * @Author: jiangyu01
 * @Time: 2019/9/16 9:31
 */
class Es extends CI_Controller{
	public function init(){
		$this->load->helper('url');
	}
	//新增doc
	public function create_doc(){
		$params = [
			'index' => 'my_index',
			'type' => 'my_type',
			'id' => 'my_id',
			'body' => ['testField' => 'abc']
		];
		$client = ClientBuilder::create()->build();
		$response = $client->index($params);
		var_dump($response);
	}

	//获取doc
	public function get_doc(){
		$params = [
			'index' => 'my_index',
			'type'  => 'my_type',
			'id'    => 'my_id'
		];
		$client = ClientBuilder::create()->build();
		var_dump($client->get($params));
	}

	//搜索doc
	public function search_doc(){
		$params = [
			'index' => 'my_index',
			'type'  => 'my_type',
			'body'  => [
				'query' => [
					'match' => [
						'testField' => 'abc'
					]
				],
			],
		];
		$client = ClientBuilder::create()->build();
		$response = $client->search($params);
		var_dump($response);
	}

	//删除doc
	public function delete_doc(){
		$params = [
			'index' => 'my_index',
			'type'  => 'my_type',
			'id'    => 'my_id'
		];
		$client = ClientBuilder::create()->build();
		$response = $client->delete($params);
		var_dump($response);
	}

	//删除索引
	public function delete_index(){
		$client = ClientBuilder::create()->build();
		$response = $client->indices()->delete(['index'=>'my_index']);
		var_dump($response);
	}

	//创建索引
	public function create_index(){
		$params = [
			'index' => 'my_index',
			'body'  => [
				'settings' => [
					'number_of_shards' => 2,
					'number_of_replicas' => 0,
				]
			]
		];
		$client = ClientBuilder::create()->build();
		$response = $client->indices()->create($params);
		var_dump($response);
	}

	//查询高亮
	public function search_highlight(){
		$params = [
			'index' => 'my_index',
			'type'  => 'my_type',
			'body'  => [
				'query' => [
					'match' => [
						'testField' => 'abc'
					]
				],
				'highlight' => [
					'fields' => [
						'testField' => new \stdClass()
					],
				],
			],
		];
		$client = ClientBuilder::create()->build();
		$response = $client->search($params);
		print_r($response);
	}

	//创建比较负责的索引
	public function create_complex_idnex(){
		$mapping = [
			'properties' => [
				'name' => [
					'type' => 'keyword'
				],
				'age' => [
					'type' => 'integer'
				],
				'sex' => [
					'type' => 'keyword',
				]
			]
		];
		$setting = [
			'number_of_shards' => 3,
			'number_of_replicas' => 0,
		];
		$params = [
			'index' => 'person',
			'body'  => [
				'settings' => $setting,
				'mappings'  => [
					'doc' => $mapping,
				]
			]
		];
		$client = ClientBuilder::create()->build();
		$response = $client->indices()->create($params);
		echo json_encode($response);
	}

	//修改配置
	public function put_setting(){
		$params = [
			'index' => 'person',
			'body'  => [
				'settings' => [
					'number_of_replicas' => 10,
				]
			],
		];
		$client = ClientBuilder::create()->build();
		var_dump($client->indices()->putSettings($params));
	}

	//获取索引的配置信息
	public function get_setting(){
		$client = ClientBuilder::create()->build();
		echo json_encode($client->indices()->getSettings(['index' => 'person']));
	}

	//将修改mapping
	public function put_mapping(){
		$mapping = [
			'properties' => [
				'address' => [
					'type' => 'keyword',
				],
				'email'  => [
					'type' => 'keyword',
				]
			]
		];
		$params = [
			'index' => 'person',
			'type'  => 'doc',
			'body'  => $mapping,
		];
		$client = ClientBuilder::create()->build();
		var_dump($client->indices()->putMapping($params));
	}
}