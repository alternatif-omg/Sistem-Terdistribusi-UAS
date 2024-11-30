<?php
// Include database connection file
require_once 'database.php';

// Set the appropriate content type
header("Content-Type: application/json");

// Check the request method and handle the endpoint accordingly
$requestMethod = $_SERVER['REQUEST_METHOD'];
$endpoint = isset($_GET['type']) ? $_GET['type'] : '';

switch ($requestMethod) {
    case 'GET':
        if ($endpoint == 'students') {
            getStudents();
        } elseif ($endpoint == 'registrations') {
            getRegistrations();
        } elseif ($endpoint == 'Activities') {
            getActivities();
        } elseif ($endpoint == 'attendance') {
            getAttendance();
        }
        break;
    case 'POST':
        if ($endpoint == 'students') {
            createStudent();
        } elseif ($endpoint == 'registrations') {
            createRegistration();
        } elseif ($endpoint == 'Activities') {
            createActivity();
        } elseif ($endpoint == 'attendance') {
            createAttendance();
        }
        break;
    case 'PUT':
        if ($endpoint == 'students') {
            updateStudent();
        } elseif ($endpoint == 'registrations') {
            updateRegistration();
        } elseif ($endpoint == 'Activities') {
            updateActivity();
        } elseif ($endpoint == 'attendance') {
            updateAttendance();
        }
        break;
    case 'DELETE':
        if ($endpoint == 'students') {
            deleteStudent();
        } elseif ($endpoint == 'registrations') {
            deleteRegistration();
        } elseif ($endpoint == 'Activities') {
            deleteActivity();
        } elseif ($endpoint == 'attendance') {
            deleteAttendance();
        }
        break;
    default:
        header("HTTP/1.1 405 Method Not Allowed");
        echo json_encode(["message" => "Method Not Allowed"]);
        break;
}

// --- CRUD for Students ---
function getStudents() {
    $db = getConnection();
    $sql = "SELECT * FROM students";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($students);
}

function createStudent() {
    $data = json_decode(file_get_contents('php://input'), true);
    if (empty($data['student_id']) || empty($data['name']) || empty($data['class']) || empty($data['contact']) || empty($data['birth_date'])) {
        header("HTTP/1.1 400 Bad Request");
        echo json_encode(["message" => "All fields are required"]);
        return;
    }

    $db = getConnection();
    $sql = "INSERT INTO students (student_id, name, class, contact, birth_date) VALUES (?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    try {
        $stmt->execute([$data['student_id'], $data['name'], $data['class'], $data['contact'], $data['birth_date']]);
        echo json_encode(["message" => "Student created successfully"]);
    } catch (PDOException $e) {
        header("HTTP/1.1 500 Internal Server Error");
        echo json_encode(["message" => $e->getMessage()]);
    }
}

function updateStudent() {
    if (!isset($_GET['id'])) {
        header("HTTP/1.1 400 Bad Request");
        echo json_encode(["message" => "Student ID is required"]);
        return;
    }

    $data = json_decode(file_get_contents('php://input'), true);
    if (empty($data['name']) || empty($data['class']) || empty($data['contact']) || empty($data['birth_date'])) {
        header("HTTP/1.1 400 Bad Request");
        echo json_encode(["message" => "All fields are required"]);
        return;
    }

    $db = getConnection();
    $sql = "UPDATE students SET name = ?, class = ?, contact = ?, birth_date = ? WHERE student_id = ?";
    $stmt = $db->prepare($sql);
    try {
        $stmt->execute([$data['name'], $data['class'], $data['contact'], $data['birth_date'], $_GET['id']]);
        echo json_encode(["message" => "Student updated successfully"]);
    } catch (PDOException $e) {
        header("HTTP/1.1 500 Internal Server Error");
        echo json_encode(["message" => $e->getMessage()]);
    }
}

function deleteStudent() {
    if (!isset($_GET['id'])) {
        header("HTTP/1.1 400 Bad Request");
        echo json_encode(["message" => "Student ID is required"]);
        return;
    }

    $db = getConnection();
    $sql = "DELETE FROM students WHERE student_id = ?";
    $stmt = $db->prepare($sql);
    try {
        $stmt->execute([$_GET['id']]);
        echo json_encode(["message" => "Student deleted successfully"]);
    } catch (PDOException $e) {
        header("HTTP/1.1 500 Internal Server Error");
        echo json_encode(["message" => $e->getMessage()]);
    }
}

// --- CRUD for Registrations ---
function getRegistrations() {
    $db = getConnection();
    $sql = "SELECT registrations.*, 
                   students.name AS student_name, 
                   Activities.name AS activity_name 
            FROM registrations 
            JOIN students ON registrations.student_id = students.student_id 
            JOIN Activities ON registrations.activity_id = Activities.activity_id";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $registrations = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($registrations);
}

