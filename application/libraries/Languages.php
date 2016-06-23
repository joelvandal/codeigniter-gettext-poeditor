<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Languages {
    /**
     * Initialize gettext inside Codeigniter PHP framework.
     *
     * @param array $config Override default configuration
     */
    private $CI;
    private $config;
    public $lang;
    
    public function __construct() {

        $this->CI = &get_instance();
	
	$this->CI->load->config('languages');
	
        $this->config = array(
		'default_language'        => $this->CI->config->item('default'),
                'supported_languages'     => $this->CI->config->item('languages'),
                'gettext_locale_dir'      => $this->CI->config->item('directory'),
                'gettext_text_domain'     => $this->CI->config->item('domain'),
                'gettext_catalog_codeset' => $this->CI->config->item('charset'),
                'gettext_locale'          => $this->CI->config->item('locale')
        );
	
	$pocfg = $this->CI->config->item('poeditor');
	$this->config['poeditor'] = $pocfg;

	$this->lang = $this->detect();
	
	setlocale(LC_ALL, $this->lang);
	setlocale(LC_TIME, $this->lang);
	putenv("LC_ALL=" . $this->lang);
	
	$domain = $this->config['gettext_text_domain'];
	
	// Check if the locale folder is writable, if yes, then enable Gettext workaround
	@list($lang, $lang2) = explode('_', $this->lang);
	if (is_writable(APPPATH.$this->config['gettext_locale_dir'] . DIRECTORY_SEPARATOR . $lang . DIRECTORY_SEPARATOR . 'LC_MESSAGES' . DIRECTORY_SEPARATOR . 'test.txt')) {
	    $filename = APPPATH.$this->config['gettext_locale_dir'] . DIRECTORY_SEPARATOR . $lang . DIRECTORY_SEPARATOR . 'LC_MESSAGES' . DIRECTORY_SEPARATOR . $domain . '.mo';
	    $mtime = filemtime($filename);
	    $filename_new = APPPATH.$this->config['gettext_locale_dir'] . DIRECTORY_SEPARATOR . $lang . DIRECTORY_SEPARATOR . 'LC_MESSAGES' . DIRECTORY_SEPARATOR . $domain . '_' . $mtime . '.mo';
	    if (!file_exists($filename_new)) {
		$dir = scandir(dirname($filename));
		foreach ($dir as $file) {
		    if (in_array($file, array('.', '..', "{$domain}.po", "{$domain}.mo"))) continue;
		    unlink(dirname($filename).DIRECTORY_SEPARATOR.$file);
		}
		copy($filename, $filename_new);
	    }
	    $domain = "{$domain}_{$mtime}";
	}
	
        // Gettext catalog codeset
        bind_textdomain_codeset($domain, $this->config['gettext_catalog_codeset']);
	
        // Path to gettext locales directory relative to APPPATH
        bindtextdomain($domain, APPPATH.$this->config['gettext_locale_dir']);
	
        // Gettext domain
        textdomain($domain);
	
	$this->setlang($this->lang);
    }

    function setlang($lang) {
        // Gettext locale
        setlocale(LC_ALL, $lang);
    }
    
    function getlang() {
        // Gettext locale
	return $this->lang;
    }

    function isRTL() {
	$rtl = $this->CI->config->item('rtl');
	return isset($rtl[CURRENT_LANGUAGE]) && $rtl[CURRENT_LANGUAGE];
    }
    
    function detect() {
	
	if ($this->CI->input->is_cli_request()) {
	    return 'en_US';
	}
	
	$userdata = $this->CI->session->userdata('language');
        // Lang set in URL via ?lang=something
	if(!empty($_GET['lang']))
	{
	    $lang = $_GET['lang'];
	    $this->CI->session->set_userdata('language', $lang);
	}
	
        // Lang has already been set and is stored in a session
	elseif( !empty($userdata))
	{
	    $lang = $this->CI->session->userdata('language');
	}
	
        // Lang has is picked by a user.
	// Set it to a session variable so we are only checking one place most of the time
	elseif( !empty($_COOKIE['lang_code']) )
	{
	    $lang = $_SESSION['lang_code'] = $_COOKIE['lang_code'];
	}
	
        // Still no Lang. Lets try some browser detection then
	else if (!empty( $_SERVER['HTTP_ACCEPT_LANGUAGE'] ))
	{
	    // explode languages into array
	    $accept_langs = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
	    
	    // Check them all, until we find a match
	    foreach ($accept_langs as $lang)
	    {
		// Check its in the array. If so, break the loop, we have one!
		if(in_array($lang, array_keys($this->config['supported_languages'])))
		{
		    break;
		}
	    }
	}
	
        // If no language has been worked out - or it is not supported - use the default
	if(empty($lang) or !in_array($lang, array_keys($this->config['supported_languages'])))
	{
	    $lang = $this->config['default_language'];
	}
	
        // Whatever we decided the lang was, save it for next time to avoid working it out again
	$this->CI->session->set_userdata('language', $lang);
	
        // Sets a constant to use throughout ALL of CI.
	if (!defined('CURRENT_LANGUAGE')) define('CURRENT_LANGUAGE', $lang);
	
	return $lang;
    }
    
    function POEditor_Init() {
	
	$path = APPPATH.$this->config['gettext_locale_dir'];
	if (!is_writable($path)) {
	    // error
	}
	
	$aliases = $this->CI->config->item('aliases');
	$pocfg   = $this->CI->config->item('poeditor');
	
	foreach($aliases as $alias => $lang) {
	    if (!@file_exists("$path/$alias")) {
		exec("mkdir -p $path/$alias/LC_MESSAGES");
		$this->POEditor_Action('add_language', array('id' => $this->config['poeditor']['projectID'], 'language' => $alias));
	    }
	}
    }

    function POEditor_Extract() {
	$path   = FCPATH;
	$pofile = APPPATH.$this->config['gettext_locale_dir'] . DIRECTORY_SEPARATOR . $this->CI->config->item('domain') . '.pot';
	$cmd = "cd /tmp ; echo '' > messages.po ; find $path -type f -iname \"*.php\" | xgettext --keyword=_ --keyword=_e -j -f - ; mv messages.po $pofile";
	exec($cmd);
    }
    
    function POEditor_Build() {
	$path    = APPPATH.$this->config['gettext_locale_dir'];
	$aliases = $this->CI->config->item('aliases');
	
	foreach($aliases as $alias => $lang) {
	    $pfile  = APPPATH.$this->config['gettext_locale_dir'] . DIRECTORY_SEPARATOR . $alias . DIRECTORY_SEPARATOR . 'LC_MESSAGES' . DIRECTORY_SEPARATOR . $this->CI->config->item('domain');
	    $cmd = "msgfmt -v $pfile.po -o $pfile.mo";
	    exec($cmd);
	}
    }
    
    function POEditor_Download() {
	$pocfg   = $this->CI->config->item('poeditor');
	$project = $pocfg['projectID'];
	$aliases = $this->CI->config->item('aliases');
	
	$res = $this->POEditor_Action('list_languages', array('id' => $project));
	$res = json_decode($res);
	$process = array();
	foreach($res->list as $k => $v) {
	    
	    if (!isset($aliases[$v->code])) {
		continue;
	    }
	    $res2 = $this->POEditor_Action('export', array('id'         => $project,
							  'language'   => $v->code,
							  'type'       => 'po'));
	    
	    $res2 = json_decode($res2);
	    if ($res2->response->code == 200) {
		$infile = $res2->item;
		$outfile  = APPPATH.$this->config['gettext_locale_dir'] . DIRECTORY_SEPARATOR . $v->code . DIRECTORY_SEPARATOR . 'LC_MESSAGES' . DIRECTORY_SEPARATOR . $this->CI->config->item('domain') . '.po';
		
		print "$infile -> $outfile\n"; flush();
		$cnt = file_get_contents($infile);
		file_put_contents($outfile, $cnt);
	    } else {
		// print "*********** ERROR\n";
	    }
	}
    }
    
    function POEditor_Upload() {
	
	$pocfg   = $this->CI->config->item('poeditor');
	$pofile  = APPPATH.$this->config['gettext_locale_dir'] . DIRECTORY_SEPARATOR . $this->CI->config->item('domain') . '.pot';
	$project = $pocfg['projectID'];
	if (!file_exists($pofile)) {
	    print "File doesn't exist!";
	    return false;
	}
    
    $file = class_exists('CurlFile', false) ? new CURLFile($pofile, 'application/octet-stream') : "@{$pofile}"; // PHP 5.5 dropped support for the ‘@’ in CURL params 
	$params  = array('id'         => $project,
			 'file'       =>  $file,
			 'updating'   => 'terms',
			 'sync_terms' => 1);
	
	return $this->POEditor_Action('upload', $params);
    }
    
    function POEditor_Action($action, $extras = array()) {

	$pocfg = $this->CI->config->item('poeditor');
	
	$apikey = $pocfg['apikey'];
	$apiurl = $pocfg['apiurl'];
	
	$fields = array('api_token' => $apikey,
			'action'    => $action);
	
	foreach($extras as $key=>$value) { $fields[$key] = $value; }
	
	// open connection
	$ch = curl_init();
	
	// set the url, number of POST vars, POST data
	curl_setopt($ch,CURLOPT_URL, $apiurl);
	curl_setopt($ch,CURLOPT_POST, true);
	curl_setopt($ch,CURLOPT_POSTFIELDS, $fields);
	
	// execute post
	ob_start();
	curl_exec($ch);
	curl_close($ch);
	$result = ob_get_contents();
	ob_end_clean();
	return $result;
    }
    
}
