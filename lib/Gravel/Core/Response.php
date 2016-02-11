<?php

namespace Gravel\Core;

use Gravel\Gravel;
use Gravel\TemplateEngine;

class Response
{
	public $data = ['views' => [], 'compiled' => ''];

	public function __destruct()
	{
		$this->generateResponse();
	}

	public function generateResponse()
	{
		TemplateEngine::compile();

		if (Gravel::$config['gravel']['tidy_html'] && class_exists('Tidy')) {
			$html = new \Tidy();
			$config = [
				'indent' => 1,
				'indent-spaces' => 4,
				'output-xhtml' => 'false',
				'wrap' => 0,
				'hide-comments' => 0
			];
			$html->parseString(TemplateEngine::$data['compiled'], $config);
		} else {
			$html = TemplateEngine::$data['compiled'];
		}

		if (Gravel::$config['gravel']['debug_mode']) {
			header("Content-Type: text/plain");
		}

		echo $html;

		// if we don't have an ajax request we can output some debug info
		if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] !== 'XMLHttpRequest') {
			$version = Gravel::$version;
			echo PHP_EOL . "<!-- Generated in " . number_format(microtime(true) - Gravel::$startTime, 5) . " seconds -->";
			echo PHP_EOL . "<!-- Gravel PHP framework {$version} -->";
		}
	}

	public function addOutput($file, $data = [])
	{
		TemplateEngine::parseTemplate($file, $data);
	}
}