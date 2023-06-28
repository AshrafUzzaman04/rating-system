<?php
$servername  = "localhost";
$username = "root";
$password = "";
$database = "review";

$conn = mysqli_connect($servername, $username, $password, $database);
function sefuda($data)
{
    $data = htmlspecialchars($data);
    $data = trim($data);
    $data = stripslashes($data);
    return $data;
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['rating']) == "done") {
    $ratevalue = mysqli_real_escape_string($conn, $_POST['ratevalue']);

    if ($ratevalue <= 0) {
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
        $insertRating = $conn->query("INSERT INTO `ratings` (`value`) VALUES ($ratevalue)");

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
