<?php if (!defined("PHP_MUMBLE_VIEWER")) die ('unauthorized access');

###########################################################
# MumbleOutputPrint_r                                     #
# --------------------------------------------------------#
# version  : 1.1 (31.01.2009)                             #
# author   : Jean-Michel Ruiz                             #
# mail     : mail@coolcow.org                             #
# homepage : http://phpmumbleviewer.coolcow.org           #
###########################################################

require_once(dirname(__FILE__).'/../MumbleOutput.class.php');

/*
 */
class MumbleOutputPrint_r extends MumbleOutput {

    var $data   = null;

    function setParams($params) {}

    function setData($data) {
	$this->data = $data;
    }
    
    function renderViewer() {
	ob_start();
	print_r($this->data);
	$text = ob_get_contents();
	ob_end_flush();
	return $text;
    }

}
?>
