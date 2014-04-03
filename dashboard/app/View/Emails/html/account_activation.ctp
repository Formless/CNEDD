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
 * @package       Cake.View.Emails.html
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<p>Dear CNE Data Dashboard Administrator,</p>
<p>A new user has requested access to the dashboard.  Click on the link below to view the user information and activate them</p>
<br>
<?php 
    $hostNameSplitFromPort = explode(":", $_SERVER['HTTP_HOST']);
    $realm = 'http://' . $hostNameSplitFromPort[0];
?>
<p><?php echo $realm . $this->Html->url(array('action' => 'view', $id)); ?></p>
<br>
<p>Thank you</p>
