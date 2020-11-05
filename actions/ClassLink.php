<?php

class Link{
    function __construct($url){
        $this->url = $url;
        $this->update = date('Y-m-d H:i');
    }
}
