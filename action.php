<?php
 
if(!defined('DOKU_INC')) die();


class action_plugin_resizeblacklist extends DokuWiki_Action_Plugin { 

    /**
     * Register its handlers with the DokuWiki's event controller
     */
    public function register(Doku_Event_Handler $controller) {
        $controller->register_hook('MEDIA_RESIZE', 'BEFORE', $this, 'can_resize');
    }
    /**
     * @param Doku_Event $event  event object by reference
     * @param mixed      $param  empty
     * @param string     $advise the advise the hook receives
     */
    function can_resize(&$event, $param) {
        $EXT = $event->data["ext"];
        $MIME = $event->data["ext"];
        $isImage = substr($MIME, 0, 5) == 'image';
        
        return !( $isImage && (in_array("all", $this->getConf("no_resize")) || in_array($EXT, $this->getConf["no_resize"])) );
    }
}