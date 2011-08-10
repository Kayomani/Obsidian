<?php
###########################################################
# PHP Mumble Viewer                                       #
# --------------------------------------------------------#
# version  : 1.2 (06.12.2009)                             #
# author   : Jean-Michel Ruiz                             #
# mail     : mail@coolcow.org                             #
# homepage : http://phpmumbleviewer.coolcow.org           #
###########################################################

define('PHP_MUMBLE_VIEWER',             true);
define('PHPMUMBLEVIEWER_VERSION',       1.2);

class PhpMumbleViewer {

    var $input;
    var $output;

    function configureInput($type, $params = null) {
	$className = 'MumbleInput'.ucfirst($type);
	$classFile = 'input/'.$className.'.class.php';

	require_once($classFile);
	$mumbleInput = new $className();
	$mumbleInput->setParams($params);
	$this->input = $mumbleInput;
    }

    function configureOutput($type, $params = null) {
	$className = 'MumbleOutput'.ucfirst($type);
	$classFile = 'output/'.strtolower($type).'/'.$className.'.class.php';

	require_once($classFile);
	$mumbleOutput = new $className();
	$mumbleOutput->setParams($params);
	$this->output = $mumbleOutput;
    }

    function render() {
	if (is_object($this->output) && $this->input) {
	    $this->output->setData($this->input->loadData());
	    return $this->output->renderViewer();
	} else {
	    return "";
	}
    }

}

?>
