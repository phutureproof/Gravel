<?phpnamespace Gravel;use Gravel\Core\Request;use Gravel\Core\Response;use Gravel\Core\Router;abstract class Gravel{    /** @var \Gravel\Core\Request */    public static $request;    /** @var \Gravel\Core\Response */    public static $response;    /** @var \Gravel\Core\Router */    public static $router;    /** @var bool */    public static $initialized = false;    public static $startTime;    public static function init()    {        if (!self::$initialized) {	        self::$startTime = microtime(true);            self::$initialized = true;            self::$request = new Request();            self::$response = new Response();            self::$router = new Router();	        self::configure();        }        self::$router->matchRoute();    }    public static function show404()    {        $controller = new Controller();	    $controller->loadView('utilities/404');    }	public static function configure()	{		$config = parse_ini_file(APP_DIR . '/app.config.ini', true);		if ($config['gravel']['maintenance_mode']) {			(new Controller())->loadView('utilities/maintenance');			exit;		}		foreach ($config['php'] as $k => $v) {			ini_set($k, $v);		}	}}