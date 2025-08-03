<?php
header("Content-Type: application/json");
$method = $_SERVER['REQUEST_METHOD'];
include 'db.php';

switch ($method) {
    case 'GET':
        $result = mysqli_query($conn, "SELECT * FROM users");
        $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
        echo json_encode($users);
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        $name = $data['name'];
        $email = $data['email'];
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $dob = $data['dob'];
        $sql = "INSERT INTO users (name, email, password, dob) VALUES ('$name', '$email', '$password', '$dob')";
        mysqli_query($conn, $sql);
        echo json_encode(["message" => "User created"]);
        break;

    case 'PUT':
        $data = json_decode(file_get_contents("php://input"), true);
        $id = $data['id'];
        $name = $data['name'];
        $email = $data['email'];
        $dob = $data['dob'];
        $sql = "UPDATE users SET name='$name', email='$email', dob='$dob' WHERE id=$id";
        mysqli_query($conn, $sql);
        echo json_encode(["message" => "User updated"]);
        break;

    case 'DELETE':
        $id = $_GET['id'];
        $sql = "DELETE FROM users WHERE id=$id";
        mysqli_query($conn, $sql);
        echo json_encode(["message" => "User deleted"]);
        break;
}
?>
