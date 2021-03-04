<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 


/*
1. get_list()    : todo 목록 반환 
2. get_view()    : 하나의 todo 반환 
3. insert_todo($content, $created_on, $due_date) : todo 입력 
4. delete_todo($id) : todo 삭제 
5. update_todo($id,$content, $created_on, $due_date) : todo 수정 

*/


class Todo_m extends CI_Model 
{
    function __construct() 
    {
        parent::__construct();
    }
    
    // todo 목록 반환
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

    // 하나의 todo 반환
    function get_view($id)
    {
        // 1. 기존 
        // $sql = "SELECT * FROM items WHERE id = '" . $id . "'"; // php 문자열 연결 연산자 : . 
        // $query = $this->db->query($sql);
        
        // 2. 쿼리 바인딩
        $sql = "SELECT * FROM items WHERE id = ? ";
        $query = $this->db->query($sql, array($id));

        $result = $query->row(); // 객체 형태로 반환 
        
        return $result;
    }

    // todo 입력 
    function insert_todo($content, $created_on, $due_date)
    {
        // 1.기존  
        // $sql = "INSERT INTO items(content, created_on, due_date) VALUES('".$content."','".$created_on."','".$due_date."')";
        // $query = $this->db->query($sql);

        // 2. insert_string() 사용 
        $data = array('content'=> $content, 'created_on'=> $created_on, 'due_date'=> $due_date);
        $sql = $this->db->insert_string('items', $data);    // 쿼리문 생성 
        $query = $this->db->query($sql);                    // 쿼리 실행 

    }

     // todo 삭제 
     function delete_todo($id)
     {
         $sql = "DELETE FROM items WHERE id = '".$id."'";
         $this->db->query($sql);
     }

     // todo 수정 
     function update_todo($id,$content, $created_on, $due_date)
     {
        // 1. 기존 
        // $sql = "UPDATE items SET content ='".$content."', created_on ='".$created_on."', due_date ='".$due_date."' WHERE id ='".$id."'";
        // $this->db->query($sql); 

        // 2. update_string() 사용 
        $data = array('content'=>$content, 'created_on'=>$created_on, 'due_date'=>$due_date);   // 업데이트될 데이터 
        $where = "id=".$id; 
        $sql = $this->db->update_string('items',$data,$where);  // 쿼리문 생성 
        
        $query = $this->db->query($sql);                        // 쿼리 실행 


     }
	
}

/* End of file todo_m.php */
/* Location: ./application/Models/todo_m.php  */