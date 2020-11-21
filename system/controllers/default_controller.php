<?php
class default_controller extends Controller{
  function __construct(){
		include "system/models/default_model.php";
		$this->model = new default_model();
		$this->view = new View();
	}
	
	function index(){
		$data = $this->model->get_data();
		$this->view->render('', 'default_view.php', $data);
	}

        function get_comments(){
            $data = $this->model->get_comments();
            $this->view->render('', 'ajax_view_json.php', $data); 
        }
        function save_comments(){
            $data = $this->model->save_comments();
            $this->view->render('', 'ajax_view_json.php', $data); 
        }
           
}
?>