function createRegistration() {
    $data = json_decode(file_get_contents('php://input'), true);
    if (empty($data['student_id']) || 
        empty($data['activity_id']) || 
        empty($data['registration_date']) || 
        empty($data['position']) || 
        !isset($data['registration_fee']) || 
        empty($data['confirmation_status'])) {
        header("HTTP/1.1 400 Bad Request");
        echo json_encode(["message" => "All fields are required"]);
        return;
    }

    $db = getConnection();
    $sql = "INSERT INTO registrations (student_id, activity_id, registration_date, position, registration_fee, confirmation_status) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    try {
        $stmt->execute([
            $data['student_id'], 
            $data['activity_id'], 
            $data['registration_date'], 
            $data['position'], 
            $data['registration_fee'], 
            $data['confirmation_status']
        ]);
        echo json_encode(["message" => "Registration created successfully"]);
    } catch (PDOException $e) {
        header("HTTP/1.1 500 Internal Server Error");
        echo json_encode(["message" => $e->getMessage()]);
    }
}

function updateRegistration() {
    if (!isset($_GET['id'])) {
        header("HTTP/1.1 400 Bad Request");
        echo json_encode(["message" => "Registration ID is required"]);
        return;
    }

    $data = json_decode(file_get_contents('php://input'), true);
    if (empty($data['student_id']) || 
        empty($data['activity_id']) || 
        empty($data['registration_date']) || 
        empty($data['position']) || 
        !isset($data['registration_fee']) || 
        empty($data['confirmation_status'])) {
        header("HTTP/1.1 400 Bad Request");
        echo json_encode(["message" => "All fields are required"]);
        return;
    }

    $db = getConnection();
    $sql = "UPDATE registrations 
            SET student_id = ?, 
                activity_id = ?, 
                registration_date = ?, 
                position = ?, 
                registration_fee = ?, 
                confirmation_status = ? 
            WHERE registration_id = ?";
    $stmt = $db->prepare($sql);
    try {
        $stmt->execute([
            $data['student_id'], 
            $data['activity_id'], 
            $data['registration_date'], 
            $data['position'], 
            $data['registration_fee'], 
            $data['confirmation_status'], 
            $_GET['id']
        ]);
        echo json_encode(["message" => "Registration updated successfully"]);
    } catch (PDOException $e) {
        header("HTTP/1.1 500 Internal Server Error");
        echo json_encode(["message" => $e->getMessage()]);
    }
}

function deleteRegistration() {
    if (!isset($_GET['id'])) {
        header("HTTP/1.1 400 Bad Request");
        echo json_encode(["message" => "Registration ID is required"]);
        return;
    }

    $db = getConnection();
    $sql = "DELETE FROM registrations WHERE registration_id = ?";
    $stmt = $db->prepare($sql);
    try {
        $stmt->execute([$_GET['id']]);
        echo json_encode(["message" => "Registration deleted successfully"]);
    } catch (PDOException $e) {
        header("HTTP/1.1 500 Internal Server Error");
        echo json_encode(["message" => $e->getMessage()]);
    }
}


// --- CRUD for Activities ---
function getActivities() {
    $db = getConnection();
    $sql = "SELECT * FROM Activities";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $activities = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($activities);
}

function createActivity() {
    $data = json_decode(file_get_contents('php://input'), true);
    if (empty($data['activity_id']) || empty($data['name']) || empty($data['description']) || empty($data['schedule']) || empty($data['instructor'])) {
        header("HTTP/1.1 400 Bad Request");
        echo json_encode(["message" => "All fields are required"]);
        return;
    }

    $db = getConnection();
    $sql = "INSERT INTO Activities (activity_id, name, description, schedule, instructor) VALUES (?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    try {
        $stmt->execute([$data['activity_id'], $data['name'], $data['description'], $data['schedule'], $data['instructor']]);
        echo json_encode(["message" => "Activity created successfully"]);
    } catch (PDOException $e) {
        header("HTTP/1.1 500 Internal Server Error");
        echo json_encode(["message" => $e->getMessage()]);
    }
}

