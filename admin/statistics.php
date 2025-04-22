<?php
include '../includes/admin_auth.php';
include '../includes/db_connection.php';
include '../includes/admin_header.php';

$total_properties = $conn->query("SELECT COUNT(*) FROM properties")->fetch_row()[0];
$properties_by_category = $conn->query("SELECT category, COUNT(*) FROM properties GROUP BY category");
$properties_by_price = $conn->query("SELECT COUNT(*) FROM properties WHERE price < 100000")->fetch_row()[0];
$properties_by_price2 = $conn->query("SELECT COUNT(*) FROM properties WHERE price >= 100000 AND price < 500000")->fetch_row()[0];
$properties_by_price3 = $conn->query("SELECT COUNT(*) FROM properties WHERE price >= 500000")->fetch_row()[0];
?>

    <div class="row">
        <div class="col-12">
            <h1 style="color: #183B4E; font-size: 2rem; font-weight: 600;">Statistics</h1>
            <p style="color: #333; margin-bottom: 2rem; font-size: 1.1rem;">A detailed overview of property data and trends.</p>
        </div>
    </div>

    <div class="row">
        <!-- Total Properties Card -->
        <div class="col-md-4 mb-4">
            <div class="card" style="background-color: #fff; border: 1px solid #e0e0e0; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); border-radius: 10px; padding: 1.5rem; transition: transform 0.3s ease, box-shadow 0.3s ease;" onmouseover="this.style.transform='scale(1.02)'; this.style.boxShadow='0 6px 16px rgba(0, 0, 0, 0.15)';" onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 4px 12px rgba(0, 0, 0, 0.1)';">
                <div class="card-body">
                    <div style="display: flex; align-items: center; margin-bottom: 1rem;">
                        <span style="font-size: 1.5rem; color: #DDA853; margin-right: 0.5rem;">🏠</span>
                        <h5 class="card-title" style="color: #183B4E; font-size: 1.25rem; font-weight: 600; margin: 0;">Total Properties</h5>
                    </div>
                    <p class="card-text" style="color: #555; font-size: 2rem; font-weight: 700; margin-bottom: 0.5rem;"><?php echo $total_properties; ?></p>
                </div>
            </div>
        </div>

        <!-- Properties by Category Card -->
        <div class="col-md-4 mb-4">
            <div class="card" style="background-color: #fff; border: 1px solid #e0e0e0; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); border-radius: 10px; padding: 1.5rem; transition: transform 0.3s ease, box-shadow 0.3s ease;" onmouseover="this.style.transform='scale(1.02)'; this.style.boxShadow='0 6px 16px rgba(0, 0, 0, 0.15)';" onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 4px 12px rgba(0, 0, 0, 0.1)';">
                <div class="card-body">
                    <div style="display: flex; align-items: center; margin-bottom: 1rem;">
                        <span style="font-size: 1.5rem; color: #DDA853; margin-right: 0.5rem;">📊</span>
                        <h5 class="card-title" style="color: #183B4E; font-size: 1.25rem; font-weight: 600; margin: 0;">Properties by Category</h5>
                    </div>
                    <ul style="padding-left: 0; color: #555; list-style: none;">
                        <?php while ($row = $properties_by_category->fetch_assoc()): ?>
                            <li style="margin-bottom: 0.75rem; font-size: 1rem; display: flex; justify-content: space-between; border-bottom: 1px solid #e0e0e0; padding-bottom: 0.5rem;">
                                <span><?php echo htmlspecialchars($row['category']); ?></span>
                                <span style="font-weight: 600; color: #183B4E;"><?php echo $row['COUNT(*)']; ?></span>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Properties by Price Range Card -->
        <div class="col-md-4 mb-4">
            <div class="card" style="background-color: #fff; border: 1px solid #e0e0e0; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); border-radius: 10px; padding: 1.5rem; transition: transform 0.3s ease, box-shadow 0.3s ease;" onmouseover="this.style.transform='scale(1.02)'; this.style.boxShadow='0 6px 16px rgba(0, 0, 0, 0.15)';" onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 4px 12px rgba(0, 0, 0, 0.1)';">
                <div class="card-body">
                    <div style="display: flex; align-items: center; margin-bottom: 1rem;">
                        <span style="font-size: 1.5rem; color: #DDA853; margin-right: 0.5rem;">💰</span>
                        <h5 class="card-title" style="color: #183B4E; font-size: 1.25rem; font-weight: 600; margin: 0;">Properties by Price Range</h5>
                    </div>
                    <div style="color: #555; font-size: 1rem;">
                        <div style="display: flex; justify-content: space-between; border-bottom: 1px solid #e0e0e0; padding-bottom: 0.5rem; margin-bottom: 0.75rem;">
                            <span>Less than 100,000 MAD</span>
                            <span style="font-weight: 600; color: #183B4E;"><?php echo $properties_by_price; ?></span>
                        </div>
                        <div style="display: flex; justify-content: space-between; border-bottom: 1px solid #e0e0e0; padding-bottom: 0.5rem; margin-bottom: 0.75rem;">
                            <span>100,000 - 500,000 MAD</span>
                            <span style="font-weight: 600; color: #183B4E;"><?php echo $properties_by_price2; ?></span>
                        </div>
                        <div style="display: flex; justify-content: space-between; padding-bottom: 0.5rem;">
                            <span>More than 500,000 MAD</span>
                            <span style="font-weight: 600; color: #183B4E;"><?php echo $properties_by_price3; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include '../includes/admin_footer.php'; ?>