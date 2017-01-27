<?php

class users
{
    private $connection;

    /**
     * create connection
     */
    public function __construct()
    {
        $this->connection = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    }


    /**
     * add new user
     * @param $username
     * @param $password
     * @param $email
     * @return bool
     */
    public function addUser($username,$password,$email)
    {
       $this->connection->query("INSERT INTO `users`(`username`, `password`, `email`) VALUES ('$username','$password','$email')");

        if($this->connection->affected_rows>0)
            return true;

        echo $this->connection->error;
        return false;
    }


    /**
     * update user
     * @param $id
     * @param $username
     * @param $password
     * @param $email
     * @return bool
     */
    public function updateUser($id,$username,$password,$email)
    {
        $sql = "UPDATE `users` SET ";

        if(strlen($username)>0)
            $sql .= "`username`='$username'";

        if(strlen($password)>0)
            $sql .= ",`password`='$password'";

        if(strlen($email)>0)
            $sql .= ",`email`='$email'";

        $sql .= " WHERE `id`=$id";


        $this->connection->query($sql);

        if($this->connection->affected_rows>0)
            return true;

        return false;
    }


    /**
     * delete user
     * @param $id
     * @return bool
     */
    public function deleteUser($id)
    {
        $this->connection->query("DELETE FROM `users` WHERE `id`=$id");

        if($this->connection->affected_rows>0)
            return true;

        return false;
    }


    /**
     * get all users
     * @return array|null
     */
    public function getUsers($extra='')
    {
        $result = $this->connection->query("SELECT * FROM `users` $extra");

        if($result->num_rows>0)
        {
            $users = array();

            while($row = $result->fetch_assoc())
            {
                $users[] = $row;
            }
            return $users;
        }

        return null;
    }


    /**
     * get user by id
     * @param $id
     * @return null
     */
    public function getUser($id)
    {
        $users = $this->getUsers("WHERE `id`=$id");

        if($users && count($users)>0)
            return $users[0];

        return null;
    }


    /**
     * login users
     * @param $username
     * @param $password
     * @return null
     */
    public function login($username,$password)
    {
        $users = $this->getUsers("WHERE `username`='$username' AND `password`='$password'");

        if($users && count($users)>0)
            return $users[0];

        return null;

    }

    /**
     * close connection
     */
    public function __destruct()
    {
        $this->connection->close();
    }
}