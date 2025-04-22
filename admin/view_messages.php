<?php
include '../includes/admin_auth.php';
include '../includes/db_connection.php';
include '../includes/admin_header.php';

// Fetch all messages, ordered by date sent (newest first)
$sql = "SELECT * FROM contact_messages ORDER BY date_sent DESC";
$result = $conn->query($sql);
?>

    <div class="row">
        <div class="col-12">
            <h1 style="color: #183B4E; font-size: 2rem; font-weight: 600;">View Messages</h1>
            <p style="color: #333; margin-bottom: 2rem; font-size: 1.1rem;">Below are the messages received from users, sorted by the most recent.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card" style="background-color: #fff; border: 1px solid #e0e0e0; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); padding: 2rem; border-radius: 10px;">
                <?php if ($result->num_rows > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" style="border-collapse: separate; border-spacing: 0;">
                            <thead style="background-color: #27548A; color: #fff;">
                            <tr>
                                <th style="padding: 1rem; font-weight: 600; font-size: 0.95rem;">Full Name</th>
                                <th style="padding: 1rem; font-weight: 600; font-size: 0.95rem;">Phone</th>
                                <th style="padding: 1rem; font-weight: 600; font-size: 0.95rem;">Message</th>
                                <th style="padding: 1rem; font-weight: 600; font-size: 0.95rem;">Date Sent</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php while ($message = $result->fetch_assoc()): ?>
                                <tr style="transition: background-color 0.2s ease;" onmouseover="this.style.backgroundColor='#f8f9fa';" onmouseout="this.style.backgroundColor='';">
                                    <td style="padding: 1rem; color: #555; font-size: 0.9rem;"><?php echo htmlspecialchars($message['full_name']); ?></td>
                                    <td style="padding: 1rem; color: #555; font-size: 0.9rem;"><?php echo htmlspecialchars($message['phone']); ?></td>
                                    <td style="padding: 1rem; color: #555; font-size: 0.9rem;"><?php echo htmlspecialchars($message['message']); ?></td>
                                    <td style="padding: 1rem; color: #555; font-size: 0.9rem;"><?php echo htmlspecialchars($message['date_sent']); ?></td>
                                </tr>
                            <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div style="text-align: center; padding: 2rem;">
                        <p style="color: #555; font-size: 1.1rem; margin-bottom: 1rem;">No messages found. Users have not submitted any messages yet.</p>
                        <a href="dashboard.php" class="btn btn-primary" style="background-color: #DDA853; border: none; font-size: 0.95rem; padding: 0.5rem 1.5rem; border-radius: 6px;">Return to Dashboard</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php include '../includes/admin_footer.php'; ?>