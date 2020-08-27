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

        // Get Single Post
        public function read_single_domain() {
            $query = 'SELECT * FROM ' . $this->table .'
             WHERE id = ?
             LIMIT 0,1';

            // Prepare statement
            $stmt = $this->conn->prepare($query);
            // Bind ID
            $stmt->bindParam(1, $this->id);
            // Execute query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set properties
            $this->domain = $row['domain'];
            $this->panel = $row['panel'];
            $this->isHosting = $row['isHosting'];
            $this->isDomain = $row['isDomain'];
            $this->serverNS1 = $row['serverNS1'];
            $this->serverNS2 = $row['serverNS2'];
            $this->serverNS3 = $row['serverNS3'];
            $this->serverNS4 = $row['serverNS4'];


        }
    }