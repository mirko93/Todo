<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL);

include_once 'Database.php';

class Tasks
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getPost()
    {
        $this->db->query("SELECT * FROM tasks ORDER BY created_at DESC");

        $results = $this->db->resultSet();

        return $results;
    }

    public function createNewPost($title)
    {
        $this->db->query('INSERT INTO tasks (title) VALUES (:title)');
        $this->db->bind(':title', $title);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deletePost($id)
    {
        $this->db->query('DELETE FROM tasks WHERE id = :id');
        $this->db->bind(":id", $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
