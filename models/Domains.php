<?php
    class Domains {

        private $conn;
        private $table = 'domains';

        public $id;
        public $domain;
        public $panel;
        public $isHosting;
        public $isDomain;
        public $serverNS1;
        public $serverNS2;
        public $serverNS3;
        public $serverNS4;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function read() {
        // Create query
            $query = 'SELECT * FROM ' . $this->table .'' ;


        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
        }
    }