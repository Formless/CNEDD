<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

//if (Configure::read('debug') == 0):
//	throw new NotFoundException();
//endif;
App::uses('Debugger', 'Utility');
?>
<body>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span1"></div>
            <div class="span10">
                <h2><?php echo "Welcome to the Center For Nonprofit Excellence Survey Creation Tool"; ?></h2>
            </div>
        </div>
        <div class="row-fluid">
        	<div class="span10 offset1">
                <h3><?php echo "Instructions"; ?></h3>        	    
            	<ul class="nav nav-tabs">
                  <li class="active"><a href="#create" data-toggle="tab">Creating New Surveys</a></li>
                  <li><a href="#upload" data-toggle="tab">Uploading Completed Surveys</a></li>
                  <li><a href="#analyze" data-toggle="tab">Analyzing Survey Data</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="create"><?php echo $createInstructions ?></div>
                  <div class="tab-pane" id="upload"><?php echo $uploadInstructions ?></div>
                  <div class="tab-pane" id="analyze"><?php echo $analyzeInstructions ?></div>
                </div>             
                <script>
                  $(function () {
                    $('#myTab a:last').tab('show');
                  })
                </script>
            </div>
    	</div>
    </div>
</body>






