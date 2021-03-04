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

    // ■ 하나의 todo 반환하는 메소드 
    function get_view($id)
    {
        $sql = "SELECT * FROM items WHERE id = '" . $id . "'"; // php 문자열 연결 연산자 : . 

        $query = $this->db->query($sql);
        $result = $query->row(); // 객체 형태로 반환 
        
        return $result;
    }

    // ■ todo 입력 
    function insert_todo($content, $created_on, $due_date)
    {
        $sql = "INSERT INTO items(content, created_on, due_date) VALUES('".$content."','".$created_on."','".$due_date."')";

        $query = $this->db->query($sql);
    }

     // ■ todo 삭제 
     function delete_todo($id)
     {
         $sql = "DELETE FROM items WHERE id = '".$id."'";
         $this->db->query($sql);
     }

     // ■ todo 수정 
     function update_todo($id,$content, $created_on, $due_date)
     {
         $sql = "UPDATE items SET content ='".$content."', created_on ='".$created_on."', due_date ='".$due_date."' WHERE id ='".$id."'";
         
         echo $sql;
         // UPDATE items SET content='', CREATED_ON='', DUE_DATE=''
         // WHERE ID = ''; 

        $this->db->query($sql);

     }
	
}

/* End of file todo_m.php */
/* Location: ./application/Models/todo_m.php  */