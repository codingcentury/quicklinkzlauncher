<?php
session_start();

$linkz_file = 'linkz.json';
$admin_password = 'password'; // Change this in production!

// Handle login
if (isset($_POST['login_password'])) {
    if ($_POST['login_password'] === $admin_password) {
        $_SESSION['is_admin'] = true;
    } else {
        $login_error = "Incorrect password!";
    }
}

// Handle logout
if (isset($_GET['logout'])) {
    unset($_SESSION['is_admin']);
    header("Location: index.php");
    exit;
}

// Helper: Load links
function load_links($file) {
    return file_exists($file) ? json_decode(file_get_contents($file), true) : [];
}

// Helper: Save links
function save_links($file, $links) {
    file_put_contents($file, json_encode($links, JSON_PRETTY_PRINT));
}

// Handle Delete
if (isset($_GET['delete']) && !empty($_SESSION['is_admin'])) {
    $idx = intval($_GET['delete']);
    $links = load_links($linkz_file);
    if (isset($links[$idx])) {
        array_splice($links, $idx, 1);
        save_links($linkz_file, $links);
    }
    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    exit;
}

// Handle Edit
$edit_idx = isset($_GET['edit']) ? intval($_GET['edit']) : null;
$links = load_links($linkz_file);
$edit_link = ($edit_idx !== null && isset($links[$edit_idx])) ? $links[$edit_idx] : null;

// Handle Add/Edit Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_SESSION['is_admin']) && isset($_POST['name'], $_POST['url'])) {
    $name = trim($_POST['name']);
    $url = trim($_POST['url']);
    if ($name && $url && filter_var($url, FILTER_VALIDATE_URL)) {
        if (isset($_POST['edit_idx']) && $_POST['edit_idx'] !== '') {
            // Edit existing
            $idx = intval($_POST['edit_idx']);
            if (isset($links[$idx])) {
                $links[$idx] = ['name' => $name, 'url' => $url];
            }
        } else {
            // Add new
            $links[] = ['name' => $name, 'url' => $url];
        }
        save_links($linkz_file, $links);
        header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Quick Linkz Launcher</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Top Navigation Bar -->
    <nav class="topnav">
        <div class="topnav-content">
            <?php if (empty($_SESSION['is_admin'])): ?>
                <form method="POST" class="login-form">
                    <input type="password" name="login_password" placeholder="Admin password" required>
                    <button type="submit" class="btn">Login</button>
                    <?php if (!empty($login_error)): ?>
                        <span class="error"><?= htmlspecialchars($login_error) ?></span>
                    <?php endif; ?>
                </form>
            <?php else: ?>
                <span class="admin-label">Admin</span>
                <a href="?logout=1" class="btn btn-logout">Logout</a>
            <?php endif; ?>
        </div>
    </nav>

    <div id="menu">
        <h2>Quick Linkz Launcher</h2>
        <?php if (!empty($_SESSION['is_admin'])): ?>
            <form method="POST" autocomplete="off" class="link-form">
                <div class="form-fields">
                    <input type="text" name="name" placeholder="Link Name" required value="<?= $edit_link ? htmlspecialchars($edit_link['name']) : '' ?>">
                    <input type="url" name="url" placeholder="https://example.com" required value="<?= $edit_link ? htmlspecialchars($edit_link['url']) : '' ?>">
                </div>
                <div class="button-group">
                    <?php if ($edit_link): ?>
                        <input type="hidden" name="edit_idx" value="<?= $edit_idx ?>">
                        <button type="submit">Save</button>
                        <a href="index.php" class="btn">Cancel</a>
                    <?php else: ?>
                        <button type="submit">Add Link</button>
                    <?php endif; ?>
                </div>
            </form>
        <?php endif; ?>
        <ul>
            <?php foreach ($links as $idx => $link): ?>
                <li>
                    <a href="<?= htmlspecialchars($link['url']) ?>" target="_blank">
                        <?= htmlspecialchars($link['name']) ?>
                    </a>
                    <?php if (!empty($_SESSION['is_admin'])): ?>
                    <span class="actions">
                        <a href="?edit=<?= $idx ?>" class="btn btn-edit">Edit</a>
                        <a href="?delete=<?= $idx ?>" class="btn btn-delete" onclick="return confirm('Delete this link?');">Delete</a>
                    </span>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
