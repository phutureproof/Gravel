<?phpnamespace Gravel\Core;use Gravel\TemplateEngine;class Response{	public $data = [		'views'    => [],		'compiled' => ''	];	public function __destruct()	{		$this->generateResponse();	}	public function generateResponse()	{		TemplateEngine::compile();		echo TemplateEngine::$data['compiled'];		echo "\n\n<!-- generated in " . number_format(microtime(true) - \Gravel\Gravel::$startTime, 5) . " seconds -->";	}	public function addOutput($file, $data = [])	{		TemplateEngine::parseTemplate($file, $data);	}}