<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Main extends CI_Controller 
{
	// 생성자에서 로드 (DB, Model, Helper) 
    function __construct() 
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('todo_m');
        $this->load->helper(array('url', 'date'));
    }
    
	 // 기본 url 로 접속하면 todo 목록 보여주는 메소드 호출 
    public function index() 
    {
        $this->lists(); // $this : 현재 객체를 의미 
    }

	
    // ■ todo 목록 보여주는 뷰 호출 메소드 
    public function lists() 
    {
        // to do 목록을 가져와서 $data 배열에 'list' 키의 값으로 담는다.
        // $배열이름["키"] = 값;
        $data['list'] = $this->todo_m->get_list();
        
        // 뷰를 로드하면서 $data 값을 전달한다.
        $this->load->view('todo/list_v', $data);
    }

}


/* End of file main.php */
/* Location: ./application/controllers/main.php */