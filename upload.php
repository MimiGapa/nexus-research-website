<?php
// upload.php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'includes/dbconnect.php';
    
    // Retrieve the inputs
    $title    = $_POST['title'];
    $authors  = $_POST['authors'];
    $strand   = $_POST['strand'];
    $year     = $_POST['year'];
    $abstract = $_POST['abstract'];

    // Define the directory based on the strand (make sure it exists)
    $target_dir = "uploads/" . strtolower($strand) . "/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }
    
    // Process the file upload
    $target_file = $target_dir . basename($_FILES["research_file"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check file type (restrict to PDF for example)
    if ($fileType != "pdf") {
        echo "Sorry, only PDF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["research_file"]["tmp_name"], $target_file)) {
            // Insert record into the database using a prepared statement
            $stmt = $conn->prepare("INSERT INTO researches (title, authors, strand, year, abstract, file_link) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssiss", $title, $authors, $strand, $year, $abstract, $target_file);
            if ($stmt->execute()) {
                echo "The research paper has been uploaded successfully.";
            } else {
                echo "Error saving data: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "There was an error uploading your file.";
        }
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Research Paper</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Upload Research Paper</h1>
        <nav>
            <a href="index.php">Return Home</a>
        </nav>
    </header>
    <main>
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <div>
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" required>
            </div>
            <div>
                <label for="authors">Authors:</label>
                <input type="text" name="authors" id="authors" required>
            </div>
            <div>
                <label for="strand">Strand:</label>
                <select name="strand" id="strand" required>
                    <option value="STEM">STEM</option>
                    <option value="HUMSS">HUMSS</option>
                    <option value="ABM">ABM</option>
                    <option value="AFA">AFA</option>
                    <option value="HE">HE</option>
                    <option value="ICT">ICT</option>
                </select>
            </div>
            <div>
                <label for="year">Year:</label>
                <input type="number" name="year" id="year" required>
            </div>
            <div>
                <label for="abstract">Abstract:</label>
                <textarea name="abstract" id="abstract" rows="4" required></textarea>
            </div>
            <div>
                <label for="research_file">Upload File (PDF Only):</label>
                <input type="file" name="research_file" id="research_file" accept="application/pdf" required>
            </div>
            <div>
                <button type="submit">Upload Research</button>
            </div>
        </form>
    </main>
</body>
</html>
