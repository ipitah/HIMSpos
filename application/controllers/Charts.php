
	
    
    <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Charts extends CI_Controller {
 
    function __Construct() {
        parent::__Construct();
 
        $this->load->helper(array('form', 'url'));
        $this->load->model('Sale_model');
       
    }
    /**
     * @desc: This method is used to load view
     */
    public function index()
    {
		$page="Sales chart";
	$data = array('title' => $page,"mess" => "");
	 
	 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/daychart");	
		  $this->load->view("template/footer");	
 
       // $this->load->view('piechart');
    }
    /**
     * @desc: This method is used to get data to call model and print it into Json
     * This method called by Ajax
     */
    function getdata(){
        $data  = $this->Sale_model->getdata();
        print_r(json_encode($data, true));
    }
	
	
	 function getstockdata(){
        $data  = $this->Sale_model->getstockdata();
        print_r(json_encode($data, true));
    }
	
	
	
	 function getcustomsaledata(){
        $data  = $this->Sale_model->getcustomsaledata();
        print_r(json_encode($data, true));
    }
	
	
	 function getcustomstockdata(){
        $data  = $this->Sale_model->getcustomstockdata();
        print_r(json_encode($data, true));
    }
	
	
	
	
	
}

?>
	
		
	
	