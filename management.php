<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);
    
    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }
    
    // Compose the email
    $to = "admin@example.com"; // Replace with your email address
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    
    $email_subject = "Contact Form Submission: $subject";
    $email_body = "<p><strong>Name:</strong> $name</p>
                   <p><strong>Email:</strong> $email</p>
                   <p><strong>Subject:</strong> $subject</p>
                   <p><strong>Message:</strong><br>$message</p>";
    
    // Send the email
    if (mail($to, $email_subject, $email_body, $headers)) {
        echo "Message sent successfully";
    } else {
        echo "Failed to send message";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Management</title>
    <link rel="stylesheet" href="styles.css"> 
    <style>
/* General Styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

header {
    text-align: center;
    padding: 20px;
    background-color: #007bff;
    color: #fff;
}

.logo {
    max-width: 150px; /* Adjust the size of the logo */
    margin: 0 auto;
    display: block;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

h1 {
    margin: 10px 0;
    font-size: 24px;
}

/* Form Container */
main {
    display: flex;
    justify-content: center;
    margin: 20px;
}

form {
    max-width: 600px;
    width: 100%;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* Form Elements */
label {
    display: block;
    margin: 10px 0 5px;
    color: #555;
}

input[type="text"], input[type="email"], textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
    transition: border-color 0.3s ease; /* Smooth transition for border color */
}

input[type="text"]:focus, input[type="email"]:focus, textarea:focus {
    border-color: #007bff; /* Border color on focus */
    outline: none; /* Remove default outline */
}

textarea {
    resize: vertical; /* Allow vertical resizing only */
}

/* Button Styles */
button {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease; /* Smooth transition for background color */
}

button:hover {
    background-color: #0056b3;
}

/* Error / Success Messages */
.error, .success {
    color: #d9534f; /* Red for errors */
    font-weight: bold;
}

.success {
    color: #5bc0de; /* Light blue for success */
}

    </style>
<body>
    <header>
        <img src="img/esd.jpg" alt="Club Logo" class="logo"> <!-- Replace 'logo.png' with your logo file -->
        <h1>Contact Management</h1>
    </header>
    <main>
        <form action="process_contact.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="subject">Subject:</label>
            <input type="text" id="subject" name="subject" required>
            
            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="9" required></textarea>
            
            <button type="submit">Send</button>
        </form>
    </main>
</body>
</html>

