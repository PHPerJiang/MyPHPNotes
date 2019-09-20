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
			'body' => ['name' => '11']
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

	//批量新增文档
	public function bulk_create(){
		$params = [];
		for ($i =1; $i<=10;$i++){
			$params['body'][] = [
				'create' => [
					'_index' => 'person',
					'_type'  => 'doc',
					'_id'     => $i
				]
			];
			$params['body'][] = [
				'name' => 'PHPerJiang'.$i,
				'age'  => $i,
				'sex'  => $i%2,
			];
		}
		$client = ClientBuilder::create()->build();
		var_dump($client->bulk($params));
	}

	//批量修改文档
	public function bulk_update(){
		$params = [];
		for ($i =1; $i<=10;$i++){
			$params['body'][] = [
				'update' => [
					'_index' => 'person',
					'_type'  => 'doc',
					'_id'     => $i
				]
			];
			$params['body'][] = [
				'doc' => [
					'name' => 'PHPerJiang'.($i+10),
					'age'  => $i+10,
					'sex'  => $i,
				]
			];
		}
		$client = ClientBuilder::create()->build();
		var_dump($client->bulk($params));
	}

	//批量删除
	public function bulk_delete(){
		$params = [];
		for ($i =1; $i<=10;$i++){
			$params['body'][] = [
				'delete' => [
					'_index' => 'person',
					'_type'  => 'doc',
					'_id'     => $i
				]
			];
		}
		$client = ClientBuilder::create()->build();
		var_dump($client->bulk($params));
	}

	//批量创建文档
	public function bulk_create_another(){
		$params = [
			'index' => 'person',
			'type'  => 'doc',
			'body'  => [],
		];

		for ($i =1; $i<=10;$i++){
			$params['body'][] = [
				'create' => [    //index 与 create一致都是创建文档
					'_id' => $i,
				]
			];
			$params['body'][] = [
				'name' => 'PHPerJiang'.$i,
				'age'  => $i,
				'sex'  => $i%2,
			];
		}
		$client = ClientBuilder::create()->build();
		var_dump($client->bulk($params));
	}

	//批量更新
	public function bulk_update_another(){
		$params = [
			'index' => 'person',
			'type'  => 'doc',
			'body'  => []
		];
		for($i = 1; $i <= 10; $i++){
			$params['body'][] = [
				'update' => [
					'_id' => $i
				]
			];
			$params['body'][] = [
				'doc' => [
					'name' => 'PHPerJiang'.$i*2,
					'age'  => $i*3,
					'sex'  => $i%2,
				]
			];
		}
		$client = ClientBuilder::create()->build();
		var_dump($client->bulk($params));
	}

	//批量删除
	public function bluk_delete_another(){
		$params = [
			'index' => 'person',
			'type'  => 'doc',
			'body'  => [],
		];
		for ($i = 1; $i <= 10; $i++){
			$params['body'][] = [
				'delete' => [
					'_id' => $i,
				]
			];
		}
		$client = ClientBuilder::create()->build();
		var_dump($client->bulk($params));
	}

	//部分更改doc,若 body 参数中指定一个 doc 参数。这样 doc 参数内的字段会与现存字段进行合并。
	public function update_doc(){
		$params = [
			'index' => 'person',
			'type'  => 'doc',
			'id'    => 2,
			'body'  => [
				'doc' => [
					'bbb' => '3'
				]
			]
		];
		$client = ClientBuilder::create()->build();
		var_dump($client->update($params));
	}

	//使用脚本更新数据
	public function update_doc_by_script(){
		$params = [
			'index' => 'person',
			'type'  => 'doc',
			'id'    => 2,
			'body'  => [
				'script' => [
					'lang' => 'painless',
					'source' => 'ctx._source.age += params.count',
					'params' => ['count' => 1],
				]
			]
		];
		$client = ClientBuilder::create()->build();
		var_dump($client->update($params));
	}

	//脚本修改数据，并给数据默认值
	public function update_doc_by_script_and_def()
	{
		$params = [
			'index' => 'person',
			'type' => 'doc',
			'id' => 8,
			'body' => [
				'script' => [
					'lang' => 'painless',
					'source' => "ctx._source.age1 = (ctx._source.age1 ?: 2) + params.count",
					'params' => [
						'count' => 5,
					],
				],
			],
		];
		$client = ClientBuilder ::create() -> build();
		var_dump($client -> update($params));
	}

	//复杂查询并打分
	public function search_complex(){
		//方式一
		$params = [
			'index' => 'person',
			'type'  => 'doc',
			'body'  => [
				'query' => [
					'bool' => [
						'filter' => [
							'term' => ['age1' => 22]
						],
						'must' => [
							'match_all' => new stdClass()
						]
					],
				],
			],
		];
		//方式二
		$params = [
			'index' => 'person',
			'type'  => 'doc',
			'body'  => [
				'query' => [
					'constant_score' => [
						'boost' => 2, //加权值
						'filter' => [
							'term' => ['age1' => 22]
						],
					],
				],
			],
		];
		$client = ClientBuilder ::create() -> build();
		echo json_encode($client -> search($params));
	}
}