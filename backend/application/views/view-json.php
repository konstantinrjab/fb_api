<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 24.01.2018
 * Time: 17:33
 */

header('Content-Type: application/json');
http_response_code($status_code);

echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);