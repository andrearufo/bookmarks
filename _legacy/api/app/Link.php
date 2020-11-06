<?php

/**
 *
 */
class ClassName  extends Illuminate\Database\Eloquent\Model
{

    function __construct(String $url)
    {
        $this->url = $url;
    }

    public function validate(){
        $url = htmlspecialchars($this->url);
        return !empty($url) || filter_var($url, FILTER_VALIDATE_URL);
    }
}
