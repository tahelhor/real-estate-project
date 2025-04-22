<?php
include '../includes/db_connection.php';
include '../includes/header.php';

// Validate property_id
$property_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($property_id <= 0) {
    echo '<div class="alert alert-danger" role="alert">Invalid property ID. Redirecting to homepage...</div>';
    echo '<script>setTimeout(function(){ window.location.href = "index.php"; }, 3000);</script>';
    include '../includes/footer.php';
    exit();
}

// Fetch property data
$sql = "SELECT * FROM properties WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $property_id);
$stmt->execute();
$result = $stmt->get_result();
$property = $result->fetch_assoc();

// Check if property exists
if (!$property) {
    echo '<div class="alert alert-danger" role="alert">Property not found. Redirecting to homepage...</div>';
    echo '<script>setTimeout(function(){ window.location.href = "index.php"; }, 3000);</script>';
    include '../includes/footer.php';
    exit();
}

// Fetch property photos
$photo_sql = "SELECT photo_path FROM property_photos WHERE property_id = ?";
$photo_stmt = $conn->prepare($photo_sql);
$photo_stmt->bind_param("i", $property_id);
$photo_stmt->execute();
$photo_result = $photo_stmt->get_result();
?>

    <div class="row">
        <div class="col-12">
            <h1 style="color: #183B4E; font-size: 2rem; font-weight: 600; margin-bottom: 1.5rem;"><?php echo htmlspecialchars($property['location']); ?></h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <?php if ($photo_result->num_rows > 0): ?>
                <div id="propertyCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php $first = true; while ($photo = $photo_result->fetch_assoc()): ?>
                            <div class="carousel-item <?php if ($first) { echo 'active'; $first = false; } ?>">
                                <img src="../uploads/properties/<?php echo htmlspecialchars($photo['photo_path']); ?>" class="d-block w-100" style="height: 400px; object-fit: cover; border-radius: 8px;" alt="Property">
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <a class="carousel-control-prev" href="#propertyCarousel" role="button" data-slide="prev" style="background-color: rgba(0, 0, 0, 0.3); width: 50px; height: 50px; top: 50%; transform: translateY(-50%); border-radius: 50%;">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#propertyCarousel" role="button" data-slide="next" style="background-color: rgba(0, 0, 0, 0.3); width: 50px; height: 50px; top: 50%; transform: translateY(-50%); border-radius: 50%;">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            <?php else: ?>
                <p style="color: #555; font-size: 1.1rem;">No photos available for this property.</p>
            <?php endif; ?>
        </div>
        <div class="col-md-4">
            <div class="card" style="background-color: #fff; border: 1px solid #e0e0e0; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); border-radius: 10px; padding: 1.5rem;">
                <h3 style="color: #183B4E; font-size: 1.5rem; font-weight: 600; margin-bottom: 1.5rem;">Details</h3>
                <p style="color: #555; font-size: 1rem; margin-bottom: 0.75rem;"><strong>Category:</strong> <?php echo htmlspecialchars($property['category']); ?></p>
                <p style="color: #555; font-size: 1rem; margin-bottom: 0.75rem;"><strong>Type:</strong> <?php echo htmlspecialchars($property['type']); ?></p>
                <p style="color: #555; font-size: 1rem; margin-bottom: 0.75rem;"><strong>Price:</strong> <?php echo htmlspecialchars($property['price']); ?> MAD</p>
                <p style="color: #555; font-size: 1rem; margin-bottom: 0.75rem;"><strong>Area:</strong> <?php echo htmlspecialchars($property['area']); ?> m²</p>
                <p style="color: #555; font-size: 1rem; margin-bottom: 0.75rem;"><strong>Location:</strong> <?php echo htmlspecialchars($property['location']); ?></p>
                <p style="color: #555; font-size: 1rem; margin-bottom: 0.75rem;"><strong>Description:</strong> <?php echo htmlspecialchars($property['description']); ?></p>
                <p style="color: #555; font-size: 1rem; margin-bottom: 0;"><strong>Phone Number:</strong> <?php echo htmlspecialchars($property['phone_number']); ?></p>
            </div>
        </div>
    </div>

<?php include '../includes/footer.php'; ?>