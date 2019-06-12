<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @Author: jiangyu01
 * @Time: 2019/5/30 15:45
 */
class Youhui_weekly_daren_db extends CI_Model{
	private $db = NULL;
	private $table_name = 'youhui_weekly_daren';
	public $fields = [
		'id'                 => array(0, NULL),
		'user_id'            => array(0, 0),
		'publish_time'       => array(0, ""),
		'weekly_id'          => array(0, 0),
		'baoliao_score'      => array(0, 0.0),
		'huoyue_score'       => array(0, 0.0),
		'daihuo_score'       => array(0, 0.0),
		'gongxian_score'     => array(0, 0.0),
		'hudong_score'       => array(0, 0.0),
		'chuangzao_score'    => array(0, 0.0),
		'baoliao_num'        => array(0, 0),
		'gold_num'           => array(0, 0),
		'weekly_type'        => array(0, ""),
		'super_baoliao_link' => array(0, ""),
		'medal_status'       => array(0, 0),
		'medal_pic'          => array(0, ""),
		'status'             => array(0, 1),
		'create_time'        => array(0, NULL),
		'update_time'        => array(0, NULL),
	];

	public function __construct() {
		parent::__construct();
		$this->db = $this->load->mysql('youhui');
		$this->load->helper('tool');
	}

	function get_error_code() {
		return $this->db->get_error_code();
	}

	/***
	 * 取单条数据
	 * @param array $where
	 * @return bool|array
	 * @author      jiangyu01
	 */
	public function find($where = [], $fields = '*') {
		$where_str = $this->build_where($where);
		if (empty($where)) {
			$where_str = '1=1';
		}
		$sql = "SELECT {$fields} FROM `{$this->table_name}`  where {$where_str}";
		$rs = $this->db->get_row($sql);
		return $rs;
	}

	/**
	 * 获取所有数据
	 * @param array $where
	 * @param string $order
	 * @param string $fields
	 * @return mixed
	 */
	public function get_all($where = [],$order = 'id desc', $fields = '*') {
		$where_str = $this->build_where($where);
		if (empty($where)) {
			$where_str = '1=1';
		}
		$sql = "SELECT {$fields} FROM `{$this->table_name}`  where {$where_str} order by $order";
		$rs = $this->db->get_all($sql);
		return $rs;
	}

	/***
	 * 查询列表
	 * @param array $where
	 * @param int $page
	 * @param int $page_size
	 * @return array|bool
	 * @author  jiangyu01
	 */
	public function select($where = [], $page = 1, $page_size = 1, $order = 'id desc', $fields = '*') {
		$page = absint(intval($page));
		$page = $page ? $page : 1;
		$page_size = absint(intval($page_size));
		$page_size = $page_size ? $page_size : 20;
		$offset = ($page - 1) * $page_size;
		$where_str = $this->build_where($where);
		if (empty($where)) {
			$where_str = '1=1';
		}
		$order = $this->db->escape($order);
		$sql = "SELECT {$fields} FROM `{$this->table_name}`  where {$where_str} ORDER BY {$order} limit {$offset},{$page_size}";
		if ($page_size == 0) {
			$sql = "SELECT {$fields} FROM `{$this->table_name}`  where {$where_str} ORDER BY id DESC ";
		}
		$rt = $this->db->get_all($sql);
		return $rt;
	}

	/***
	 * 总记录数
	 * @param array $where
	 * @return int
	 * @author jiangyu01
	 */
	public function total($where = []) {
		$where_str = $this->build_where($where);
		if (empty($where)) {
			$where_str = '1=1';
		}
		$sql = "SELECT COUNT(id) as total FROM `{$this->table_name}`  where {$where_str} ";
		$res = $this->db->get_row($sql);
		if (!empty($res['total'])) {
			return $res['total'];
		} else {
			return 0;
		}
	}

	/***
	 * 添加
	 * @param $new_data
	 * @return int
	 * @author     jiangyu01
	 */
	public function add($new_data) {
		$save_data = [];
		foreach ($this->fields as $k => $fv) {
			if (!isset($new_data[$k])) {
				$save_data[$k] = $fv[1];
			} else {
				$save_data[$k] = $new_data[$k];
			}
		}
		$insert_str = $this->build_insert($save_data);
		$sql = "insert into `{$this->table_name}` $insert_str ";
		$rs = $this->db->query($sql);
		return $rs;
	}

	/***
	 * 删除
	 * @param $where
	 * @return int
	 * @author     jiangyu01
	 */
	public function del($where) {
		$where_str = $this->build_where($where);
		$sql = "delete from `{$this->table_name}` WHERE {$where_str} ";
		$rs = $this->db->query($sql);
		return $rs;
	}

	/***
	 * 更新
	 * @param $where
	 * @param $new_data
	 * @return int
	 * @author    jiangyu01
	 */
	public function update($where, $new_data) {
		$where_str = $this->build_where($where);
		$data_str = $this->build_where($new_data, ',');
		$sql = "update `{$this->table_name}` set {$data_str} WHERE {$where_str} ";
		$rs = $this->db->query($sql);
		return $rs;
	}

	private function build_where($data, $glur = ' AND ') {
		$wheres = [];
		if (isset($data['G'])){
			$wheres[] =  $data['G'];
		}
		if (isset($data['L'])){
			$wheres[] =  $data['L'];
		}
		foreach ($data as $k => $v) {
			if (isset($this->fields[$k])) {
				if (is_array($v)) {
					if ($v[0] == 'like') {
						$wheres[] = "{$k} {$v[0]} '%" . $this->db->escape($v[1]) . "%'";
						continue;
					}
					if (in_array($v[0], ['in', 'not in', 'between'])) {
						$wheres[] = "{$k} {$v[0]}  {$v[1]}";
					} else {
						$wheres[] = "{$k} {$v[0]} '" . $this->db->escape($v[1]) . "'";
					}
				} else {
					$wheres[] = "{$k}='" . $this->db->escape($v) . "'";
				}
			}
		}
		if (empty($wheres)) {
			$wheres[] = " 1=1 ";
		}
		return implode($glur, $wheres);
	}

	private function build_insert($data) {
		$fs = [];
		$vs = [];
		foreach ($data as $k => $v) {
			$vs[] = "'" . $this->db->escape($v) . "'";
			$fs[] = $k;
		}
		$vs = implode(',', $vs);
		$fs = implode(',', $fs);
		return "($fs) values ({$vs})";
	}
}