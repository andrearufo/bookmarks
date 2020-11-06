<?php

namespace App\Models;

class Link extends Model {

	protected $table = 'links';
	protected $fillable = ['url'];

	public function __construct($url = false) {
		if ($url) {
			$this->url = $url;

			if(!$this->validate()){
				throw new \Exception('Not a valid url');
				exit;
			}

		}
	}

	private function validate(){
		return filter_var($this->url, FILTER_VALIDATE_URL);
	}

	public function get_meta(){
		return get_meta_tags($this->url);
	}

}
