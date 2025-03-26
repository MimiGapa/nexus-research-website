<?php
// index.php at the very top
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>
<?php // index.php ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nexus Journal of Multidisciplinary Research</title>
  <!-- Bootstrap CSS first -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Then your custom CSS -->
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>
<header class="bg-primary text-white text-center py-3">
    <h1>Siniloan Integrated National High School</h1>
    <h2>Nexus Journal of Multidisciplinary Research</h2>
    <nav>
    <a href="strand.php?strand=STEM" class="btn stem">STEM</a>
    <a href="strand.php?strand=HUMSS" class="btn humss">HUMSS</a>
    <a href="strand.php?strand=ABM" class="btn abm">ABM</a>
    <a href="strand.php?strand=AFA" class="btn afa">AFA</a>
    <a href="strand.php?strand=HE" class="btn he">HE</a>
    <a href="strand.php?strand=ICT" class="btn ict">ICT</a>
</nav>

</header>
    <main>
        <p>Select a strand above to view research papers.</p>
    </main>
</body>
</html>
