<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 22.01.2018
 * Time: 18:18
 */

$pdo = new PDO('mysql:host=localhost;dbname=fb_api;charset=utf8;', 'root', '9817ffbaa6f401c4357922aa3b00e995698d59b610705263');

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);