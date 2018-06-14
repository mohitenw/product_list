<?php
class Product{
    // database connection and table name
    private $conn;
    private $table_name = "product";
 
    // object properties
    public $prod_srno;
    public $prod_name;    
    public $prod_price;
    public $prod_lotno;
    public $prod_added_datetime;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
		// read products
		function read(){
		 
			// select all query
			$query = "SELECT * FROM $this->table_name";		 
			
			// prepare query statement
			$stmt = $this->conn->prepare($query);
		 
			// execute query
			$stmt->execute();
			return $stmt;
		}
		
				// create product
				function create(){
			 
				// query to insert record
				$query = "INSERT INTO
							" . $this->table_name . "
						SET
							prod_name=:prod_name, prod_price=:prod_price,prod_lotno=:prod_lotno,Prod_added_datetime=:Prod_added_datetime";
			 
				// prepare query
				$stmt = $this->conn->prepare($query);
			 
				// sanitize
				$this->prod_name=htmlspecialchars(strip_tags($this->prod_name));
				$this->prod_price=htmlspecialchars(strip_tags($this->prod_price));
				$this->prod_lotno=htmlspecialchars(strip_tags($this->prod_lotno));
				$this->Prod_added_datetime=htmlspecialchars(strip_tags($this->Prod_added_datetime));
			 
				// bind values
				$stmt->bindParam(":prod_name", $this->name);
				$stmt->bindParam(":prod_price", $this->price);
				$stmt->bindParam(":prod_lotno", $this->prod_lotno);
				$stmt->bindParam(":Prod_added_datetime", $this->Prod_added_datetime);
			 
				// execute query
				if($stmt->execute()){
					return true;
				}
			 
				return false;
				 
			}
		
}