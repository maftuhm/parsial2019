<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Example extends CI_Controller {

	public function index()
    {
    	$this->load->helper('url');
	    //Load the library
	    $this->load->library('html2pdf');
	    
	    //Set folder to save PDF to
	    $this->html2pdf->folder('./assets/pdfs/');
	    
	    //Set the filename to save/download as
	    $filename = time().'_Kartu Tanda Peserta.pdf';
	    $this->html2pdf->filename($filename);
	    
	    //Set the paper defaults
	    $this->html2pdf->paper('a4', 'portrait');
	    
	    $data = array(
	    	'title' => 'PDF Created',
	    	'message' => 'Hello World!'
	    );
	    
	    //Load html view
	    $this->html2pdf->html($this->load->view('pdf', $data, true));
	    
	    if($this->html2pdf->create('save')) {
	    	//PDF was successfully saved or downloaded
	    	redirect(base_url(), 'refresh');
	    }
	    
    } 
    
	public function mail_pdf()
    {
		//Load the library
	    $this->load->library('html2pdf');
	    
	    $this->html2pdf->folder('./assets/pdfs/');
	    $this->html2pdf->filename('email_test.pdf');
	    $this->html2pdf->paper('A4', 'portrait');
	    
	    $data = array(
	    	'title' => 'PDF Created',
	    	'message' => 'Hello World!'
	    );
	    //Load html view
	    $this->html2pdf->html($this->load->view('pdf', $data, true));
	    
	    //Check that the PDF was created before we send it
	    if($path = $this->html2pdf->create('view')) {
	    	
			$this->load->library('email');

			$this->email->from('your@example.com', 'Your Name');
			$this->email->to('someone@example.com'); 
			
			$this->email->subject('Email PDF Test');
			$this->email->message('Testing the email a freshly created PDF');	

			$this->email->attach($path);

			$this->email->send();
			
			echo $this->email->print_debugger();
						
	    }
	    
    } 
}

/* End of file example.php */
/* Location: ./application/controllers/example.php */