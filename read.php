<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files

include_once '../config/database.php';
include_once '../object/product.php';
//include_once 'database.php';
//include_once 'product.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$product = new Product($db);
 
// query products
$stmt = $product->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $products_arr=array();
    $products_arr["products"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $product_item=array(
            "prod_srno" => $prod_srno,
            "prod_name" => $prod_name,
            "prod_price" => $prod_price,
            "prod_lotno" => $prod_lotno,
            "Prod_added_datetime" => $Prod_added_datetime
        );
 
        array_push($products_arr["products"], $product_item);
		//var_dump($product_item);	
		
    }
	
    $json=json_encode($products_arr);
	echo $json;
}
 
else{
    echo json_encode(
        array("message" => "No products found.")
    );
}
?>