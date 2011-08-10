<?php if (!defined("PHP_MUMBLE_VIEWER")) die ('unauthorized access');

###########################################################
# MumbleInput                                             #
# --------------------------------------------------------#
# version  : 1.1 (31.01.2009)                             #
# author   : Jean-Michel Ruiz                             #
# mail     : mail@coolcow.org                             #
# homepage : http://phpmumbleviewer.coolcow.org           #
###########################################################

/* abstract */
class MumbleInput {

    /* abstract */
    function setParams($params) {}

    /* abstract */
    function loadData() {}

    /* abstract */
    function getData() {}
}
?>
