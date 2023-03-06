<?php

class Config
{
    public $HOST = "127.0.0.1";
    public $USERNAME = "root";
    public $PASSWORD = "";
    public $DB_NAME = "libryry_management_system";

    public $table_name = "books";
    public $table_user = "books";
    public $conn;
    public function connect()
    {
        $this->conn = mysqli_connect($this->HOST, $this->USERNAME, $this->PASSWORD, $this->DB_NAME);
    }

    public function insert_recode($book_name, $author_name, $price, $publication_year, $language, $image)
    {
        $this->connect();
        $query = "INSERT INTO $this->table_name (book_name,author_name,price,publication_year,language,image)VALUES('$book_name', '$author_name', $price, $publication_year,'$language','$image');";

        $res = mysqli_query($this->conn, $query);

        return $res;

    }
    public function fetch_recode()
    {
        $this->connect();
        $query = "SELECT * FROM $this->table_name;";

        $res = mysqli_query($this->conn, $query);

        return $res;

    }
    public function fetch_single_recode($id)
    {
        $this->connect();
        $query = "SELECT * FROM $this->table_name WHERE id=$id;";

        $res = mysqli_query($this->conn, $query); //sqli_result object

        return $res;

    }

    public function delete($id)
    {
        $this->connect();
        $fetched_res = $this->fetch_single_recode($id);
        $recode      = mysqli_fetch_array($fetched_res);
        if ($recode) {
            $filename = "../admin_panel/store/" . $recode['image'];

            unlink($filename);
            $query = "DELETE FROM $this->table_name WHERE id=$id;";

            $res = mysqli_query($this->conn, $query); //int 

            return $res;

        } else {
            false;
        }

    }

    public function update($id, $book_name, $author_name, $price, $publication_year, $language, $image)
    {
        $this->connect();
        $fetched_res = $this->fetch_single_recode($id);
        $recode      = mysqli_fetch_array($fetched_res);
        if ($recode) {

            $filename = "../admin_panel/store/" . $recode['image'];

            unlink($filename);


            $query = "UPDATE $this->table_name SET book_name='$book_name',author_name='$author_name',price=$price,publication_year=$publication_year,language='$language',image='$image' WHERE id=$id;";

            $res = mysqli_query($this->conn, $query); //int 

            return $res;
        } else {
            return false;
        }

    }

    public function register_user($username, $email, $password)
    {
        $encrypted_password = password_hash($password, PASSWORD_DEFAULT);
        $this->connect();
        $query  = "SELECT * FROM $this->table_user WHERE username='$username' OR email='$email';";
        $res    = mysqli_query($this->conn, $query);
        $recode = mysqli_fetch_array($res);
        if ($recode) {
            return false;
        } else {


            $query = "INSERT INTO $this->table_user (username,email,password)VALUES('$username','$email','$encrypted_password');";

            $res = mysqli_query($this->conn, $query);

            return $res;
        }

    }

    public function login_user($username, $email, $password)
    {
        $this->connect();
        $query   = "SELECT * FROM $this->table_user WHERE email='$email' ;";
        $res     = mysqli_query($this->conn, $query);
        $rescode = mysqli_fetch_assoc($res);

        if ($rescode) {
            $is_verified = password_verify($password, $rescode['password']);

            return $is_verified;
        } else {
            return false;
        }

    }
}

?>