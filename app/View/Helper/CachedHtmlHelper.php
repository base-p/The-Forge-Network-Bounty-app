<?php

App::uses('HtmlHelper', 'View/Helper');

class CachedHtmlHelper extends HtmlHelper {
    var $helpers = array('Html');

    public function auto_version($file) {
        if (strpos($file, '/') !== 0 || !file_exists($_SERVER['DOCUMENT_ROOT'] . $file)) {
            return $file;

        }
        $mtime = filemtime($_SERVER['DOCUMENT_ROOT'] . $file);
        return preg_replace('{\\.([^./]+)$}', ".\$1?t=$mtime", $file);
    }

    public function css($path, $options = array()) {
        $path = $this->assetUrl($path, array('pathPrefix' => Configure::read('App.cssBaseUrl'), 'ext' => '.css'));
        return $this->Html->css($this->auto_version($path), $options);
    }

    public function script($url, $options = array()) {
        $url = $this->assetUrl($url, $options + array('pathPrefix' => Configure::read('App.jsBaseUrl'), 'ext' => '.js'));
        parent::script($this->auto_version($url), $options);
    }
}