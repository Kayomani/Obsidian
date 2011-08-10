<?php if (!defined("PHP_MUMBLE_VIEWER")) die ('unauthorized access');

###########################################################
# MumbleOutputXml                                         #
# --------------------------------------------------------#
# version  : 1.2 (06.12.2009)                             #
# author   : Jean-Michel Ruiz                             #
# mail     : mail@coolcow.org                             #
# homepage : http://phpmumbleviewer.coolcow.org           #
###########################################################

require_once(dirname(__FILE__).'/../MumbleOutput.class.php');

/*
 * Transforms an Mumbleserver array in a XML format.
 */
class MumbleOutputXml extends MumbleOutput {

    var $params = null;
    var $data   = null;

    /*
     * XML-object (XmlWriter)
     */
    var $_xml;

    /*
     * preparing the XML-object (XmlWriter)
     */
    function __construct() {
	$this->_xml = new XmlWriter();
	$this->_xml->openMemory();
    }

    /*
     * transforms recursively a channel to XML (included channels and users)
     */
    function _channelToXml($channel) {
	if ($channel['id'] > 0) {                                      # not root
	    $this->_xml->startElement('channel');
	    $this->_xml->writeElement('id', $channel['id']);
	    $this->_xml->writeElement('name', $channel['name']);
	}
	if (count($channel['channels']) > 0) {                         # contains channels
	    $this->_xml->startElement('channels');
	    foreach ($channel['channels'] as $_channel) {
		$this->_channelToXml($_channel);
	    }
	    $this->_xml->endElement();
	}

	// for mumble 1.1.x compability!
	if(count($channel['players']) > 0) {
	    $channel['users'] = $channel['players'];
	    unset($channel['players']);
	}

	if (count($channel['users']) > 0) {                          # contains users
	    $this->_xml->startElement('users');
	    foreach ($channel['users'] as $_users) {
		$this->_xml->startElement('user');
		if (isset($_users['session']))     $this->_xml->writeElement('session',     $_users['session']);
		if (isset($_users['id']))          $this->_xml->writeElement('id',          $_users['id']);
		if (isset($_users['mute']))        $this->_xml->writeElement('mute',        $_users['mute']);
		if (isset($_users['deaf']))        $this->_xml->writeElement('deaf',        $_users['deaf']);
		if (isset($_users['suppressed']))  $this->_xml->writeElement('suppressed',  $_users['suppressed']);
		if (isset($_users['selfMute']))    $this->_xml->writeElement('selfMute',    $_users['selfMute']);
		if (isset($_users['selfDeaf']))    $this->_xml->writeElement('selfDeaf',    $_users['selfDeaf']);
		if (isset($_users['channel']))     $this->_xml->writeElement('channel',     $_users['channel']);
		if (isset($_users['name']))        $this->_xml->writeElement('name',        $_users['name']);
		if (isset($_users['onlinesecs']))  $this->_xml->writeElement('onlinesecs',  $_users['onlinesecs']);
		if (isset($_users['bytespersec'])) $this->_xml->writeElement('bytespersec', $_users['bytespersec']);
		$this->_xml->endElement();
	    }
	    $this->_xml->endElement();
	}
	if (count($channel['links']) > 0) {                            # contains links
	    $this->_xml->startElement('links');
	    foreach ($channel['links'] as $_links) {
		$this->_xml->startElement('link');
		$this->_xml->endElement();
	    }
	    $this->_xml->endElement();
	}
	if ($channel['id'] > 0) {                                      # not root
	    $this->_xml->endElement();
	}
    }

    /*
     * transforms a server to XML
     */
    function _serverToXml($server) {
	$this->_xml->startElement('server');
	$this->_xml->writeElement('name', $server['name']);
	$this->_xml->writeElement('host', $server['host']);
	$this->_channelToXml($server);
	$this->_xml->endElement();
    }

    function setParams($params) {
	$this->params = $params;
    }

    function setData($data) {
	$this->data = $data;
    }

    function renderViewer() {
	ob_start();
	$this->_xml->startDocument('1.0', 'UTF-8');
	$this->_serverToXml($this->data);
	echo $this->_xml->outputMemory(true);
	$text = ob_get_contents();
	ob_end_flush();
	return $text;
    }

}
?>
