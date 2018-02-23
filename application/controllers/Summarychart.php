
	
    
    <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Summarychart extends CI_Controller {
 
    function __Construct() {
        parent::__Construct();
 $this->load->library('form_validation');
		$this->load->database();
		$this->load->helper('form');
		$this->load->helper('url');
        $this->load->helper(array('form', 'url'));
        $this->load->model('Sale_model');
       $this->load->library('session');
    }
    /**
     * @desc: This method is used to load view
     */
    public function index()
    {
		
		
	$this->form_validation->set_rules('bigdate', 'FROM DATE', 'required|max_length[50]');
			$this->form_validation->set_rules('enddate', 'END DATE', 'required|max_length[50]');
		$this->form_validation->set_error_delimiters('<br /><span class="error">', '</span>');
	
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			$data=array("title" => "Custom summary", "mess" => "<p class='alert alert-danger'> Kindly fix the following errors and submit again</p>");
			//$data["title"]='Add item';
		 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/summarychart");	
		  $this->load->view("template/footer");	
		}
		else // passed validation proceed to post success logic
		{
	
	$start=$this->input->post("bigdate");
	$stop=$this->input->post("enddate");
	$_SESSION['startd']=$this->input->post("bigdate");
	$_SESSION['endd']=$this->input->post("enddate");
		
		
		
		$page="Sales chart";
	$data = array('title' => $page,"mess" => "");
	 
	 $this->load->view("template/header",$data);
		  $this->load->view("template/nav");
		 $this->load->view("pages/summarychart");	
		  $this->load->view("template/footer");	
 
       // $this->load->view('piechart');
    }
	}
	
	
}

?>
	
		
	
	