<?php

class Membership_Base_Model_Base extends Rsc_Mvc_Model implements Rsc_Environment_AwareInterface {

    private $_internalErrors = array();
	private $_listQuery = null;
	private $datetimeFormat = 'Y-m-d H:i:s';
	protected $_idField = 'id';

	function __construct($environment) {
		parent::__construct();
		$this->setEnvironment($environment);
        $this->db->hide_errors();
	}

    /**
     * @var Rsc_Environment
     */
    protected $environment;

    /**
     * Sets the environment.
     * @param Rsc_Environment $environment
     */
    public function setEnvironment(Rsc_Environment $environment) {
        $this->environment = $environment;
    }

    /**
     * Returns both database and plugin prefixes.
     * @return string
     */
    public function getPrefix() {
        if (!$this->environment) {
            throw new RuntimeException('Can\'t get prefix without app environment.');
        }

        $database = $this->db->prefix;
        $plugin = $this->environment->getConfig()->get('db_prefix');

        return $database.$plugin;
    }

    /**
     * Returns the raw table name of the current model.
     * @return string
     */
    public function getRawTableName() {
        $classNameParts = explode('_', get_class($this));
        return strtolower(end($classNameParts));
    }

    /**
     * Returns table name.
     * @param string|null $tableName Optional table name. Model name will be used if parameter is NULL.
     * @return string
     */
    public function getTable($tableName = null) {
        if (null === $tableName) {
            $tableName = $this->getRawTableName();
        }

        return $this->getPrefix(). $tableName;
    }

    public function getDispatcher()  {
	    return $this->environment->getDispatcher();
    }

    public function getModule($module, $modulePrefix = null) {
		if(!empty($modulePrefix)) {
			$module = $modulePrefix. '_'. $module;
		}
        return $this->environment->getModule($module);
    }

    public function getModel($model = null, $module = null, $prefix = null) {
        return $this->environment->getModule('membership')->getModel($model, $module, $prefix);
    }

    public function preparePrefix($sql) {
        return str_replace(array('{prefix}', '{wp_prefix}', '{wp_base_prefix}'), array($this->getPrefix(), $this->db->prefix, $this->db->base_prefix), $sql);
    }
	public function getData( $query, $get = 'all', $outputType = ARRAY_A ) {
		$get = strtolower($get);
        $res = NULL;
		if(is_object($query)) {	// Chain query builder passed - let's build it before execution ;)
			$query = $query->build();
		}
		if(is_array($query)) {
			$sqlQuery = array_shift( $query );
			$queryParams = $query;
			$query = $this->db->prepare($sqlQuery, $queryParams);
		}
        $query = $this->preparePrefix( $query );
        switch($get) {
            case 'one':
                $res = $this->db->get_var($query);
                break;
            case 'row':
                $res = $this->db->get_row($query, $outputType);
                break;
            case 'col':
                $res = $this->db->get_col($query);
                break;
            case 'all':
            default:
                $res = $this->db->get_results($query, $outputType);
                break;
        }
        return $res;
	}
	public function query( $query, $data = array() ) {
		if(is_object($query)) {	// Chain query builder passed - let's build it before execution ;)
			$query = $query->build();
		}
		if(is_array($query)) {
			$sqlQuery = array_shift( $query );
			$queryParams = $query;
			$query = $this->db->prepare($sqlQuery, $queryParams);
		}
		$query = $this->preparePrefix( $query );

		if(!empty($data)) {
			$query = $this->db->prepare( $query, $data );
		}

		return $this->db->query( $query );
	}

    public function getError() {
        $message = 'WordPress Database Error:';
        if ($this->db->last_error !== '') {
            if (WP_DEBUG) {
                $message .= '[';
                $message .= $this->db->last_error;
                $message .= '] Query: ';
                return $message .= $this->db->last_query;
            }
            return $message .= ' Enable debug mode to details';
        }

        return false;
    }

	public function getCurrentDateInUTC() {
		$date = new DateTime(null, new DateTimeZone('UTC'));
		return $date->format($this->datetimeFormat);
	}
	
