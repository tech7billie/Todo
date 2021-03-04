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

    // ■ todo 클릭 시 내용 보여주는 뷰 호출 메소드 
    public function view()
    {
        // todo 번호에 해당하는 데이터를 가져오기 
        $id = $this->uri->segment(3);

        
        /*
            ·	segment(n) : url 에서 특정 새그먼트를 추출한다.
            /todo/index.php/main/view/<?php echo $lt -> id; ?>
                    ----- -----           ----------
                        1     2                 3
        */
        
        // todo_m 모델을 통해 특정 id 의 데이터 조회해서 변수 $data 에 담는다.
        $data['views'] = $this->todo_m->get_view($id);

        // view 호출하면서 $data 넘기기 
        $this->load->view('todo/view_v', $data);

    }

    // ■ todo 입력 메소드 
	public function write()
	{
        // POST 방식으로 전송된 값은 $_POST 로 받는다.
		if($_POST)
		{
			// 글쓰기 POST 전송 시
			$content = $this->input->post('content', TRUE);
			$created_on = $this->input->post('created_on', TRUE);
			$due_date = $this->input->post('due_date', TRUE);
			/*
				폼 데이터에 접근 
				$this->input->post('name', xss 필터링 여부)
				※ Xss Filter란 사용자들의 악의적인 스크립트 공격
                (ex, <script> alert("melong"); </script> )등을 막기 위해 사용하는 filter이다.
			*/		

			$this->todo_m->insert_todo($content, $created_on, $due_date);

			redirect('/main/lists/');	
			
			exit;
		}
		else
		{
			// 쓰기 폼 view 호출 
			$this->load->view('todo/write_v');
		}
	}

    // ■ todo 삭제
	public function delete()
	{
		// 해당 게시물 삭제하도록 게시물 번호 얻기 
		$id = $this->uri->segment(3);

		// db 에서 삭제 
		$this->todo_m->delete_todo($id);

		// todo 목록 보여주는 화면으로 리다이렉트 
		redirect('/main/lists');
		
	}

    // ■ todo 수정 
    public function update()
    {
          // 해당 게시물 내용 얻도록 게시물 번호 얻기
          $id = $this->uri->segment(3);

        // POST 방식으로 전송된 값은 $_POST 로 받는다.
		if($_POST)
		{
			// 글쓰기 POST 전송 시
			$content = $this->input->post('content', TRUE);
			$created_on = $this->input->post('created_on', TRUE);
			$due_date = $this->input->post('due_date', TRUE);	

            // db 에서 수정
			$this->todo_m->update_todo($id, $content, $created_on, $due_date);

            // 목록 보여주는 뷰로 리다이렉트
			redirect('/main/lists/');	
			
			exit;
		}
		else
		{
            // 게시물 번호에 해당하는 todo 데이터 얻기 
            $data['views'] = $this->todo_m->get_view($id);

            // view 호출하면서 $data 넘기기 
            $this->load->view('todo/update_v', $data);

		}
       

    }

   

}


/* End of file main.php */
/* Location: ./application/controllers/main.php */