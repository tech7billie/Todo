<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Todo_m extends CI_Model 
{
    function __construct() 
    {
        parent::__construct();
    }
    
    // ■ todo 목록 반환하는 메소드 
    function get_list() 
	{
        // 쿼리문을 변수 $sql 에 담는다.
        $sql = "SELECT * FROM items";
        
        // 쿼리문 실행 결과를 변수 $query 에 담는다.
        $query = $this->db->query($sql);
        
        // 쿼리문 실행 결과값을 객체 배열 형태로 반환받아 변수 $result 에 담는다.
        $result = $query->result();
        
        return $result;
    }

	
}

/* End of file todo_m.php */
/* Location: ./application/Models/todo_m.php  */