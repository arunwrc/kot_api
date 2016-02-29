<?php
require APPPATH . '/libraries/REST_Controller.php';
class User_api extends REST_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('User_model');
        $this->crossorigin->initiate();
    }
    function Users_get(){
       $data=$this->User_model->get_all();
        if($data){
            $this->response(array(RESP_STATUS => HTTP_OK,RESP_MSG => LISTING_SUCCESS,DATA => $data));
        }else{
            $this->response(array(RESP_STATUS => HTTP_NO_CONTENT,RESP_MSG => NO_RECORDS));
        }
    }
    
    function Adduser_post(){
           
       $data = json_decode(file_get_contents('php://input'),true);  
        if(isset($data['username'])) {
            $username = $data['username'];
        }else{
            $username = "";
        }
        if(isset($data['password'])) {
            $password = $data['password'];
        }else{
            $password = "";
        }
        if(isset($data['name'])) {
            $name = $data['name'];
        }else{
            $name = "";
        }
		if(isset($data['usertype_id'])) {
            $usertype_id = $data['usertype_id'];
        }else{
            $usertype_id = "";
        }
        $restaurant_id = "";
        $current_datetime = date('Y-m-d H:i:s');
		if ($username != "") {
            $data = array( // inputs
                'username'=> $username,
                'password'=> $password,
                'name'=> $name,
                'usertype_id'=> $usertype_id,
                'restaurant_id'=> $restaurant_id,
                'created_at' =>  $current_datetime
            );
            $this->db->insert('users', $data);
            $insert_id = array( 
                'insertID'=> $this->db->insert_id()
            );
            $merged_data = array_merge($data,$insert_id);
            $this->response(array(RESP_STATUS => HTTP_OK,RESP_MSG => CREATED_SUCCESS,DATA => $merged_data));
		}
		else {
			$this->response(array(RESP_STATUS => HTTP_NO_CONTENT,RESP_MSG => CREATE_FAILED));
		}	
    }
	function Deleteuser_delete(){
			
	        $id = $this->uri->segment(4);
	        $user_details=$this->User_model->get_by_id($id);
	        $this->User_model->delete_data($id);
	        if ($user_details){
	            $this->response(array(RESP_STATUS => HTTP_OK,RESP_MSG => DELETED_SUCCESS,DATA => $user_details));
	        }else{
	            $this->response(array(RESP_STATUS => HTTP_NO_CONTENT,RESP_MSG => DELETE_FAILED));
	        }
	    }


}