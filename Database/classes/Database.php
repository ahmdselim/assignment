<?php
define("DB_HOST", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "e-commerce");
class Database
{
    public $con;
    function __construct()
    {
        $this->con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    }

    public function login($table, $email, $password)
    {
        $hasPassword = sha1($password);
        $q_select_users = "SELECT * FROM `$table` WHERE email = '$email' && password ='$hasPassword'";
        $q_login = mysqli_query($this->con, $q_select_users);

        while ($result = mysqli_fetch_assoc($q_login)) {
            $dataLogin[] = $result;
        }

        if (isset($dataLogin)) {
            return $dataLogin;
        } else {
            return "false";
        }
    }

    public function select($table, $row, $value, $where = true, $row_where)
    {
        if ($where === true) {
            $q_select_users = "SELECT $row FROM `$table` WHERE $row_where='$value'";
            $q_login = mysqli_query($this->con, $q_select_users);

            while ($result = mysqli_fetch_assoc($q_login)) {
                $dataLogin[] = $result;
            }

            if (isset($dataLogin)) {
                return $dataLogin;
            } else {
                return "false";
            }
        } else {
            $q_select_users = "SELECT $row FROM `$table`";
            $q_login = mysqli_query($this->con, $q_select_users);

            while ($result = mysqli_fetch_assoc($q_login)) {
                $dataLogin[] = $result;
            }

            if (isset($dataLogin)) {
                return $dataLogin;
            } else {
                return "false";
            }
        }
    }

    public function register($table, $rows = [], $values = [], $email)
    {

        foreach ($values as $val) {
            $valuesVal[] = "'$val'";
        }

        foreach ($rows as $rowVal) {
            $rowsVal[] = "$rowVal";
        }

        $row = implode(",", $rowsVal);
        $value = implode(",", $valuesVal);

        $selectUsers = "SELECT * FROM `users`";
        $q_selectUsers = mysqli_query($this->con, $selectUsers);
        while ($result = mysqli_fetch_assoc($q_selectUsers)) {
            $dataUsers[] = $result;
        }
        if (empty($dataUsers)) {
            $q_select_users = "INSERT INTO `$table` ($row) VALUES($value)";
            mysqli_query($this->con, $q_select_users);
        } else {
            $emails = [];
            foreach ($dataUsers as $user) {
                $emails[] = $user["email"];
            }

            if (in_array($email, $emails)) {
                return "your email in our database";
            } else {
                $q_select_users = "INSERT INTO `$table` ($row) VALUES($value)";
                mysqli_query($this->con, $q_select_users);
                return "uploaded";
            }
        }
    }
    public function insert($table, $rows = [], $values = [])
    {
        foreach ($values as $val) {
            $valuesVal[] = "'$val'";
        }

        foreach ($rows as $rowVal) {
            $rowsVal[] = "`$rowVal`";
        }

        $row = implode(",", $rowsVal);
        $value = implode(",", $valuesVal);

        $q_insert = "INSERT INTO `$table` ($row) VALUES($value)";
        mysqli_query($this->con, $q_insert);
    }

    public function update($table, $rows = [], $values = [], $id)
    {
        foreach ($values as $val) {
        }

        foreach ($rows as $rowVal) {
            $rowsVal[] = "`$rowVal` = ";
        }

        foreach ($values as $valueVal) {
            $rowsVal[] = "'$valueVal'";
        }

        $row = implode(" ", $rowsVal);
        $q_update = "UPDATE `$table` SET $row WHERE id=$id";
        mysqli_query($this->con, $q_update);
        // return $q_update;
    }

    public function delete($table, $id)
    {
        $q_delete = "DELETE FROM `$table` WHERE id=$id";
        mysqli_query($this->con, $q_delete);
    }
    public function getLastInsertedID($table)
    {
        $q_lastInsert = "SELECT id FROM `$table` ORDER BY id DESC LIMIT 1";
        $q_last = mysqli_query($this->con, $q_lastInsert);
        while ($result = mysqli_fetch_assoc($q_last)) {
            $data[] = $result;
        }
        return $data;
    }
    public function closeConnection()
    {
        mysqli_close($this->con);
    }
}
