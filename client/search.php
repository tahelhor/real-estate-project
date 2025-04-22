<?php
include '../includes/db_connection.php';
include '../includes/header.php';

$category = $_GET['category'] ?? '';
$price_min = $_GET['price_min'] ?? '';
$price_max = $_GET['price_max'] ?? '';

$sql = "SELECT * FROM properties WHERE 1=1";
if ($category) {
    $sql .= " AND category = '$category'";
}
if ($price_min) {
    $sql .= " AND price >= $price_min";
}
if ($price_max) {
    $sql .= " AND price <= $price_max";
}

$result = $conn->query($sql);
?>

    <h1>Search Properties</h1>
    <form method="get">
        <div class="form-group">
            <label for="category">Category</label>
            <select class="form-control" id="category" name="category">
                <option value="">All</option>
                <option value="Appartement">Appartement</option>
                <option value="Office">Office</option>
                <option value="Land">Land</option>
                <option value="House">House</option>
            </select>
        </div>
        <div class="form-group">
            <label for="price_min">Price Min</label>
            <input type="number" class="form-control" id="price_min" name="price_min">
        </div>
        <div class="form-group">
            <label for="price_max">Price Max</label>
            <input type="number" class="form-control" id="price_max" name="price_max">
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <div class="row mt-4">
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
                    <img src="../uploads/properties/<?php echo $photo['photo_path']; ?>" class="card-img-top" alt="Property">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $property['location']; ?></h5>
                        <p class="card-text"><?php echo $property['description']; ?></p>
                        <a href="property_details.php?id=<?php echo $property['id']; ?>" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

<?php include '../includes/footer.php'; ?>