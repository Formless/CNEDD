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
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$loginLink = $this->Html->link('Please Login', array('controller' => 'users', 'action' => 'login'));
$loginHeader = "Please Log In";
$userAction = "users/login";
if (isset($who)) {
   $loginLink = "Logged in as '$who' (" . $this->Html->link('logout', array('controller' => 'users', 'action' => 'logout')) . ")";
   $loginHeader = "Log Out";
   $userAction = "users/logout";
}

$siteTitle = "CNE Survey Creation Tool";
$cakePower = "Powered by CakePHP";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php echo $this->Html->charset(); ?>
  <title><?php echo $title_for_layout; ?></title>
  <!--  meta info -->
  <?php
    echo $this->Html->meta(array("name"=>"viewport",
      "content"=>"width=device-width,  initial-scale=1.0"));
    echo $this->Html->meta(array("name"=>"description",
      "content"=>"this is the description"));
    echo $this->Html->meta(array("name"=>"author",
      "content"=>"TheHappyDeveloper.com - @happyDeveloper"))
  ?>

  <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
  <!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

  <!-- styles -->
  <?php
    echo $this->Html->css('bootstrap_blue_theme');
    echo $this->Html->css('bootstrap-responsive.min');
    echo $this->Html->css('datepicker');
    echo $this->Html->css('docs');
    echo $this->Html->css('prettify');
  ?>
  <!-- icons -->
  <?php
    echo $this->Html->meta('icon',$this->webroot.'img/favicon.ico');
    echo $this->Html->meta(array('rel' => 'apple-touch-icon',
      'href'=>$this->webroot.'img/apple-touch-icon.png'));
    echo $this->Html->meta(array('rel' => 'apple-touch-icon',
      'href'=>$this->webroot.'img/apple-touch-icon.png',  'sizes'=>'72x72'));
    echo $this->Html->meta(array('rel' => 'apple-touch-icon',
      'href'=>$this->webroot.'img/apple-touch-icon.png',  'sizes'=>'114x114'));
  ?>
  <!-- page specific scripts -->
    <?php 
    	echo $scripts_for_layout; 
    	echo $this->Html->script('jquery'); // Include jQuery library
	echo $this->Html->script('bootstrap-datepicker'); // Include jQuery library
	echo $this->Html->script('bootstrap.min'); // Include Bootstrap
	echo $this->fetch('script');
    ?>

    <script>
        $(function() {
           $(".datepicker").datepicker({
				format: 'yyyy-mm-dd'
			});
        });

    </script>    
</head>

<body data-spy="scroll" data-target=".subnav" data-offset="50">
  <div id="container">
  <!-- Navbar ============================================= -->
  <div class="navbar navbar-fixed-top">
  <div class="navbar navbar-inverse">
    <div class="navbar-inner">
      <div class="container">
        <a class="btn btn-navbar" data-toggle="collapse"
          data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <a class="brand" href="<?php echo $this->webroot;?>">CNE Survey Tools</a>
        <div class="nav-collapse">
          <ul class="nav">
		<?php //bar highlighting
			$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
			$home = "";
			$analyze = "";
			$survey_g = "";
			$login = "";

			if (false !== strpos($url, 'analyze') || false !== strpos($url, 'charts')) {
			    $analyze = "active";
			} 
			else if (false !== strpos($url,'survey_groups')) {
			    $survey_g = "active";
			} 
			else{
			    $home = "active";
			}
		?>
            <li class="<?php echo $home ?>">
              <a href="<?php echo $this->webroot;?>">Home</a>
            </li>
            <li class="<?php echo $survey_g ?>">
              <a href="<?php echo $this->webroot;?>survey_groups">Trainings</a>
            </li>
            <li class="<?php echo $analyze ?>">
              <a href="<?php echo $this->webroot;?>surveys/analyze">Analysis</a>
            </li>
	    <li class="<?php echo $login ?>">
              <a href="<?php echo $this->webroot; echo $userAction?>"><?php echo $loginHeader;?></a>
            </li>
        
          </ul>
        </div>
      </div>
    </div>
  </div>
  </div>
	<div id="container">
		<div id="header">
		<br>
		<br>
		<br>
		</div>
		<div id="content">
			
			<div class="actions">
			
			</div>
			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
		
		</div>
	</div>
<!--<?php echo $this->element('sql_dump'); ?>-->
<?echo $this->Js->writeBuffer(); // Write cached scripts ?>
</body>
</html>
