<?phpnamespace Gravel\Core;class EntityCollection extends Collection{    public $data = [];    public function __construct($data)    {        $this->data = $data;    }    public function __toString()    {        $string = [];        foreach ($this->data as $k => $v)        {            if (is_object($v)) {                $string[] = $v;            }        }        return '[' . implode(',', $string) . ']';    }}