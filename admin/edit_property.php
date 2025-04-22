<?php
include '../includes/admin_auth.php';
include '../includes/db_connection.php';
include '../includes/admin_header.php';

// Validate property_id
$property_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($property_id <= 0) {
    echo '<div class="alert alert-danger" role="alert">Invalid property ID. Please select a valid property to edit from the dashboard. Redirecting...</div>';
    echo '<script>setTimeout(function(){ window.location.href = "dashboard.php"; }, 3000);</script>';
    include '../includes/admin_footer.php';
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
    echo '<div class="alert alert-danger" role="alert">Property not found. It may have been deleted or does not exist. Redirecting to dashboard...</div>';
    echo '<script>setTimeout(function(){ window.location.href = "dashboard.php"; }, 3000);</script>';
    include '../includes/admin_footer.php';
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category = $_POST['category'] ?? '';
    $type = $_POST['type'] ?? '';
    // Normalize price input: replace comma with dot and convert to float
    $price_input = $_POST['price'] ?? '0';
    $price_input = str_replace(',', '.', $price_input); // Convert "19221,99" to "19221.99"
    $price = (float)$price_input;
    $area = $_POST['area'] ?? 0;
    $location = $_POST['location'] ?? '';
    $description = $_POST['description'] ?? '';
    $phone_number = $_POST['phone_number'] ?? '';

    // Validate required fields
    if (empty($category) || empty($type) || $price <= 0 || $area <= 0 || empty($location) || empty($description) || empty($phone_number)) {
        echo '<div class="alert alert-danger" role="alert">Please fill in all required fields with valid values.</div>';
    } else {
        // Update property
        $update_sql = "UPDATE properties SET category = ?, type = ?, price = ?, area = ?, location = ?, description = ?, phone_number = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ssddsssi", $category, $type, $price, $area, $location, $description, $phone_number, $property_id);
        if ($update_stmt->execute()) {
            // Handle photo uploads (limit to 8)
            if (!empty($_FILES['photos']['name'][0])) {
                $upload_dir = '../uploads/properties/';
                $uploaded_files = count($_FILES['photos']['name']);
                if ($uploaded_files > 8) {
                    echo '<div class="alert alert-warning" role="alert">You can upload a maximum of 8 photos. Only the first 8 will be processed.</div>';
                    $uploaded_files = 8;
                }

                for ($i = 0; $i < $uploaded_files; $i++) {
                    $file_name = $_FILES['photos']['name'][$i];
                    $file_tmp = $_FILES['photos']['tmp_name'][$i];
                    $file_path = $upload_dir . basename($file_name);
                    if (move_uploaded_file($file_tmp, $file_path)) {
                        $photo_sql = "INSERT INTO property_photos (property_id, photo_path) VALUES (?, ?)";
                        $photo_stmt = $conn->prepare($photo_sql);
                        $photo_stmt->bind_param("is", $property_id, $file_name);
                        $photo_stmt->execute();
                        $photo_stmt->close();
                    } else {
                        echo '<div class="alert alert-warning" role="alert">Failed to upload photo: ' . htmlspecialchars($file_name) . '</div>';
                    }
                }
            }
            echo '<div class="alert alert-success" role="alert">Property updated successfully!</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Failed to update property. Please try again.</div>';
        }
        $update_stmt->close();

        // Refresh property data after update
        $stmt->execute();
        $result = $stmt->get_result();
        $property = $result->fetch_assoc();
    }
}
?>

    <div class="row">
        <div class="col-12">
            <h1 style="color: #183B4E;">Edit Property</h1>
            <p style="color: #333; margin-bottom: 2rem;">Update the details of the selected property below.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card" style="background-color: #fff; border: 1px solid #e0e0e0; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 1.5rem;">
                <form method="post" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 15px;">
                    <div class="form-group">
                        <label for="category" style="color: #333;">Category</label>
                        <select class="form-control" id="category" name="category" required style="height: 38px; font-size: 0.95rem; border: 1px solid #d1d5db; border-radius: 6px; padding: 0.5rem 0.75rem; background-color: #f9fafb;">
                            <option value="Appartement" <?php if ($property['category'] == 'Appartement') echo 'selected'; ?>>Appartement</option>
                            <option value="Office" <?php if ($property['category'] == 'Office') echo 'selected'; ?>>Office</option>
                            <option value="Land" <?php if ($property['category'] == 'Land') echo 'selected'; ?>>Land</option>
                            <option value="House" <?php if ($property['category'] == 'House') echo 'selected'; ?>>House</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="type" style="color: #333;">Type</label>
                        <select class="form-control" id="type" name="type" required style="height: 38px; font-size: 0.95rem; border: 1px solid #d1d5db; border-radius: 6px; padding: 0.5rem 0.75rem; background-color: #f9fafb;">
                            <option value="For Sale" <?php if ($property['type'] == 'For Sale') echo 'selected'; ?>>For Sale</option>
                            <option value="For Rent" <?php if ($property['type'] == 'For Rent') echo 'selected'; ?>>For Rent</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price" style="color: #333;">Price (MAD)</label>
                        <input type="number" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($property['price']); ?>" required step="0.01" style="height: 38px; font-size: 0.95rem; border: 1px solid #d1d5db; border-radius: 6px; padding: 0.5rem 0.75rem; background-color: #f9fafb;">
                    </div>
                    <div class="form-group">
                        <label for="area" style="color: #333;">Area (m²)</label>
                        <input type="number" class="form-control" id="area" name="area" value="<?php echo htmlspecialchars($property['area']); ?>" required style="height: 38px; font-size: 0.95rem; border: 1px solid #d1d5db; border-radius: 6px; padding: 0.5rem 0.75rem; background-color: #f9fafb;">
                    </div>
                    <div class="form-group">
                        <label for="location" style="color: #333;">Location</label>
                        <input type="text" class="form-control" id="location" name="location" value="<?php echo htmlspecialchars($property['location']); ?>" required style="height: 38px; font-size: 0.95rem; border: 1px solid #d1d5db; border-radius: 6px; padding: 0.5rem 0.75rem; background-color: #f9fafb;">
                    </div>
                    <div class="form-group">
                        <label for="description" style="color: #333;">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required style="font-size: 0.95rem; border: 1px solid #d1d5db; border-radius: 6px; padding: 0.5rem 0.75rem; background-color: #f9fafb;"><?php echo htmlspecialchars($property['description']); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="phone_number" style="color: #333;">Phone Number</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($property['phone_number']); ?>" required style="height: 38px; font-size: 0.95rem; border: 1px solid #d1d5db; border-radius: 6px; padding: 0.5rem 0.75rem; background-color: #f9fafb;">
                    </div>
                    <div class="form-group">
                        <label for="photos" style="color: #333;">Add More Photos (up to 8)</label>
                        <input type="file" class="form-control" id="photos" name="photos[]" multiple style="font-size: 0.95rem; border: 1px solid #d1d5db; border-radius: 6px; padding: 0.5rem 0.75rem; background-color: #f9fafb;">
                    </div>
                    <button type="submit" class="btn btn-primary" style="background-color: #DDA853; border: none; width: 150px; height: 38px; font-size: 0.95rem; border-radius: 6px;">Update Property</button>
                </form>
            </div>
        </div>
    </div>

<?php include '../includes/admin_footer.php'; ?>