<?php

namespace App\Models;

use voku\helper\HtmlDomParser;

class Link extends Model {

	protected $table = 'links';
	protected $fillable = ['url'];

	public function __construct($url = false) {
		if ($url) {
			$this->url = $url;

			if(!$this->validate()){
				throw new \Exception('Not a valid url');
				exit;
			}else{
				$this->get_meta();
			}
		}
	}

	private function validate(){
		return filter_var($this->url, FILTER_VALIDATE_URL);
	}

	public function get_meta(){
		$page = file_get_contents($this->url);
		$dom = HtmlDomParser::str_get_html($page);

		$metadata = [];
		foreach ($dom->find('meta') as $meta) {
			if ($meta->hasAttribute('content')) {
				if ($meta->getAttribute('property')) {
					$metadata[$meta->getAttribute('property')][] = $meta->getAttribute('content');
				}elseif($meta->getAttribute('name')){
					$metadata[$meta->getAttribute('name')][] = $meta->getAttribute('content');
				}
			}
		}

		$title = $dom->find('title', 0)->innerText();
		$description = isset($metadata['description']) ? implode(', ', $metadata['description']) : '';

		$this->title = $title;
		$this->description = $description;
		$this->icon = $this->get_favicon();

		return;
	}

	public function get_favicon(){
		return 'http://www.google.com/s2/favicons?domain='.$this->url;
	}

}
