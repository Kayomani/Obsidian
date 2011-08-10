<?php if (!defined("PHP_MUMBLE_VIEWER")) die ('unauthorized access');

###########################################################
# MumbleInputIce                                          #
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
class MumbleInputIce extends MumbleInput {

    var $_data;
    var $_params;
    var $_ice;

    /**
     * Makes connection with the ICE-Proxy.
     *
     * @global <type> $ICE
     */
    function __construct() {
	global $ICE;

	//TODO why does this not work with Joomla???
	Ice_loadProfile();
	$base           = $ICE->stringToProxy("Meta:tcp -h 127.0.0.1 -p 6502");
	$this->_ice     = $base->ice_checkedCast("::Murmur::Meta");
    }

    /**
     * Converts recursively an Ice-Channel to an array.
     *
     * @param IceObject $iceChannel
     * @return Channel-Array
     */
    function _loadChannel($iceChannel) {
	$channel             = array();
	$channel['id']       = $iceChannel->c->id;
	$channel['name']     = $iceChannel->c->name;
	$channel['parent']   = $iceChannel->c->parent;
	$channel['channels'] = array();
	$channel['users']    = array();
	$channel['links']    = array();
	foreach ($iceChannel->children as $_channel) {
	    $channel['channels'][] = $this->_loadChannel($_channel);
	}
	// for mumble 1.1.x compability!
	if ($iceChannel->players != null) {
	    foreach ($iceChannel->players as $_player) {
		$channel['users'][] = $this->_loadUser($_player);
	    }
	} else if ($iceChannel->users != null) {
	    foreach ($iceChannel->users as $_user) {
		$channel['users'][] = $this->_loadUser($_user);
	    }
	}
	/*foreach ($iceChannel->links as $_links) {
	}*/
	return $channel;
    }

    /**
     * Converts recursively an Ice-User to an array.
     *
     * @param IceObject $iceUser
     * @return User-Array
     */
    function _loadUser($iceUser) {
	$user = array();
	$user['session']     = $iceUser->session;
	$user['id']          = $iceUser->playerid;
	$user['mute']        = $iceUser->mute;
	$user['deaf']        = $iceUser->deaf;
	$user['suppressed']  = $iceUser->suppressed;
	$user['selfMute']    = $iceUser->selfMute;
	$user['selfDeaf']    = $iceUser->selfDeaf;
	$user['channel']     = $iceUser->channel;
	$user['name']        = $iceUser->name;
	$user['onlinesecs']  = $iceUser->onlinesecs;
	$user['bytespersec'] = $iceUser->bytespersec;
	return $user;
    }

    function setParams($params) {
	$this->_params = $params;
    }

    function loadData() {
	$port       = $this->_params['port'];
	$servers    = $this->_ice->getBootedServers();
	$default    = $this->_ice->getDefaultConf();

	foreach ($servers as $id => $iceServer) {
	    if($iceServer->getConf('port') == $port) {
		$port       = $iceServer->getConf('port');
		$servername = $iceServer->getConf("registername");
		$tree       = $iceServer->getTree();

		$server = $this->_loadChannel($tree);
		$server['name'] = $servername;
		$server['host'] = $default['host'].':'.$port;

		return $this->_data = $server;
	    }
	}
	return null;
    }

    function getData() {
	return $this->_data;
    }

}
?>
