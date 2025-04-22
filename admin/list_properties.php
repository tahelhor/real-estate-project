<?php
include '../includes/admin_auth.php';
include '../includes/db_connection.php';
include '../includes/admin_header.php';

// Fetch all properties
$sql = "SELECT * FROM properties";
$result = $conn->query($sql);
?>

    <div class="row">
        <div class="col-12">
            <h1 style="color: #183B4E;">Manage Properties</h1>
            <p style="color: #333; margin-bottom: 2rem;">View, edit, or delete properties below.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card" style="background-color: #fff; border: 1px solid #e0e0e0; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 1.5rem;">
                <?php if ($result->num_rows > 0): ?>
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category</th>
                            <th>Type</th>
                            <th>Price (MAD)</th>
                            <th>Area (m²)</th>
                            <th>Location</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php while ($property = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($property['id']); ?></td>
                                <td><?php echo htmlspecialchars($property['category']); ?></td>
                                <td><?php echo htmlspecialchars($property['type']); ?></td>
                                <td><?php echo htmlspecialchars($property['price']); ?></td>
                                <td><?php echo htmlspecialchars($property['area']); ?></td>
                                <td><?php echo htmlspecialchars($property['location']); ?></td>
                                <td>
                                    <a href="edit_property.php?id=<?php echo $property['id']; ?>" class="btn btn-primary btn-sm" style="background-color: #DDA853; border: none; margin-right: 5px;">Edit</a>
                                    <a href="delete_property.php?id=<?php echo $property['id']; ?>" class="btn btn-danger btn-sm" style="background-color: #dc3545; border: none;" onclick="return confirm('Are you sure you want to delete this property?');">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p style="color: #555;">No properties found. Add a new property to get started.</p>
                    <a href="add_property.php" class="btn btn-primary" style="background-color: #DDA853; border: none;">Add New Property</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php include '../includes/admin_footer.php'; ?>