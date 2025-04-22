<?php
include '../includes/admin_auth.php';
include '../includes/db_connection.php';
include '../includes/admin_header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category = $_POST['category'];
    $type = $_POST['type'];
    $price = $_POST['price'];
    $area = $_POST['area'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $phone_number = $_POST['phone_number'];

    $sql = "INSERT INTO properties (category, type, price, area, location, description, phone_number) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssddsss", $category, $type, $price, $area, $location, $description, $phone_number);
    $stmt->execute();
    $property_id = $stmt->insert_id;
    $stmt->close();

    if (!empty($_FILES['photos']['name'][0])) {
        $upload_dir = '../uploads/properties/';
        foreach ($_FILES['photos']['tmp_name'] as $key => $tmp_name) {
            $file_name = $_FILES['photos']['name'][$key];
            $file_path = $upload_dir . basename($file_name);
            if (move_uploaded_file($tmp_name, $file_path)) {
                $photo_sql = "INSERT INTO property_photos (property_id, photo_path) VALUES (?, ?)";
                $photo_stmt = $conn->prepare($photo_sql);
                $photo_stmt->bind_param("is", $property_id, $file_name);
                $photo_stmt->execute();
                $photo_stmt->close();
            }
        }
    }

    echo "<p>Property added successfully!</p>";
}
?>

    <h1>Add New Property</h1>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="category">Category</label>
            <select class="form-control" id="category" name="category" required>
                <option value="Appartement">Appartement</option>
                <option value="Office">Office</option>
                <option value="Land">Land</option>
                <option value="House">House</option>
            </select>
        </div>
        <div class="form-group">
            <label for="type">Type</label>
            <select class="form-control" id="type" name="type" required>
                <option value="For Sale">For Sale</option>
                <option value="For Rent">For Rent</option>
            </select>
        </div>
        <div class="form-group">
            <label for="price">Price (MAD)</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <div class="form-group">
            <label for="area">Area (m²)</label>
            <input type="number" class="form-control" id="area" name="area" required>
        </div>
        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" class="form-control" id="location" name="location" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" required>
        </div>
        <div class="form-group">
            <label for="photos">Photos (up to 8)</label>
            <input type="file" class="form-control" id="photos" name="photos[]" multiple>
        </div>
        <button type="submit" class="btn btn-primary">Add Property</button>
    </form>

<?php include '../includes/admin_footer.php'; ?>