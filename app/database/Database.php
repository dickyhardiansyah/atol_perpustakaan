<?php

class Database {
    var $link;
    var $stmt;
    var $result;
    
    public function __construct() {
        $this->link = new mysqli('localhost', 'root', '', '10116167_perpustakaan');
    }

    public function execute($query) {
        $this->result = $this->link->query($query);
        return $this;
    }

    public function prepareAndExecute($query, $dType, ...$value) {
        $this->stmt = $this->link->prepare($query);
        $this->stmt->bind_param($dType, ...$value);
        $this->stmt->execute();
        return $this->stmt;
    }

    public function close() {
        if ($this->stmt) {
            $this->stmt->close();
        }
        if ($this->result) {
            $this->result->free();
        }
        $this->link->close();
    }

    public function fetchAssoc() {
        return $this->result->fetch_assoc();
    }
}