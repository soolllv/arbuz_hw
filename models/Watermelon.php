<?php
    class Watermelon{
        //DB stuff
        private $conn;
        private $table = 'watermelons';

        //Post Properties
        public $is_ripe;
        public $mass;
        public $quantity;
        public $is_collected;
        public $row;
        public $id;

        //Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        // Get Watermelons
        public function read() {
            // Create query
            $query = 'SELECT * FROM ' . $this->table . ' w
                    ORDER BY w.id ASC';
            
            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Execute query
            $stmt->execute();

            return $stmt;
        } 
        
        // Get only one row post
        public function read_row(){
            $query = 'SELECT * FROM ' . $this->table . ' w
                    WHERE w.row = ?';
            
            //Prepare statement
            $stmt = $this->conn->prepare($query);

            // Bind ID
            $stmt->bindParam(1, $this->row);
            
            //Execute query
            $stmt->execute();

            return $stmt;
        }

        // Add a watermelon 
        public function add_wm(){
            //Create query
            $query =  'INSERT INTO ' . $this->table . '
                SET
                    is_ripe = :is_ripe,
                    mass = :mass,
                    quantity = :quantity,
                    is_collected = :is_collected,
                    row = :row';

            $stmt = $this->conn->prepare($query);

            $this->is_ripe = htmlspecialchars(strip_tags($this->is_ripe));
            $this->mass = htmlspecialchars(strip_tags($this->mass));
            $this->quantity = htmlspecialchars(strip_tags($this->quantity));
            $this->is_collected = htmlspecialchars(strip_tags($this->is_collected));
            $this->row = htmlspecialchars(strip_tags($this->row));

            // BIND
            $stmt->bindParam(':is_ripe', $this->is_ripe);
            $stmt->bindParam(':mass', $this->mass);
            $stmt->bindParam(':quantity', $this->quantity);
            $stmt->bindParam(':is_collected', $this->is_collected);
            $stmt->bindParam(':row', $this->row);

            //
            if($stmt->execute()){
                return true;
            }
            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        // Update the watermelon 
        public function update_wm(){
            //Create query
            $query =  'UPDATE ' . $this->table . '
                SET
                    is_ripe = :is_ripe,
                    mass = :mass,
                    quantity = :quantity,
                    is_collected = :is_collected,
                    row = :row
                WHERE
                    id = :id';

            $stmt = $this->conn->prepare($query);

            $this->is_ripe = htmlspecialchars(strip_tags($this->is_ripe));
            $this->mass = htmlspecialchars(strip_tags($this->mass));
            $this->quantity = htmlspecialchars(strip_tags($this->quantity));
            $this->is_collected = htmlspecialchars(strip_tags($this->is_collected));
            $this->row = htmlspecialchars(strip_tags($this->row));
            $this->id = htmlspecialchars(strip_tags($this->id));

            // BIND
            $stmt->bindParam(':is_ripe', $this->is_ripe);
            $stmt->bindParam(':mass', $this->mass);
            $stmt->bindParam(':quantity', $this->quantity);
            $stmt->bindParam(':is_collected', $this->is_collected);
            $stmt->bindParam(':row', $this->row);
            $stmt->bindParam(':id', $this->id);

            //
            if($stmt->execute()){
                return true;
            }
            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        // Delete Post
        public function delete(){
            //Create query
            $query = 'DELETE FROM ' . $this->table . '
                    WHERE id = :id';
            // prepare statement
            $stmt = $this->conn->prepare($query);
            // Clear data
            $this->id = htmlspecialchars(strip_tags($this->id));
            // BInd
            $stmt->bindParam(':id', $this->id);
            //
            if($stmt->execute()){
                return true;
            }
            printf("Error: %s.\n", $stmt->error);

            return false;
            
        }
        
    }