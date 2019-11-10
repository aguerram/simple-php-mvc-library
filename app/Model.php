    <?php
    class Model
    {
        private static $connection;
        protected $table = "test";
        protected $columns = [];

        public function __construct()
        {
            if (Model::$connection == null) {
                $options = [
                    PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, //make the default fetch be an associative array
                ];
                $host = $this->env("DB_HOST");
                $user = $this->env("DB_USER");
                $password = $this->env("DB_PASSWORD");
                $db = $this->env("DB_DATABASE");
                Model::$connection = new PDO("mysql:host=$host;dbname=$db", $user, $password,$options);
            }
        }
        private function env($path)
        {
            global $env;
            return $env->get($path);
        }
        private function escape($sql)
        {
            $sql = str_replace("'","\'",$sql);
            $sql = str_replace('"','\"',$sql);
            $sql = htmlspecialchars($sql);
            return $sql;
        }
        
        public function query($sql, $args = [])
        {
            $stm = Model::$connection->prepare($this->escape($sql));
            $stm->execute($args);
            return $stm->rowCount();
        }

        public function select($sql, $args = [])
        {
            $stm = Model::$connection->prepare($this->escape($sql));
            $stm->execute($args);
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        }
        public function selectOne($sql, $args = [])
        {
            $stm = Model::$connection->prepare($this->escape($sql)." limit 1");
            $stm->execute($args);
            return $stm->fetch(PDO::FETCH_ASSOC);
        }
        public function all($columns = "*", $condition = "1")
        {
            $cond = $this->escape($condition);
            return $this->select("select $columns from " . $this->table . " where $cond");
        }
        public function update($array, $condition)
        {
            $values = [];
            $table = $this->table;
            $sql = "update $table set ";
            foreach ($array as $key => $value) {
                $sql .= " $key=:$key,";
                $values[":$key"] = $value;
            }
            $sql = substr($sql, 0, strlen($sql) - 1);
            $sql .= " where $condition";
            return $this->query($sql, $values);
        }
        public function create($array)
        {
            $cols = "";
            $col_values = "";
            $values = [];
            $table = $this->table;

            $length = count($array);
            $index = 0;

            foreach ($array as $key => $value) {
                $cols .= "$key";
                $col_values .= ":$key";
                $values["$key"] = $value;
                $index++;
                if ($index < $length) {
                    $cols .= ",";
                    $col_values .= ",";
                }
            }
            $sql = "insert into $table($cols) values($col_values)";
            return $this->query($sql, $values);
        }
        public function delete($condition)
        {
            $cond = $this->escape($condition);
            return $this->query("delete from ".$this->table." where $cond");
        }
    }
