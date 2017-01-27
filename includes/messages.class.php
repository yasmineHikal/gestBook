<?php


class messages
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
     * add new message
     * @param $title
     * @param $content
     * @param $name
     * @param $email
     * @return bool
     */
    public function addMessage($title,$content,$name,$email)
    {
        $this->connection->query("INSERT INTO `messages`(`title`, `content`,`name`, `email`) VALUES ('$title','$content','$name','$email')");

        if($this->connection->affected_rows>0)
            return true;

        echo $this->connection->error;
        return false;
    }


    /**
     * update message
     * @param $id
     * @param $title
     * @param $content
     * @param $name
     * @param $email
     * @return bool
     */
    public function updateMessage($id,$title,$content)
    {
        $sql = "UPDATE `messages` SET `title`='$title',`content`='$content'";

        $this->connection->query($sql);

        if($this->connection->affected_rows>0)
            return true;

        return false;
    }


    /**
     * delete message
     * @param $id
     * @return bool
     */
    public function deleteMessage($id)
    {
        $this->connection->query("DELETE FROM `messages` WHERE `id`=$id");

        if($this->connection->affected_rows>0)
            return true;

        return false;
    }


    /**
     * get all messages
     * @return array|null
     */
    public function getMessages($extra='')
    {
        $result = $this->connection->query("SELECT * FROM `messages` $extra");

        if($result->num_rows>0)
        {
            $messages = array();

            while($row = $result->fetch_assoc())
            {
                $messages[] = $row;
            }
            return $messages;
        }

        return null;
    }


    /**
     * get message by id
     * @param $id
     * @return null
     */
    public function getMessage($id)
    {
        $messages = $this->getMessages("WHERE `id`=$id");

        if($messages && count($messages)>0)
            return $messages[0];

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