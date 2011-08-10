<?php if (!defined("PHP_MUMBLE_VIEWER")) die ('unauthorized access');

###########################################################
# MumbleInputXml                                          #
# --------------------------------------------------------#
# version  : 1.2 (06.12.2009)                             #
# author   : Jean-Michel Ruiz                             #
# mail     : mail@coolcow.org                             #
# homepage : http://phpmumbleviewer.coolcow.org           #
###########################################################

require_once('MumbleInput.class.php');

/**
 * TODO: doc
 */
class MumbleInputXml extends MumbleInput {

    var $_data;
    var $_params;

    function _readChannel($xmlChannel, $parent = -1) {
	$channel = array();
	$channel['id']       = (int)$xmlChannel->id;
	$channel['name']     = (string)$xmlChannel->name;
	$channel['parent']   = $parent;
	$channel['channels'] = array();
	$channel['users']    = array();
	$channel['links']    = array();
	if ($xmlChannel->channels) {
	    foreach ($xmlChannel->channels->channel as $_channel) {
		$channel['channels'][] = $this->_readChannel($_channel, $channel['id']);
	    }
	}

	if ($xmlChannel->users) {
	    foreach ($xmlChannel->users->user as $_user) {
		$channel['users'][] = $this->_readUser($_user);
	    }
	} else if ($xmlChannel->players) {
	    // for phpmumbleviewer 1.1 compability!
	    foreach ($xmlChannel->players->player as $_player) {
		$channel['users'][] = $this->_readUser($_player);
	    }
	}

	if ($xmlChannel->links) {
	    foreach ($xmlChannel->links->link as $_link) {
	    }
	}
	return $channel;
    }

    function _readUser($xmlUser) {
        $user = array();
	$user['session']     = (int)$xmlUser->session;
	$user['id']          = (int)$xmlUser->id;
	$user['mute']        = (int)$xmlUser->mute;
	$user['deaf']        = (int)$xmlUser->deaf;
	$user['suppressed']  = (int)$xmlUser->suppressed;
	$user['selfMute']    = (int)$xmlUser->selfMute;
	$user['selfDeaf']    = (int)$xmlUser->selfDeaf;
	$user['channel']     = (int)$xmlUser->channel;
	$user['name']        = (string)$xmlUser->name;
	$user['onlinesecs']  = (int)$xmlUser->onlinesecs;
	$user['bytespersec'] = (int)$xmlUser->bytespersec;
	return $user;
    }

    function setParams($params) {
	$this->_params = $params;
    }

    function loadData() {
	$xml = simplexml_load_file($this->_params['xml']);

	$server = array();
	$server = $this->_readChannel($xml);
	$server['name'] = (string)$xml->name;
	$server['host'] = (string)$xml->host;

	return $this->_data = $server;
    }

    function getData() {
	return $this->_data;
    }

}
?>
