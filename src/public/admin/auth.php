<?php

/**
 * auth.php -- Admin session guard
 */


if (empty($_SESSION['admin_logged_in'])) {
    header('Location: /admin/index.php');
    exit;
}
