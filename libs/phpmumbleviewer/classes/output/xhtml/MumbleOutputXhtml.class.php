<?php if (!defined("PHP_MUMBLE_VIEWER")) die ('unauthorized access');

###########################################################
# MumbleOutputXhtml                                       #
# --------------------------------------------------------#
# version  : 1.2 (06.12.2009)                             #
# author   : Jean-Michel Ruiz                             #
# mail     : mail@coolcow.org                             #
# homepage : http://phpmumbleviewer.coolcow.org           #
###########################################################

require_once(dirname(__FILE__).'/../MumbleOutput.class.php');

/*
 */
class MumbleOutputXhtml extends MumbleOutput {

    var $params = null;
    var $data   = null;

    var $depth = 0;
    var $level = 0;
    var $tree  = array();

    function _printChannel($channel, $isLast, $indent_depth = 0) {
	$icons_path = $this->params['icons'];

	if ($channel['parent'] == -1) {
	    $line = $this->_printTree($isLast)."<img src=\"${icons_path}mumble.png\" alt=\"\" /> <b><a href=\"mumble://${channel['host']}\">".$channel['name']."</a></b>";
	} else {
	    $line = $this->_printTree($isLast)."<img src=\"${icons_path}channel.png\" alt=\"\" /> ".$channel['name'];
	}
	$text = $this->_printLine($line, $indent_depth);
	$this->depth++;

	// for mumble 1.1.x compability!
	if(count($channel['players']) > 0) {
	    $channel['users'] = $channel['players'];
	    unset($channel['players']);
	}

	if (count($channel['channels']) + count($channel['users']) > 0) { # channel not empty?
	    foreach ($channel['channels'] as $_channel) {
		$lastChannel = $channel['channels'][count($channel['channels']) - 1];
		$text .= $this->_printChannel(
		    $_channel,
		    (count($channel['users']) == 0) && $lastChannel['id'] == $_channel['id'],      # isLast?
		    $indent_depth
		);
	    }
	    foreach ($channel['users'] as $_user) {
		$lastUser = $channel['users'][count($channel['users']) - 1];
		$text .= $this->_printUser(
		    $_user,
		    $lastUser['session'] == $_user['session'],        # isLast?
		    $indent_depth
		);
	    }
	}
	$this->depth--;
	return $text;
    }

    function _printUser($user, $isLast, $indent_depth = 0) {
	$icons_path = $this->params['icons'];

	$line  = $this->_printTree($isLast);
	$line .= "<img src=\"${icons_path}talking_on.png\" alt=\"\" /> ".$user['name']." ";
	if ($user['id'] != -1)	$line .= "<img src=\"${icons_path}authenticated.png\" alt=\"\" />";
	if ($user['mute'])		$line .= "<img src=\"${icons_path}muted_server.png\" alt=\"\" />";
	if ($user['deaf'])		$line .= "<img src=\"${icons_path}deafened_server.png\" alt=\"\" />";
	if ($user['suppressed'])	$line .= "<img src=\"${icons_path}muted_local.png\" alt=\"\" />";
	if ($user['selfMute'])	$line .= "<img src=\"${icons_path}muted_self.png\" alt=\"\" />";
	if ($user['selfDeaf'])	$line .= "<img src=\"${icons_path}deafened_self.png\" alt=\"\" />";
	return $this->_printLine($line, $indent_depth);
    }

    function _printLine($line, $indent_depth) {
	$this->level++;
	return str_repeat("\t", $indent_depth)."<span class=\"mumble_line\">".$line."</span><br />\n";
    }

    function _printTree($isLast) {
	$icons_path = $this->params['icons'];

	for ($depth = 0; $depth < $this->depth; $depth++) {
	    $tmp = ($this->tree[$this->level-1][$depth] == 1 || $this->tree[$this->level-1][$depth] == 2);
	    $this->tree[$this->level][$depth] = ($tmp)? 1 : 0;                                   # line or blank?
	}
	$this->tree[$this->level][$this->depth] = ($isLast)? 3 : 2;                              # end or node
	for ($index = 1; $index <= $this->depth; $index++) {
	    switch ($this->tree[$this->level][$index]) {
		case 0: $text .=  "<img src=\"${icons_path}line_blank.png\" alt=\"\" />";
		    break;
		case 1: $text .=  "<img src=\"${icons_path}line.png\" alt=\"\" />";
		    break;
		case 2: $text .=  "<img src=\"${icons_path}line_node.png\" alt=\"\" />";
		    break;
		case 3: $text .=  "<img src=\"${icons_path}line_end.png\" alt=\"\" />";
		    break;
	    }
	}
	return $text;
    }

    function setParams($params) {
	$this->params = $params;
    }

    function setData($data) {
	$this->data = $data;
    }

    function renderViewer() {
	$server		= $this->data;
	$indent_depth	= $this->params['indent'];

	$indent = str_repeat("\t", $indent_depth);
	$text .= "$indent<div class=\"mumble_server\">\n";
	$text .= $this->_printChannel($server, true, $indent_depth + 1);
	$text .= "$indent</div>\n";
	$text .= "$indent<br />\n";
	$text .= "$indent<i><a href=\"http://phpmumbleviewer.coolcow.org\">PHP Mumble Viewer</a></i>\n";
	return $text;
    }

}
?>
