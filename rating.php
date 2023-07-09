<?php
include_once("./conn.php");

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['rating']) == "done") {
    $ratevalue = mysqli_real_escape_string($conn, $_POST['ratevalue']);
    $review_email = mysqli_real_escape_string($conn, $_POST['review_email']);

    if (empty($review_email)) {
        $res = array(
            "error" => 5,
            "error_message" => "Please write your email!"
        );
        exit(json_encode($res));
    } elseif (!filter_var($review_email, FILTER_VALIDATE_EMAIL)) {
        $res = array(
            "error" => 5,
            "error_message" => "Invalid email address!"
        );
        exit(json_encode($res));
    } elseif (substr($review_email, -10) !== "@gmail.com") {
        $res = array(
            "error" => 5,
            "error_message" => "Please write your gmail address!"
        );
        exit(json_encode($res));
    } elseif ($ratevalue <= 0) {
        $res = array(
            "error" => 1,
            "error_message" => "Please select your ratings!"
        );
        exit(json_encode($res));
    } elseif ($ratevalue >= 6) {
        $res = array(
            "error" => 2,
            "error_message" => "The value of ratings cannot be more than 5!"
        );
        exit(json_encode($res));
    } else {
        $insertRating = $conn->query("INSERT INTO `ratings` (`value`,`gmail`) VALUES ($ratevalue , '$review_email')");

        if (!$insertRating) {
            $res = array(
                "error" => 3,
                "error_message" => "Your ratings can't submitted!"
            );
            exit(json_encode($res));
        } else {
            $res = array(
                "error" => 4,
                "error_message" => "Thanks for your ratings!"
            );
            exit(json_encode($res));
        }
    }
}
