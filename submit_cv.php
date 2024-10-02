<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Basic validation
    if (empty($_POST["name"]) || empty($_POST["email"]) || empty($_FILES["cv"]["name"])) {
        die("Please fill all the required fields.");
    }

    // Validate email
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    $uploadDir = "uploads/";
    $uploadFile = $uploadDir . basename($_FILES["cv"]["name"]);
    $fileType = strtolower(pathinfo($uploadFile,PATHINFO_EXTENSION));

    // Check if file is a PDF
    if ($fileType != "pdf") {
        die("Only PDF files are allowed.");
    }

    // Attempt to upload file
    if (move_uploaded_file($_FILES["cv"]["tmp_name"], $uploadFile)) {
        // Here, you'd typically insert data into a database. This example writes to a file.
        $data = "Name: " . $_POST["name"] . "\nEmail: " . $_POST["email"] . "\nEducation: " . $_POST["education"] . "\nExperience: " . $_POST["experience"] . "\nCV: " . $uploadFile . "\n---\n";
        file_put_contents("applications.txt", $data, FILE_APPEND | LOCK_EX);
        echo "The file ". htmlspecialchars( basename( $_FILES["cv"]["name"])). " has been uploaded.";
    } else {
        echo "There was an error uploading your file.";
    }
} else {
    // Not a POST request
    echo "Invalid request.";
}
?>
