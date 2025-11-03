<?php
// 1. Database connection settings
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "Travel"; // Corrected database name: Travel

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    // Agar connection fail ho toh error de
    die("Connection failed: " . $conn->connect_error);
}

// 2. Insert Operation using Prepared Statements
if (isset($_POST['submit_btn'])) {
    
    // Get form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    // 3. Prepared Statement for Security
    // Table name yahan 'contacts' se 'contact_form' karna hai, jo table humne banayi hai
    $stmt = $conn->prepare("INSERT INTO contact_form (username, email, phone, message) VALUES (?, ?, ?, ?)");
    
    // Bind parameters to the statement
    // "ssss" means all four values are strings
    $stmt->bind_param("ssss", $username, $email, $phone, $message);

    // Execute the statement
    if ($stmt->execute()) {
        // Data successfully inserted
        echo "<script>alert('Aapka message safaltapoorvak bhej diya gaya hai!'); window.location.href='contact.php';</script>";
    } else {
        // Error in execution
        echo "Error: " . $stmt->error;
    }
    
    // Close the statement
    $stmt->close();
}

// 4. Close connection (connection will also close at the end of script execution)
$conn->close();
?>