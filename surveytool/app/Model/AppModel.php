<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
 private static $lastLogID = 0, $lastInsID = 0;

  public function afterSave($created=null) {
    global $lastLogID, $lastInsID;
    if ( $this->name == "Log" )
      $lastLogID = $this->id;
    else {
      $lastInsID = $this->id;
      // Yes, this is calling an action from the model when it should
      // be calling it from the controller instead.  But after chasing
      // a ridiculous CakePHP bug (or perhaps it was a PHP bug) for an
      // hour, I don't care.  It's 3 a.m.  Deal with it.
      SQLLogComponent::updateIDForLogEntry($lastLogID,$lastInsID);
    }
  }
}