	public function pushError( $error, $key = '' ) {
		empty($key)
			? $this->_internalErrors[] = $error
			: $this->_internalErrors[ $key ] = $error;
	}
	public function getErrors() {
		return $this->_internalErrors;
	}
	public function encodeArrayTxt( $arr, $forceOrd = false ) {
		$arr = serialize($arr);
		if(function_exists('base64_encode') && !$forceOrd) {
			return base64_encode( $arr );
		}
		$len = strlen( $arr );
		$res = array();
		for($i = 0; $i < $len; $i++) {
			$res[] = ord( $arr[ $i ] );
		}
		return implode('|', $res). ':ORD_ENC';
	}
	public function decodeArrayTxt( $str ) {
		$resStr = '';
		if(strpos($str, ':ORD_ENC')) {
			$str = explode('|', str_replace(':ORD_ENC', '', $str));
			foreach($str as $ord) {
				$resStr .= chr( $ord );
			}
		} elseif(function_exists('base64_decode')) {
			$resStr = base64_decode( $str );
		}
		return unserialize($resStr);
	}
	/**
	 * For re-defining
	 */
	public function getSimpleFieldsList() {
		throw new RuntimeException(__FUNCTION__. ' method should be re-defined in child classes');
	}
	public function getListTotalCount( $selectParams ) {
		$this->_prepareForListSelect( $selectParams );
		$this->_listQuery->setFields( 'COUNT(*) AS total' );
		return (int) $this->db->get_var( $this->_listQuery->build() );
	}
	public function getList( $selectParams = array() ) {
		$this->_prepareForListSelect( $selectParams );
		
		$this->_listQuery->setFields( isset($selectParams['fields']) ? $selectParams['fields'] : '*' );
		if(isset($selectParams['limit'])) {
			$this->_listQuery->limit( $selectParams['limit'] );
			if(isset($selectParams['limit_offset'])) {
				$this->_listQuery->offset( $selectParams['limit_offset'] );
			}
		}
		if(isset($selectParams['order_by'])) {
			$this->_listQuery->orderBy( $selectParams['order_by'] );
			if(isset($selectParams['order'])) {
				$this->_listQuery->order( $selectParams['order'] );
			}
		}
		$data = $this->db->get_results( $this->_listQuery->build(), ARRAY_A );
		$this->_flushListSelect();
		if($data) {
			return $this->_handleAfterDb( $data );
		}
		return false;
	}
	protected function _prepareForListSelect( $selectParams ) {
		if(!$this->_listQuery) {
			$this->_listQuery = $this->getQueryBuilder();
			$this->_listQuery
				->select( (isset($selectParams['fields']) ? $selectParams['fields'] : '*') )
				->from( $this->_getListTable() );
			if(isset($selectParams['where'])) {
				$i = 0;
				foreach($selectParams['where'] as $w) {
					$method = $i ? 'andWhere' : 'where';
					if($method == 'andWhere' && isset($w[ 3 ]) && !empty($w[ 3 ])) {	// 4th parameter - where method
						$method = $w[ 3 ];
					}
					call_user_func_array(array($this->_listQuery, $method), $w);
					$i++;
				}
			}
			if(isset($selectParams['from_controller']) && $selectParams['from_controller']) {
				$this->beforeGetTblList();
			}
		}
	}
	/**
	 * For re-defining
	 */
	protected function _getListTable() {
		throw new RuntimeException(__FUNCTION__. ' method should be re-defined in child classes');
	}
	protected function _flushListSelect() {
		$this->_listQuery = null;
	}
	protected function _getListQuery() {
		return $this->_listQuery;
	}
	protected function _prepareAfterDb( $row ) {
		return $row;
	}
	protected function _handleAfterDb( $data ) {
		foreach($data as $i => $d) {
			$data[ $i ] = $this->_prepareAfterDb( $data[ $i ] );
		}
		return $data;
	}
	public function getBy($field, $value, $one = false) {
		$where = array();
		if(is_array($field)) {
			foreach($field as $f => $v) {
				$where[] = array($f, '=', $v);
			}
		} else {
			$where[] = array($field, '=', $value);
		}
		$this->_prepareForListSelect(array('where' => $where ));
		$data = $this->getList();
		$this->_flushListSelect();
		return $data && $one ? array_pop( $data ) : $data;
	}
	public function isExists( $field, $value ) {
		return (int) $this->getData("SELECT COUNT(*) AS total FROM {$this->_getListTable()} WHERE $field = '$value'", 'one');
	}
	public function getById( $id ) {
		$item = $this->getBy($this->_idField, $id, true);
		return $item;
	}
	public function removeById( $id ) {
		if(!is_array($id)) $id = array( $id );
		$id = array_map('intval', $id);
		$query = $this->getQueryBuilder();
		return $this->query(
			$query->deleteFrom( $this->_getListTable() )->where($this->_idField, 'IN', $id)
		);
	}
	public function removeBy( $field, $value, $eq = '=' ) {
		return $this->query(
			$this->getQueryBuilder()->deleteFrom( $this->_getListTable() )->where($field, $eq, $value)
		);
	}
	/**
	 * For re-defining
	 */
	public function save( $data ) {
		throw new RuntimeException(__FUNCTION__. ' method should be re-defined in child classes');
	}
	protected function isChecked( $data, $key ) {
		return isset($data[ $key ]) && $data[ $key ] !== 'false';
	}
	public function updateBy( $data, $where ) {
		$fields = $values = array();
		foreach($data as $k => $v) {
			$fields[] = $k;
			$values[] = $v;
		}
		$query = $this->getQueryBuilder()->update( $this->_getListTable() )->fields( $fields )->values( $values );
		foreach($where as $k => $v) {
			$query->where($k, '=', $v);
		}
		return $this->query( $query );
	}
	public function updateById( $data, $id ) {
		return $this->updateBy( $data, array($this->_idField => $id) );
	}
	/**
	 * Method alllow to add some additional modifications into selection before controller getTblList() call getListTotalCount() and getList()
	 */
	public function beforeGetTblList() {
		
	}
	/**
	 * Allow to determine - what fields will be included in table search. 
	 * Can be string - just field in db that can be used in LIKE query, or array - field name + operator for db query.
	 */
	public function getSearchLikeFields() {
		
	}
	protected function _setIdField( $field ) {
		$this->_idField = $field;
	}
	public function getDbDate() {
		return $this->getData("SELECT NOW()", 'one');
	}
	public function getDbTimestamp() {
		return strtotime( $this->getDbDate() );
	}

	public function translate($text) {
		return $this->environment->translate($text);
	}

}