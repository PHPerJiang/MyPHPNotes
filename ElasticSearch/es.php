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

	//函数式打分
	function create_func_score_doc(){
		$params = [
			'index' => 'func_score',
			'type'  => 'doc',
			'id'    => 2,
			'body'  => [
				'test' => 'quick fox',
				"popularity" => 5
			]
		];
		$client = ClientBuilder ::create() -> build();
		echo json_encode($client -> create($params));
	}

	/**
	 * 使用打分函数来进行排序
	 * @Author: jiangyu01
	 * @Time: 2019/9/20 18:00
	 */
	function search_func_score(){
		$params = [
			'index' => 'func_score',
			'type'  => 'doc',
			'body'  => [
				'query' => [
					'function_score' => [
						'query' => ['match' => ['test' => "quick brown fox"]],
						'script_score' => [
							'script' => [
								'lang' => 'expression',
								'source' => "_score + count",
								'params' => ['count' => 2],
							]
						]
					]
				]
			]
		];
		$client = ClientBuilder ::create() -> build();
		echo json_encode($client -> search($params));
	}

	/**
	 * 给一个字段打分
	 * @Author: jiangyu01
	 * @Time: 2019/9/21 14:34
	 */
	function search_script_field(){
		$params = [
			'index' => 'func_score',
			'type'  => 'doc',
			'body'  => [
				'query' => [
					'match_all' => new  \stdClass()
				],
				'script_fields' => [
					'test1' => [            //脚本获取文章值并计算积
						'script' => [
							'lang' => 'painless',
							'source' => "doc['popularity'].value * 2"
						]
					],
					'test2' => [            //脚本获取参数值并与文档值乘积
						'script' => [
							'lang' => 'painless',
							'source' => "doc['popularity'].value * params.count",
							'params' => ['count' => 3]
						]
					],
					'test3' => [               //给这个字段打分，但注意无法使用painless及paramas数组传值
						'script' => "params['_source']['popularity'] * 4"
					],
				]
			]
		];
		$client = ClientBuilder ::create() -> build();
		echo json_encode($client -> search($params));
	}

	/**
	 * 游标查询
	 * @Author: jiangyu01
	 * @Time: 2019/9/21 15:26
	 */
	public function search_by_scrolling(){
		$client = ClientBuilder ::create() -> build();
		$params = [
			'index' => 'func_score',
			'type'  => 'doc',
			'scroll' => "30s",      //设置游标时间
			'size'   => 1,          //设置每次查询数量
			'body'  => ['query' => ['match_all' => new \stdClass()],
			]
		];
		$response = $client->search($params);
		$result = isset($response['hits']['hits']) ? $response['hits']['hits'] : [];    //缓存初次结果
		while (isset($response['hits']['hits']) && count($response['hits']['hits']) > 0) {
			$scroll_id = $response['_scroll_id'];
			$response = $client->scroll([
					"scroll_id" => $scroll_id,  // 使用上个请求获取到的  _scroll_id
					"scroll" => "30s"           // 时间窗口保持一致
				]
			);
			$result_tmp = isset($response['hits']['hits']) ? $response['hits']['hits'] : [];
			$result = array_merge($result,$result_tmp);
		}
		var_dump($result);
	}

	/**
	 *
	 * @Author: jiangyu01
	 * @Time: 2019/9/21 17:27
	 */
	function agg_search(){
		$client = ClientBuilder ::create() -> build();
		$params = [
			'index' => 'func_score',
			'type'  => 'doc',
			'size'  => 0,
			'body'  => [
				'aggs' => [
					'avg_popularity' => ['avg' => ['field' => 'popularity']],   //根据文档去除字段计算平均值
					'avg_populartiy_by_script' => ['avg' => ['script' => ['source' => "doc.popularity.value * 2",]]],   //使用脚本计算平均值
					'avg_def'        => ['avg' => ['field' => 'grade','missing' => 10]]   //文档中不存在的字段聚合结果是null,也可以指定确实字段值
				],
			]
		];
		$response = $client->search($params);
		echo json_encode($response);
	}

	//单值、多值聚合
	function agg_search_1(){
		$client = ClientBuilder ::create() -> build();
		$params = [
			'index' => 'func_score',
			'type'  => 'doc',
			'size'  => 0,
			'body'  => [
				'aggs' => [
					'min'   => ['min' => ['field' => 'popularity']],  //最小值聚合
					'max'   => ['max' => ['field' => 'popularity']],  //最大值聚合
					'avg'   => ['avg' => ['field' => 'popularity']],  //均值聚合
					'sum'   => ['sum' => ['field' => 'popularity']],  //和值聚合
					'cardinality' => ['cardinality' =>['field' => 'popularity']], //基数聚合，比如你文档中设置的性别有 男女两种，则基数为2
					'stats' => ['stats' => ['field' => 'popularity']],  //基础度量，获取文档中此字段的基数、均值、最大、最小、和值
					'extended_stats' => ['extended_stats' => ['field' => 'popularity']],  //额外度量聚合
					'terms' => ['terms' => ['field' => 'popularity']],  //键值聚合，可以统计某个字段中每个键出现的次数
					'value_count' => ['value_count' => ['script' => ['source' => "doc.value"]]]  //值统计，有几个值
				],
			]
		];
		$response = $client->search($params);
		echo json_encode($response);
	}

	//聚合的排序
	function agg_search_term_sort(){
		$client = ClientBuilder ::create() -> build();
		$params = [
			'index' => 'func_score',
			'type'  => 'doc',
			'size'  => 0,
			'body'  => [
				'aggs' => [
					#根据聚合后的term及响应聚合中的key进行排序只在histogram 和 date_histogram中使用,事实上也能在terms使用，也叫字典排序
					'terms_by_key' => ['terms' => ['field' => 'popularity','order' => ['_key' => 'desc']]],
					#根据聚合后响应中的doc_count进行排序，对terms\histogram\date_histogram中使用
					'terms_by_count' => ['terms' => ['field' => 'popularity','order' => ['_count' => 'desc']]],
					#根据词项的字符串的字母顺序排序，只在terms中使用，term在6.0中已经被废弃，如果使用成功是因为代码中使用了key来代替term
					'terms_by_term' => ['terms' => ['field' => 'popularity','order' => ['_term' => 'desc']]]
				],
			]
		];
		$response = $client->search($params);
		echo json_encode($response);
	}

	//聚合中加过滤
	function agg_search_filter(){
		$client = ClientBuilder ::create() -> build();
		$params = [
			'index' => 'func_score',
			'type'  => 'doc',
			'size'  => 0,
			'body'  => [
				'aggs' => [
					'agg_filter' => [
						'filter' => ['term' => ['test' => "aaaaa"]],
						'aggs'    => ['terms' => ['terms' => ['field' => 'popularity']]]
					]
				],
			]
		];
		$response = $client->search($params);
		echo json_encode($response);
	}

	//多桶聚合，每个桶关联一个筛选项
	function agg_multi_search_filter(){
		$client = ClientBuilder ::create() -> build();
		$params = [
			'index' => 'func_score',
			'type'  => 'doc',
			'size'  => 0,
			'body'  => [
				'aggs' => [
					'multi_aggs' => [
						'filters' => [
							'other_bucket_key' => "other_bucket",
							'filters' => [
								'popularity13' => ['term' => ['popularity' => 13]],
								'popularity22' => ['term' => ['popularity' => 22]],
							]
						]
					]
				],
			]
		];
		$response = $client->search($params);
		echo json_encode($response);
	}

	//嵌套对象索引创建
	function nested_mapping_create(){
		$client = ClientBuilder ::create() -> build();
		$mappings = [
			'properties' => [
				'user' => [
					'type' => 'nested',
					'properties' => [
						'name' => ['type' => 'keyword'],
						'age'  => ['type' => 'integer']
					]
				]
			]
		];
		$params = [
			'index' => 'user',
			'body'  => [
				'doc' => $mappings,
			]
		];
		var_dump($client->indices()->create($params));
	}

	//嵌套对象文档创建
	function nseted_doc_create(){
		$client = ClientBuilder ::create() -> build();
		$params = [
			'index' => 'user',
			'type'  => 'doc',
			'id'    => 5,
			'body'  => [
				'user' => ['name' => 'Pythoner','age' => 30]
			]
		];
		var_dump($client->create($params));
	}

	//嵌套文档搜索
	function nested_doc_search(){
		$client = ClientBuilder ::create() -> build();
		$params = [
			'index' => 'user',
			'type'  => 'doc',
			'body'  => [
				'query' => [
					'nested' => [
						'path' => 'user',
						'query' => [
							'term' => ['user.name'=>'PHPer']
						]
					]
				]
			]
		];
		echo json_encode($client->search($params));
	}
}