<?php
/**
 * Created by PhpStorm.
 * User: konstantin
 * Date: 24.01.2018
 * Time: 17:22
 */

require_once 'core/pdo.php';
require_once 'core/model.php';
require_once 'core/view.php';
require_once 'core/controller.php';
require_once 'core/route.php';
require_once 'core/Member.php';
require_once 'core/Auth.php';

Route::start($pdo); // запускаем маршрутизатор