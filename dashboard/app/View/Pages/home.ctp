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
//if (!Configure::read('debug')):
//	throw new NotFoundException();
//endif;
App::uses('Debugger', 'Utility');
?>
<body>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span1"></div>
            <div class="span10">
                <h2><?php echo "Welcome to the Center For Nonprofit Excellence Data Dashboard"; ?></h2>
            </div>
        </div>
        <div class="row-fluid">
        	<div class="span10 offset1">
                <h3><?php echo "Instructions"; ?></h3>        	    
            	<ul class="nav nav-tabs">
                  <li class="active"><a href="#financial" data-toggle="tab">Uploading Financial Data</a></li>
                  <li><a href="#membership" data-toggle="tab">Uploading Membership Data</a></li>
                  <li><a href="#fundraising" data-toggle="tab">Adding Fundraising Data</a></li>
                  <li><a href="#analyze" data-toggle="tab">Analyzing Financial Data</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="financial"><?php echo $financialInstructions ?></div>
                  <div class="tab-pane" id="membership"><?php echo $membershipInstructions ?></div>
                  <div class="tab-pane" id="fundraising"><?php echo $fundraisingInstructions ?></div>
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

