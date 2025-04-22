<?php
include '../includes/db_connection.php';
include '../includes/header.php';

// Search Filter Logic
// Search Filter Logic
$search_query = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';
$price_min = $_GET['price_min'] ?? '';
$price_max = $_GET['price_max'] ?? '';

$sql = "SELECT * FROM properties WHERE 1=1";
if ($search_query) {
    $search_query = $conn->real_escape_string($search_query);
    $sql .= " AND (location LIKE '%$search_query%' OR description LIKE '%$search_query%')";
}
if ($category) {
    $category = $conn->real_escape_string($category);
    $sql .= " AND category = '$category'";
}
if ($price_min) {
    $price_min = (float)$price_min;
    $sql .= " AND price >= $price_min'";
}
if ($price_max) {
    $price_max = (float)$price_max;
    $sql .= " AND price <= $price_max'";
}

$result = $conn->query($sql);



?>

    <!-- Search Filter Section -->
    <!-- Search Filter Section -->
    <!-- Search Filter Section -->
    <section class="search-filter" id="search">
        <div class="row">
            <div class="col-md-6">
                <h2>Search Properties</h2>
                <form method="get" action="index.php" style="display: flex; flex-direction: column; gap: 12px;">
                    <div class="form-group">
                        <input type="text" class="form-control" id="search" name="search" placeholder="Search by location or type..." value="<?php echo htmlspecialchars($search_query); ?>">
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="category" name="category">
                            <option value="" <?php if ($category == '') echo 'selected'; ?>>Category</option>
                            <option value="Appartement" <?php if ($category == 'Appartement') echo 'selected'; ?>>Appartement</option>
                            <option value="Office" <?php if ($category == 'Office') echo 'selected'; ?>>Office</option>
                            <option value="Land" <?php if ($category == 'Land') echo 'selected'; ?>>Land</option>
                            <option value="House" <?php if ($category == 'House') echo 'selected'; ?>>House</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" id="price_min" name="price_min" placeholder="Price Min" value="<?php echo htmlspecialchars($price_min); ?>">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" id="price_max" name="price_max" placeholder="Price Max" value="<?php echo htmlspecialchars($price_max); ?>">
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 120px; align-self: flex-start; margin-top: 10px;">Search</button>
                </form>
            </div>
            <div class="col-md-6">
                <img src="https://picsum.photos/600/400?random=2" alt="Property Search" class="img-fluid" style="border-radius: 8px;">
            </div>
        </div>
    </section>


    <hr class="section-separator">

    <!-- Properties Section -->
    <section class="properties">
        <h2>Available Properties</h2>
        <div class="row">
            <?php while ($property = $result->fetch_assoc()): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <?php
                        $photo_sql = "SELECT photo_path FROM property_photos WHERE property_id = ? LIMIT 1";
                        $photo_stmt = $conn->prepare($photo_sql);
                        $photo_stmt->bind_param("i", $property['id']);
                        $photo_stmt->execute();
                        $photo_result = $photo_stmt->get_result();
                        $photo = $photo_result->fetch_assoc();
                        ?>
                        <img src="../uploads/properties/<?php echo htmlspecialchars($photo['photo_path']); ?>" class="card-img-top" alt="Property">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($property['location']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($property['description']); ?></p>
                            <a href="property_details.php?id=<?php echo $property['id']; ?>" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </section>

    <hr class="section-separator">

    <!-- About Us Section -->
    <section class="about-us" id="about">
        <div class="row">
            <div class="col-md-6">
                <h2>About Us</h2>
                <p>RimAgency is dedicated to helping you find your dream home. Our team is passionate about real estate and customer satisfaction.</p>
            </div>
            <div class="col-md-6">
                <img src="https://picsum.photos/600/400?random=1" alt="About Us" class="img-fluid">
            </div>
        </div>
    </section>

    <hr class="section-separator">

    <!-- Contact Us Form Section -->
    <section class="contact-form" id="contact">
        <h2>Contact Us</h2>
        <form method="post" action="contact.php">
            <div class="form-group">
                <label for="full_name">Full Name</label>
                <input type="text" class="form-control" id="full_name" name="full_name" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="message">What are you looking for?</label>
                <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send Message</button>
        </form>
    </section>

<?php include '../includes/footer.php'; ?>