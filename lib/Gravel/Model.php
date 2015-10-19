<?phpnamespace Gravel;use Gravel\Core\Database;use Gravel\Core\EntityCollection;use Gravel\Core\RecordEntity;class Model{    protected static $table = '';    protected static $idColumn = 'id';    protected static $hidden = [];    public static function find($id)    {        $db = Database::getInstance();        $table = static::$table;        $idColumn = static::$idColumn;        $id = intval($id);        $data = $db            ->query("SELECT * FROM `{$table}` WHERE `{$idColumn}` = {$id}")            ->fetch(\PDO::FETCH_ASSOC);        return ($data) ? static::generateRecordEntity($data) : false;    }    public static function generateRecordEntity($data)    {        return new RecordEntity(            $data,            static::$hidden,            static::$table,            static::$idColumn        );    }    public static function findAllBy($data)    {        $db = Database::getInstance();        $table = static::$table;        foreach ($data as $k => $v) {            $data[$k] = '%' . $v . '%';        }        $where = [];        foreach ($data as $k => $v) {            $where[] = "{$k} LIKE ?";        }        $where = implode(', ', $where);        $statement = $db->prepare("SELECT * FROM {$table} WHERE {$where}");        $statement->execute(array_values($data));        $data = $statement->fetchAll(\PDO::FETCH_CLASS);        $toReturn = [];        foreach($data as $newObject) {            array_push($toReturn, static::generateRecordEntity($newObject));        }        return new EntityCollection($toReturn);    }    public static function findOneBy($data = [])    {        $db = Database::getInstance();        $table = static::$table;        foreach ($data as $k => $v) {            $data[$k] = '%' . $v . '%';        }        $where = [];        foreach (array_keys($data) as $column) {            $where[] = "{$column} LIKE ?";        }        $where = implode(' AND ', $where);        $statement = $db->prepare("SELECT * FROM {$table} WHERE {$where} LIMIT 1");        $statement->execute(array_values($data));        $data = $statement->fetch(\PDO::FETCH_ASSOC);        return ($data) ? static::generateRecordEntity($data) : false;    }    public static function create()    {        $db = Database::getInstance();        $table = static::$table;        $data = $db            ->query("SHOW COLUMNS FROM {$table}")            ->fetchAll(\PDO::FETCH_ASSOC);        $columns = [];        foreach ($data as $k => $v) {            $columns[$v['Field']] = '';        }        return static::generateRecordEntity($columns);    }    public static function all()    {        $db = Database::getInstance();        $table = static::$table;        $data = $db            ->query("SELECT * FROM `{$table}`")            ->fetchAll(\PDO::FETCH_ASSOC);        $toReturn = [];        foreach ($data as $newObject) {	        array_push($toReturn, static::generateRecordEntity($newObject));        }        return new EntityCollection($toReturn);    }}