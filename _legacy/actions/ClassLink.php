<?php

class Link{
    function __construct($url){
        $this->url = $url;
        $this->update = date('Y-m-d H:i');
    }

    public function validate($url){
        $url = htmlspecialchars($url);
        return !empty($url) || filter_var($url, FILTER_VALIDATE_URL);
    }
}
