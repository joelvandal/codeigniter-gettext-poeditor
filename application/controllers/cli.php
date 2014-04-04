<?php if (!defined('BASEPATH')) die();

class CLI extends CI_Controller {

    function __construct() {
	parent::__construct();
	
	// this controller can only be called from the command line
	if (!$this->input->is_cli_request()) show_error('Direct access is not allowed!');
    }


    public function translate() {

	$this->load->library('languages');

	print "Initialize Locale\n";
	$this->languages->POEditor_Init();
	
	print "Extract strings from PHP code\n";
	$this->languages->POEditor_Extract();
	
	print "Upload strings to POEditor\n";
	$this->languages->POEditor_Upload();
	
	print "Download translations from POEditor\n";
	$this->languages->POEditor_Download();
	
	print "Build translations\n";
	$this->languages->POEditor_Build();
	print "Done ...\n";
	
    }
    
}
