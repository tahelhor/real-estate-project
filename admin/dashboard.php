<?php
include '../includes/admin_auth.php';
include '../includes/db_connection.php';
include '../includes/admin_header.php';

// Fetch some basic stats for the dashboard
$total_properties = $conn->query("SELECT COUNT(*) FROM properties")->fetch_row()[0];
$total_messages = $conn->query("SELECT COUNT(*) FROM contact_messages")->fetch_row()[0];
?>

    <div class="row">
        <div class="col-12">
            <h1 style="color: #183B4E;">Admin Dashboard</h1>
            <p style="color: #333;">Welcome to the admin dashboard. Use the sidebar or navbar to navigate.</p>
        </div>
    </div>

    <div class="row">
        <!-- Welcome Card -->
        <div class="col-md-12 mb-4">
            <div class="card" style="background-color: #fff; border: 1px solid #e0e0e0; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <div class="card-body">
                    <h5 class="card-title" style="color: #183B4E;">Welcome, Admin!</h5>
                    <p class="card-text" style="color: #555;">Here’s a quick overview of your real estate management system.</p>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="col-md-4 mb-4">
            <div class="card" style="background-color: #fff; border: 1px solid #e0e0e0; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <div class="card-body">
                    <h5 class="card-title" style="color: #183B4E;">Total Properties</h5>
                    <p class="card-text" style="color: #555; font-size: 1.5rem;"><?php echo $total_properties; ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card" style="background-color: #fff; border: 1px solid #e0e0e0; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <div class="card-body">
                    <h5 class="card-title" style="color: #183B4E;">Total Messages</h5>
                    <p class="card-text" style="color: #555; font-size: 1.5rem;"><?php echo $total_messages; ?></p>
                </div>
            </div>
        </div>
    </div>

<?php include '../includes/admin_footer.php'; ?>