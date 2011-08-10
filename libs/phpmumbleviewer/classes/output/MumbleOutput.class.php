<?php if (!defined("PHP_MUMBLE_VIEWER")) die ('unauthorized access');

###########################################################
# MumbleOutput                                            #
# --------------------------------------------------------#
# version  : 1.1 (31.01.2009)                             #
# author   : Jean-Michel Ruiz                             #
# mail     : mail@coolcow.org                             #
# homepage : http://phpmumbleviewer.coolcow.org           #
###########################################################

/* abstract */
class MumbleOutput {

    /* abstract */
    function setParams($params) {}

    /* abstract */
    function setData($data) {}

    /* abstract */
    function renderViewer() {}
}
?>
