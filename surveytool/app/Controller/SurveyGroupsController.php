<?php
App::uses('SetDisplayCountController', 'Controller');
App::uses('Xml', 'Lib');
//require_once(ROOT . "fop-1.0/quexml-1.3.10/tcpdf/tcpdf.php");
require_once(Configure::read('App.directory') . "/fop-1.0/quexml-1.3.10/quexmlpdf.php");
ini_set("include_path", Configure::read('Adodb.includedir') . ":.:" . ini_get("include_path"));
require_once('adodb.inc.php');



function csv($fields = array(), $delimiter = ',', $enclosure = '"')

{
	$str = '';
	$escape_char = '\\';
	foreach ($fields as $value)
	{
		if (strpos($value, $delimiter) !== false ||
				strpos($value, $enclosure) !== false ||
				strpos($value, "\n") !== false ||
				strpos($value, "\r") !== false ||
				strpos($value, "\t") !== false ||
				strpos($value, ' ') !== false)

		{
			$str2 = $enclosure;
			$escaped = 0;
			$len = strlen($value);
			for ($i=0;$i<$len;$i++)
			{
				if ($value[$i] == $escape_char)
					$escaped = 1;
				else if (!$escaped && $value[$i] == $enclosure)
					$str2 .= $enclosure;
				else
					$escaped = 0;
				$str2 .= $value[$i];
			}
			$str2 .= $enclosure;
			$str .= $str2.$delimiter;
		}
		else
			$str .= $value.$delimiter;
	}
	$str = substr($str,0,-1);
	$str .= "\n";
	return $str;
}

function outputdatacsv($qid,$fid = "",$labels = false,$unverified = false, $return = false,$mergenamedfields = false)

