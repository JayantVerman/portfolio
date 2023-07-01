<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];

  // Create an associative array with the form data
  $formData = array(
    'name' => $name,
    'email' => $email,
    'message' => $message
  );

  // Encode the data as JSON
  $jsonData = json_encode($formData);

  // Define the path and filename for the JSON file
  $jsonFilePath = 'form-submissions.json';

  // Check if the JSON file exists
  if (file_exists($jsonFilePath)) {
    // Read the existing JSON data
    $existingData = file_get_contents($jsonFilePath);

    // Decode the existing JSON data into an associative array
    $existingArray = json_decode($existingData, true);

    // Append the new form data to the existing array
    $existingArray[] = $formData;

    // Encode the updated array as JSON
    $jsonData = json_encode($existingArray);
  }

  // Write the JSON data to the file
  file_put_contents($jsonFilePath, $jsonData);

  // Redirect back to the form page after successful submission
  header("Location: contact.html");
  exit;
}
?>
