<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Watermelon.php';

    // Instatiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //
    $watermelon = new Watermelon($db);

    // GET ID
    $watermelon->row = isset($_GET['row']) ? $_GET['row'] : die();

    // GET WATERMELONS ROW
    $res = $watermelon->read_row();
    $num = $res->rowCount();

    //
    if($num > 0){
        $wm_arr = array();
        $wm_arr['data'] = array();

        while($rows = $res->fetch(PDO::FETCH_ASSOC)){
            extract($rows);
            
            $wm = array(
                'is_ripe' => $is_ripe,
                'mass' => $mass,
                'quantity' => $quantity,
                'is_collected' => $is_collected,
                'row' => $row,
                'id' => $id
            );
            
            // Push to "data"
            array_push($wm_arr['data'], $wm);
        }

        // Turn to json and output
        echo json_encode($wm_arr);
    } else {
        //No watermelons
        echo json_encode(
            array('message' => 'No Posts Found')
        );
    }

