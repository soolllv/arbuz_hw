<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
    

    include_once '../../config/Database.php';
    include_once '../../models/Watermelon.php';

    // Instatiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //
    $watermelon = new Watermelon($db);

    // Get raw data
    $data = json_decode(file_get_contents("php://input"));
    
    $watermelon->is_ripe = $data->is_ripe;
    $watermelon->mass = $data->mass;
    $watermelon->quantity = $data->quantity;
    $watermelon->is_collected = $data->is_collected;
    $watermelon->row = $data->row;

    // Set ID to update
    $watermelon->id = $data->id;
        
    //Updata a new watermelon ;)
    if($watermelon->update_wm()){
        echo json_encode(
            array('message' => 'Post Updated')
        );
    } else {
        echo json_encode(
            array('message' => 'Post Not Updated')
        );
    }

    
