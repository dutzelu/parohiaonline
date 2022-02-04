<?php


$dbServerName = 'localhost';
$dbUser = 'root';
$dbPassword = '';
$dbName = 'parohiaonline';

$conn = mysqli_connect ($dbServerName, $dbUser, $dbPassword, $dbName);
mysqli_set_charset($conn, "utf8");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);



class database{

    public $que;

    private $servername='localhost';
    private $username='root';
    private $password='';
    private $dbname='parohiaonline';
    private $result=array();
    private $mysqli='';


    public function __construct(){
        $this->mysqli = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
    }


    public function insert($table,$para=array()){

        $table_columns = implode(',', array_keys($para));

        $table_value = implode("','", $para);

        $sql="INSERT INTO $table($table_columns) VALUES('$table_value')";

        $result = $this->mysqli->query($sql);

    }


    public function update($table,$para=array(),$id){

        $args = array();

        foreach ($para as $key => $value) {

            $args[] = "$key = '$value'"; 

        }

        $sql="UPDATE  $table SET " . implode(',', $args);

        $sql .=" WHERE $id";

        $result = $this->mysqli->query($sql);
    }


    public function delete($table,$id){

        $sql="DELETE FROM $table";

        $sql .=" WHERE $id ";

        $sql;

        $result = $this->mysqli->query($sql);
    }


    public $sql;


    public function select($table,$rows="*",$where = null, $altele=''){

        if ($where != null) {

            $sql="SELECT $rows FROM $table WHERE $where $altele";

        }else{

            $sql="SELECT $rows FROM $table $altele";
        }
        
        $this->sql = $result = $this->mysqli->set_charset("utf8");
        $this->sql = $result = $this->mysqli->query($sql);

    }


    public function __destruct(){

        $this->mysqli->close();

    }

}

?>