function updateActivity() {
    if (!isset($_GET['id'])) {
        header("HTTP/1.1 400 Bad Request");
        echo json_encode(["message" => "Activity ID is required"]);
        return;
    }

    $data = json_decode(file_get_contents('php://input'), true);
    if (empty($data['name']) || empty($data['description']) || empty($data['schedule']) || empty($data['instructor'])) {
        header("HTTP/1.1 400 Bad Request");
        echo json_encode(["message" => "All fields are required"]);
        return;
    }

    $db = getConnection();
    $sql = "UPDATE Activities SET name = ?, description = ?, schedule = ?, instructor = ? WHERE activity_id = ?";
    $stmt = $db->prepare($sql);
    try {
        $stmt->execute([$data['name'], $data['description'], $data['schedule'], $data['instructor'], $_GET['id']]);
        echo json_encode(["message" => "Activity updated successfully"]);
    } catch (PDOException $e) {
        header("HTTP/1.1 500 Internal Server Error");
        echo json_encode(["message" => $e->getMessage()]);
    }
}

function deleteActivity() {
    if (!isset($_GET['id'])) {
        header("HTTP/1.1 400 Bad Request");
        echo json_encode(["message" => "Activity ID is required"]);
        return;
    }

    $db = getConnection();
    $sql = "DELETE FROM Activities WHERE activity_id = ?";
    $stmt = $db->prepare($sql);
    try {
        $stmt->execute([$_GET['id']]);
        echo json_encode(["message" => "Activity deleted successfully"]);
    } catch (PDOException $e) {
        header("HTTP/1.1 500 Internal Server Error");
        echo json_encode(["message" => $e->getMessage()]);
    }
}

// --- CRUD for Attendance ---
function getAttendance() {
    $db = getConnection();
    $sql = "SELECT attendance.*, 
                   students.name AS student_name, 
                   Activities.name AS activity_name 
            FROM attendance 
            JOIN students ON attendance.student_id = students.student_id 
            JOIN Activities ON attendance.activity_id = Activities.activity_id";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $attendance = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($attendance);
}

function createAttendance() {
    $data = json_decode(file_get_contents('php://input'), true);
    if (empty($data['student_id']) || 
        empty($data['activity_id']) || 
        empty($data['attendance_date']) || 
        empty($data['status']) || 
        empty($data['check_in_time']) || 
        empty($data['notes'])) {
        header("HTTP/1.1 400 Bad Request");
        echo json_encode(["message" => "All fields are required"]);
        return;
    }

    $db = getConnection();
    $sql = "INSERT INTO attendance (student_id, activity_id, attendance_date, status, check_in_time, notes) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    try {
        $stmt->execute([
            $data['student_id'], 
            $data['activity_id'], 
            $data['attendance_date'], 
            $data['status'], 
            $data['check_in_time'], 
            $data['notes']
        ]);
        echo json_encode(["message" => "Attendance created successfully"]);
    } catch (PDOException $e) {
        header("HTTP/1.1 500 Internal Server Error");
        echo json_encode(["message" => $e->getMessage()]);
    }
}

function updateAttendance() {
    if (!isset($_GET['id'])) {
        header("HTTP/1.1 400 Bad Request");
        echo json_encode(["message" => "Attendance ID is required"]);
        return;
    }

    $data = json_decode(file_get_contents('php://input'), true);
    if (empty($data['student_id']) || 
        empty($data['activity_id']) || 
        empty($data['attendance_date']) || 
        empty($data['status']) || 
        empty($data['check_in_time']) || 
        empty($data['notes'])) {
        header("HTTP/1.1 400 Bad Request");
        echo json_encode(["message" => "All fields are required"]);
        return;
    }

    $db = getConnection();
    $sql = "UPDATE attendance 
            SET student_id = ?, 
                activity_id = ?, 
                attendance_date = ?, 
                status = ?, 
                check_in_time = ?, 
                notes = ? 
            WHERE attendance_id = ?";
    $stmt = $db->prepare($sql);
    try {
        $stmt->execute([
            $data['student_id'], 
            $data['activity_id'], 
            $data['attendance_date'], 
            $data['status'], 
            $data['check_in_time'], 
            $data['notes'], 
            $_GET['id']
        ]);
        echo json_encode(["message" => "Attendance updated successfully"]);
    } catch (PDOException $e) {
        header("HTTP/1.1 500 Internal Server Error");
        echo json_encode(["message" => $e->getMessage()]);
    }
}

function deleteAttendance() {
    if (!isset($_GET['id'])) {
        header("HTTP/1.1 400 Bad Request");
        echo json_encode(["message" => "Attendance ID is required"]);
        return;
    }

    $db = getConnection();
    $sql = "DELETE FROM attendance WHERE attendance_id = ?";
    $stmt = $db->prepare($sql);
    try {
        $stmt->execute([$_GET['id']]);
        echo json_encode(["message" => "Attendance deleted successfully"]);
    } catch (PDOException $e) {
        header("HTTP/1.1 500 Internal Server Error");
        echo json_encode(["message" => $e->getMessage()]);
    }
}

