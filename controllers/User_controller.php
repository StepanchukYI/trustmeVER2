<?php
session_start();
require "../model/User.php";
include_once("../class/Samfuu.php");

extract($_REQUEST);

$User = new User();

switch (@$command) {
    case "multi_view_users"://Полный список пользователей
        $response = $User->Multi_view_users(@$_SESSION['user_id']);
        break;
    case "multi_view_friends"://Полный список друзей
        $response = $User->Multi_view_friends(@$_SESSION['user_id']);
        break;
    /*case "multi_view_friends_online"://Полный список друзей онлайн
        $response = $User->Multi_view_friends_online($_SESSION['user_id']);
        break;*/
    case "multi_view_requests_input"://Полный список заявок в друзья входящих
        $response = $User->Multi_view_requests_input(@$_SESSION['user_id']);
        break;
    case "multi_view_requests_output"://Полный список заявок в друзья исходящих
        $response = $User->Multi_view_requests_output(@$_SESSION['user_id']);
        break;
    /*case "search"://Поиск
        $query = $_REQUEST['query'];
        $response = $User->Search($_SESSION['user_id'], $query);
        break;*/
    case "single_view_user"://Посмотреть полную информацию о пользователе
        $response = $User->Single_view_user(@$_SESSION['user_id'], @$user_id_select);
        break;
    case "friendship_request"://Отправка заявки
        $response = $User->Friendship_request(@$_SESSION['user_id'], @$user_id_friend);
        break;
    case "friendship_cancel"://Удаление из друзей
        $response = $User->Friendship_cancel(@$_SESSION['user_id'], @$user_id_friend);
        break;
    case "friendship_request_agree"://Подтверждение заявки
        $response = $User->Friendship_request_agree(@$_SESSION['user_id'], @$user_id_friend);
        break;
    case "friendship_request_cancel"://Удаление из списка заявок
        $response = $User->Friendship_request_cancel(@$_SESSION['user_id'], @$user_id_friend);
        break;
    default:
        $response = "Incorrect command";
        break;
}
logging(@$_SESSION['user_id'] . " " . @$query . " " . @$user_id_select . " " . @$user_id_friend, json_encode($response), @$command);
if (gettype($response) == "string") {
    $request = array('error' => $response);
    echo json_encode($request);
} else {
    echo json_encode($response);
}

/*
 * http://localhost/trustme/controllers/User_controller.php?command=Multi_View_Users&user_id=1
 * http://localhost/trustme/controllers/User_controller.php?command=Single_View_User&user_id=1&user_id_select=2
 * http://localhost/trustme/controllers/User_controller.php?command=Multi_View_friends&user_id=1
 * http://localhost/trustme/controllers/User_controller.php?command=Multi_View_Requests&user_id=1
 * http://localhost/trustme/controllers/User_controller.php?command=Search&user_id=1&query=zafezfe
 * http://localhost/trustme/controllers/User_controller.php?command=Friendship&user_id=1&user_id_friend=2
 * http://localhost/trustme/controllers/User_controller.php?command=Friendship_Cancel&user_id=1&user_id_friend=2
*/