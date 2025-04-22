<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RimAgency - Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="dashboard.php">RimAgency Admin</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="adminNavbar">
        <ul class="navbar-nav ml-auto" style="gap: 15px;">
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="statistics.php">Statistics</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="add_property.php">Add Property</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="list_properties.php">Manage Properties</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="view_messages.php">View Messages</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block sidebar" style="position: fixed; top: 56px; bottom: 0; background-color: #F5EEDC; border-right: 2px solid #DDA853; box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1); padding: 1.5rem 0;">
            <div class="sidebar-sticky">
                <ul class="nav flex-column" style="gap: 10px;">
                    <li class="nav-item">
                        <a class="nav-link active" href="dashboard.php" style="color: #183B4E; padding: 0.75rem 1.5rem; border-radius: 5px; background-color: #fff; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05); transition: background-color 0.2s ease;">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="statistics.php" style="color: #183B4E; padding: 0.75rem 1.5rem; border-radius: 5px; transition: background-color 0.2s ease, color 0.2s ease;" onmouseover="this.style.backgroundColor='#DDA853'; this.style.color='#fff';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#183B4E';">Statistics</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add_property.php" style="color: #183B4E; padding: 0.75rem 1.5rem; border-radius: 5px; transition: background-color 0.2s ease, color 0.2s ease;" onmouseover="this.style.backgroundColor='#DDA853'; this.style.color='#fff';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#183B4E';">Add Property</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="list_properties.php" style="color: #183B4E; padding: 0.75rem 1.5rem; border-radius: 5px; transition: background-color 0.2s ease, color 0.2s ease;" onmouseover="this.style.backgroundColor='#DDA853'; this.style.color='#fff';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#183B4E';">Manage Properties</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_messages.php" style="color: #183B4E; padding: 0.75rem 1.5rem; border-radius: 5px; transition: background-color 0.2s ease, color 0.2s ease;" onmouseover="this.style.backgroundColor='#DDA853'; this.style.color='#fff';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#183B4E';">View Messages</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php" style="color: #183B4E; padding: 0.75rem 1.5rem; border-radius: 5px; transition: background-color 0.2s ease, color 0.2s ease;" onmouseover="this.style.backgroundColor='#DDA853'; this.style.color='#fff';" onmouseout="this.style.backgroundColor='transparent'; this.style.color='#183B4E';">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" style="margin-top: 30px;">