{
	//global database variable
	/*define('DB_USER', 'cnedd');
	define('DB_PASS', 'mtjlnfehdl');
	define('DB_HOST', 'localhost');
	define('DB_NAME', 'slp_cnedd_quexf');
	*/

	$db = newADOConnection("mysqlt");
	$db->Connect(Configure::read('QueXF.host'), Configure::read('QueXF.user'), Configure::read('QueXF.pass'), Configure::read('QueXF.name'));
	$db->SetFetchMode(ADODB_FETCH_ASSOC);

	//Changed jah5fv - redirecting stdout to a file
	//fclose(STDOUT);

	$file = fopen("$qid.csv", 'wb');
	//echo $file;
	//first get data desc

	$sql = "SELECT b.bgid, bg.btid, count( b.bid ) as count,bg.width
	FROM boxes as b
	JOIN boxgroupstype as bg ON (b.bgid = bg.bgid)
	JOIN pages as p ON (p.pid = b.pid)
	WHERE p.qid = '$qid'
	AND bg.btid > 0
	GROUP BY b.bgid
	ORDER BY bg.sortorder";

	$desc = $db->GetAssoc($sql);

	//get completed forms for this qid

	if ($unverified)
		$sql = "SELECT 0 AS vid, f.fid as fid, f.qid as qid, f.description as description, f.rpc_id
		FROM forms as f
		WHERE f.qid = '$qid'";
	else
		$sql = "SELECT w.vid AS vid, w.fid AS fid, w.assigned AS assigned, w.completed AS completed, f.qid AS qid, f.description AS description, f.rpc_id
		FROM `worklog` AS w
		LEFT JOIN forms AS f ON w.fid = f.fid
		WHERE f.qid = '$qid'";

	if ($fid != "")
		$sql .= " AND f.fid = '$fid'";

	$forms = $db->GetAll($sql);

	$unv = "";
	if ($unverified) $unv = "unverified" . "_"; //T_("unverified") . "_";

	if (!$return)
	{
		//header ("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		//header ("Content-Type: text/ascii");
		//header ("Content-Disposition: attachment; filename={$unv}data_$qid.csv");

	}

	$sql = "SELECT bg.varname, bg.btid, count(b.bid) as count
	FROM boxes as b
	JOIN boxgroupstype as bg ON (bg.bgid = b.bgid)
	JOIN pages as p ON (p.pid = b.pid)
	WHERE p.qid = '$qid'
	AND bg.btid > 0
	GROUP BY b.bgid
	ORDER BY bg.sortorder";
	$varnames = $db->GetAll($sql);

	$rv = array();



	$prevarname = "@";



	foreach($varnames as $vn)

	{

	if ($vn['btid'] == 2)

		{

		for ($i = 1; $i <= $vn['count']; $i++)

		$rv[] = $vn['varname'] . "_$i";

		}

		else

		{

			//don't add the variable name if we are merging and it matches the last varname

			if (!($mergenamedfields == true && $prevarname == $vn['varname']))

			$rv[] = $vn['varname'];



			$prevarname = $vn['varname'];

		}





		}



		$rv[] = "formid";

				$rv[] = "rpc_id";



				//print the header row

						if (!$return)

						{

						fwrite($file, csv($rv));

}



$prevarname = "@";



	foreach ($forms as $form)

	{

	$sql = "SELECT bg.btid,f.val

	FROM boxes AS b

	JOIN boxgroupstype as bg ON (bg.bgid = b.bgid)

			JOIN pages as p ON (p.pid = b.pid)

			LEFT JOIN formboxverifychar AS f ON (f.vid = '{$form['vid']}' AND f.fid = '{$form['fid']}' AND f.bid = b.bid)

			WHERE p.qid = '$qid'

	AND bg.btid > 0

	ORDER BY bg.sortorder, b.bid";





	$sql = "(select b.bid,b.bgid,g.btid,f.val,sortorder,b.value,b.label,g.varname

	from boxes as b, boxgroupstype as g, pages as p, formboxverifychar as f

	where b.bgid = g.bgid

	and g.btid > 0

	and g.btid < 5

	and p.pid = b.pid

	and p.qid = '$qid'

	and f.bid = b.bid and f.vid = '{$form['vid']}' and f.fid = '{$form['fid']}')

	UNION

	(select b.bid,b.bgid,g.btid,f.val,sortorder,b.value,b.label,g.varname

	from boxes as b

			JOIN  boxgroupstype as g on (b.bgid = g.bgid and g.btid = 6)

			JOIN pages as p on  (p.pid = b.pid and p.qid = '$qid')

			LEFT JOIN formboxverifytext as f on (f.bid = b.bid and f.vid = '{$form['vid']}' and f.fid = '{$form['fid']}'))

			UNION

			(select b.bid,b.bgid,g.btid,f.val,sortorder,b.value,b.label,g.varname

			from boxes as b

			JOIN  boxgroupstype as g on (b.bgid = g.bgid and g.btid = 5)

			JOIN pages as p on  (p.pid = b.pid and p.qid = '$qid')

			LEFT JOIN formboxverifytext as f on (f.bid = b.bid and f.vid = 0 and f.fid = '{$form['fid']}'))

			order by sortorder asc,bid asc";



			$data =  $db->GetAll($sql);



			$bgid = $data[0]['bgid'];

			$btid = "";

			$count = 1;

			$done = "";



			$rr = array();



			$tmpstr = "";

			$labelval = "";

			$valueval = "";



			$data[] = array('btid' => 0,  'bgid' => 0, 'val' => "", 'varname' => "");



			$prebtid = 0;



			$varlist = array();

			$varlistc = 0;

			//print_r($data);



			foreach($data as $val)

			{

			$btid = $val['btid'];



			if ($bgid != $val['bgid']) //we have changed box groups

			{

			$varlist[] = $val['varname'];

			$varlistc++;



			if ($prebtid ==	1 || $prebtid == 3 || $prebtid == 4)

				{

				//multiple boxes -> down to one variable

						if ($prebtid == 1)

						{

				if ($done == 1)

					if ($labels)

					$rr[] = $labelval;

					else

					{

					if (strlen(trim($valueval)) == 0)

						$rr[] = $count; //if single choice, val is the number of the box selected

						else

							$rr[] = $valueval;

					}

					else

						$rr[] = ""; //blank if no val entered

					}

					else

					{



					if ($mergenamedfields == true)

			{

			if ($varlistc > 1 && $varlist[$varlistc - 2] == $varlist[$varlistc - 1])

					{}

					else

					{

					$rr[] = trim($tmpstr);

					$tmpstr = "";

				}

				}

				else

					{

					$rr[] = trim($tmpstr);

					$tmpstr = "";

					}



					}



					$labelval = "";

					$valueval = "";

					}



					if ($val['btid'] == 6 || $val['btid'] == 5)

					{

					//one box per variable - just export

						$rr[] = $val['val'];

					}



					$bgid = $val['bgid']; //reset counters

					$count = 1;

					$done = 0;

			}

				else if ($val['btid'] == 6 || $val['btid'] == 5)

					{

						//one box per variable - just export

						$rr[] = $val['val'];

			}





			if ($val['btid'] == 1)

			{

			if ($val['val'] == 1)

			{

			$done = 1;

			$labelval = $val['label'];

			$valueval = $val['value'];

			}

				if ($done != 1)

					$count++;

			}

			else if ($val['btid'] == 3 || $val['btid'] == 4)

			{

			if ($val['val'] == "")

				$tmpstr .= " ";

				else

					$tmpstr .= $val['val'];

			}

			else if ($val['btid'] == 2)

			{

			if ($val['val'] == 1)

			{

			if ($labels)

				$rr[] = $val['label'];

				else

				{

					if ($val['value'] == "")

						$rr[] = 1;

						else

							$rr[] = $val['value'];

					}

					}

					else

						$rr[] = "";

				}



				$prebtid = $val['btid'];

					}



						$rr[] = $form['fid']; //print str_pad($form['fid'], 10, " ", STR_PAD_LEFT);

		$rr[] = $form['rpc_id'];



		//print_r($rr);

		if (!$return)

		{



		fwrite($file, csv($rr));

		//jah5fv

		fclose($file);

				}

				}

				if ($return)

		{

		return array($rv,$rr);

}

}



