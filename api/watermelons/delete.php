<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
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
    
    // Set ID to update
    $watermelon->id = $data->id;
        
    //Updata a new watermelon ;)
    if($watermelon->delete()){
        echo json_encode(
            array('message' => 'Post Deleted')
        );
    } else {
        echo json_encode(
            array('message' => 'Post Not Deleted')
        );
    }

    
