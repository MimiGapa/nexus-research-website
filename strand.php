<?php
// strand.php
include 'includes/dbconnect.php';
$strand = isset($_GET['strand']) ? $_GET['strand'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Research Papers for <?php echo htmlspecialchars($strand); ?></title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Research Papers for <?php echo htmlspecialchars($strand); ?> Strand</h1>
        <nav>
            <a href="index.php">Return Home</a>
        </nav>
    </header>
    <main>
    <?php
    // Use a prepared statement to fetch research papers securely.
    // Added created_at and updated_at fields to the SELECT query.
    $stmt = $conn->prepare("SELECT title, authors, abstract, year, file_link, created_at, updated_at FROM researches WHERE strand = ?");
    $stmt->bind_param("s", $strand);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='card'>";
            echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";
            echo "<p><strong>Authors:</strong> " . htmlspecialchars($row['authors']) . "</p>";
            echo "<p><strong>Year:</strong> " . htmlspecialchars($row['year']) . "</p>";
            echo "<p>" . htmlspecialchars($row['abstract']) . "</p>";
            echo "<a href='" . htmlspecialchars($row['file_link']) . "' target='_blank'>Read Full Paper</a>";
            echo "<p><small>Created at: " . htmlspecialchars($row['created_at']) . "</small></p>";
            echo "<p><small>Updated at: " . htmlspecialchars($row['updated_at']) . "</small></p>";
            echo "</div>";
        }
    } else {
        echo "<p>No research papers found for this strand.</p>";
    }
    $stmt->close();
    $conn->close();
    ?>
    </main>
</body>
</html>