/**
 * SurveyGroups Controller
 *
 * @property SurveyGroup $SurveyGroup
 */
class SurveyGroupsController extends SetDisplayCountController {

var $components = array('RequestHandler'); 

public $paginate = array(
        'order' => array( //later surveygroups shown first
            'SurveyGroup.date' => 'desc'
        )
    );

//paths to fop and local template files
protected static $FOP_PARTIALPATH = "/fop-1.0/fop";
protected static $SURVEY_XSLT_PARTIALPATH = "/to_form.xslt";
protected static $XML_TEMPLATE_PARTIALPATH = "/app/SurveyXML/xmltemplate.xml";

/**
 * index method
 *
 * @return void
 */
	public function index() {
	    parent::index();
		$this->SurveyGroup->recursive = 0;
		$this->set('surveyGroups', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->SurveyGroup->id = $id;
		if (!$this->SurveyGroup->exists()) {
			throw new NotFoundException(__('Invalid survey group'));
		}
		$this->set('surveyGroup', $this->SurveyGroup->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->SurveyGroup->create();
			if ($this->SurveyGroup->save($this->request->data)) {
				$this->Session->setFlash(__('The training has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The training could not be saved. Please, try again.'));
			}
		}
	}
	
    public function pdfgen($id=null){
	    //echo "<br><br><br><br><br><br>"; //let's errors show up below the navbar
		$this->SurveyGroup->id = $id;
		$surveyGroup = $this->SurveyGroup->read();
		$this->set('surveyGroup', $surveyGroup); 			
 		$surveyFilename = ROOT . "/app/SurveyXML/quexmlsurvey_$id.xml";			
			
		$xmlTemplateFullPath = ROOT . self::$XML_TEMPLATE_PARTIALPATH;
		$fopFullPath = ROOT . self::$FOP_PARTIALPATH;
		$surveyXSLTFullPath = ROOT . self::$SURVEY_XSLT_PARTIALPATH;
		//Read from the template queXML file and insert the custom data
		if (file_exists($xmlTemplateFullPath)){
		    $xmlTemplate = file_get_contents($xmlTemplateFullPath);
		    $surveyXMLcontents = vsprintf($xmlTemplate, 
			array(h($surveyGroup['SurveyGroup']['survey_group_id']),
			h($surveyGroup['SurveyGroup']['name']),
			h($surveyGroup['SurveyGroup']['type']),
			h($surveyGroup['SurveyGroup']['location']),
			h($surveyGroup['SurveyGroup']['instructor']),
			h($surveyGroup['SurveyGroup']['date']),
			h($surveyGroup['SurveyGroup']['free1']),
			h($surveyGroup['SurveyGroup']['free2']),
			h($surveyGroup['SurveyGroup']['free3'])
			)
			);		
		} else { //If no template file, make alert
		    $this->Session->setFlash(
					__("$xmlTemplateFullPath was missing, could generate survey PDF."),
					'alert',
					array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-error'
					),
					'flash'
				);
			$this->redirect(array('action' => 'view', $id));
			return;
		}		
		//Save customized surveygroups-specific template file
		file_put_contents($surveyFilename, $surveyXMLcontents);
		
		//Create new queXMLPDF document
        $quexmlpdf = new queXMLPDF(PDF_PAGE_ORIENTATION, 'mm', "LETTER", true, 'UTF-8', false);

        //Time out after 2 minutes if for whatever reason it takes that long
        set_time_limit(120);

        //Generate PDF using QueXMLPDF class
        $quexmlpdf->create($quexmlpdf->createqueXML($surveyXMLcontents));
        $qid = intval($quexmlpdf->getQuestionnaireId());

        //Prepare to zip up resulting QueXF files
        $zip = new ZipArchive();
        $zipFilename = ROOT . "/app/SurveyXML/quexfzip_$id.zip";

        if ($zip->open($zipFilename, ZIPARCHIVE::CREATE)!==TRUE) {
            exit("cannot open temporary file\n");
        }        
        
        $bandingFilename = "quexf_banding_$qid.xml";
        $pdfFilename = "quexmlpdf_$qid.pdf";

        $zip->addFromString($bandingFilename, $quexmlpdf->getLayout());
        $zip->addFromString($pdfFilename, $quexmlpdf->Output("quexml_$qid.pdf", 'S'));
        $zip->close();
        
        //QueXF folder to extract both files to
        $quexfDestination = ROOT . "/quexf/surveytemplates";
        //Local folder to extract just the PDF to
        $pdfDestination = ROOT . "/app/SurveyPDF";
        $zip = new ZipArchive();
        $zip->open($zipFilename);
        $zip->extractTo($quexfDestination);
        $zip->extractTo($pdfDestination, $pdfFilename);
        
        //Load the file into QueXF
        $post = array(
        		"MAX_FILE_SIZE"=>"1000000000",
        		"form"=>"@$pdfDestination/$pdfFilename",
        		"bandingxml"=>"@$quexfDestination/$bandingFilename",
        		"desc"=>"$qid",
        );
        
        //Setup new survey in QueXF automatically
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, trim(Configure::read('QueXF.new')));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_HTTPHEADER, 
  			array(
  				 	'Accept-Language: en-US'
  				)
				);   
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-GB; rv:1.9.2) Gecko/20100115 Firefox/3.6 (.NET CLR 3.5.30729)");
        $result = curl_exec($ch);
        curl_close($ch);   
        
        //Read the PDF file to the user for download
        header('Content-Type: application/octet-stream');
        header("Content-Disposition: attachment; filename=$pdfFilename"); 
        header('Content-Transfer-Encoding: binary');
        $pdfFullFilename = $pdfDestination . '/' . $pdfFilename;
        readfile($pdfFullFilename);
        
        //Delete intermediary zip
        unlink($zipFilename);
        
        return;
    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->SurveyGroup->id = $id;
		if (!$this->SurveyGroup->exists()) {
			throw new NotFoundException(__('Invalid training'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->SurveyGroup->save($this->request->data)) {
				$this->Session->setFlash(__('The training has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The training could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->SurveyGroup->read(null, $id);
		}
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void 
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->SurveyGroup->id = $id;
		if (!$this->SurveyGroup->exists()) {
			throw new NotFoundException(__('Invalid training'));
		}
		if ($this->SurveyGroup->delete()) {
			$this->Session->setFlash(__('Training deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Training was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


/**
 * This function is for uploading a zip of scanned in PDF surveys
 *
 * @param string $id id of surveygroup being uploaded to
 * @return void 
 */    
	public function upload_zip($id = null) {
	    if($this->request->isPost()){
    	    //this means something was POSTed
	    	if($this->data['SurveyGroup']['Surveys']['error'] > 0){
        	    $this->Session->setFlash( __('An error occured during upload.', true), 'default', array('class' => 'error-message'), 'flash');
    	    } else {
		        $this->SurveyGroup->id = $id;
		        if (!$this->SurveyGroup->exists()) {
			        throw new NotFoundException(__('Invalid training'));
		        }
                
                //save uploaded zip to the webroot/files directory
                $rel_url = 'files';
		        $folder_url = WWW_ROOT.$rel_url;
		        $tmpname = $this->data['SurveyGroup']['Surveys']['tmp_name'];
		        $filename = str_replace(' ', '_', $this->data['SurveyGroup']['Surveys']['name']);
		        $url = $rel_url.'/'.$filename;
		        $success = move_uploaded_file($tmpname, $url);

                //Extract surveys to queXF destination
		        $quexfDestination = ROOT . "/quexf/results";
        	    $zip = new ZipArchive();
        	    $zip->open(WWW_ROOT . $url);
		        $zip->extractTo($quexfDestination);
		        chmod($quexfDestination, 0777);

			    $this->Session->setFlash(
					    __('The %s has been uploaded', __('Surveys')),
					    'alert',
					    array(
						    'plugin' => 'TwitterBootstrap',
						    'class' => 'alert-success'
					    ),
					    'flash'
				    );
				    $this->redirect(array('action' => 'view', $id));
		    }
	    }
	}



/**
 * This function is for uploading a csv of processed survey results from QueXF
 *
 * @param string $id id of surveygroup being uploaded to
 * @return void 
 */    
	public function upload($id = null) {
		outputdatacsv(intval($id),"",false,true);
	
	
		// if($this->request->isPost()){
		//this means something was POSTed
		//  	if($this->data['SurveyGroup']['Surveys']['error'] > 0){
		//  	    $this->Session->setFlash( __('An error occured during upload.', true), 'default', array('class' => 'error-message'));
		//    	} else{
	
		/*$this->SurveyGroup->id = $id;
		 if (!$this->SurveyGroup->exists()) {
		throw new NotFoundException(__('Invalid training'));
		}
		$this->SurveyGroup->set('attendance', $this->request->data['SurveyGroup']['attendance']);
		$this->SurveyGroup->save();
	
		$rel_url = 'files';
		$folder_url = WWW_ROOT.$rel_url;
		$tmpname = $this->data['SurveyGroup']['Surveys']['tmp_name'];
		$filename = str_replace(' ', '_', $this->data['SurveyGroup']['Surveys']['name']);
		$url = $rel_url.'/'.$filename;
		$success = move_uploaded_file($tmpname, $url);*/
	
	
		$this->SurveyGroup->id = $id;
		if (!$this->SurveyGroup->exists()) {
			throw new NotFoundException(__('Invalid training'));
		}
		//		    	$this->SurveyGroup->set('attendance', $this->request->data['SurveyGroup']['attendance']);
		//		    	$this->SurveyGroup->save();
			
		 
		$file = fopen("$id.csv", "r");//file($this->data['SurveyGroup']['Surveys']['tmp_name']);
		$first = true;
		foreach($file as $line){
			if($first) {
				$first = false;
				continue;
			}
			$split = str_getcsv ( $line, ',', '"' , $escape = '\\' );
			$exposed = $split[0];
			$ideas = $split[1];
			$expectations = $split[2];
			$interactivity = $split[3];
			$trainingSource = '';
			for($i = 7; $i <= 16; $i++) {
				$toAdd = 0;
				if($split[$i] === '1') {
					$toAdd = 1;
				}
				$trainingSource = $trainingSource . $toAdd;
			}
	
			$this->SurveyGroup->Survey->create();
			$this->SurveyGroup->Survey->set('exposure', $exposed);
			$this->SurveyGroup->Survey->set('new_ideas', $ideas);
			$this->SurveyGroup->Survey->set('expectations', $expectations);
			$this->SurveyGroup->Survey->set('interactivity', $interactivity);
			$this->SurveyGroup->Survey->set('training_source', $trainingSource);
			$this->SurveyGroup->Survey->set('survey_group_id', $id);
	
			$this->SurveyGroup->Survey->save();
	
		}
	
		$this->Session->setFlash(
				__('Survey results have been updated, you can now view the results under analysis.'),
				'alert',
				array(
						'plugin' => 'TwitterBootstrap',
						'class' => 'alert-success'
				)
		);
		$this->redirect(array('action' => 'view', $id));
	
	}

public function isAuthorized($user) {
    // Admin can access every action
  
    return true; 
}
}
