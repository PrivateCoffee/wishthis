<?php

/**
 * Database test
 *
 * @category API
 */

namespace wishthis;

global $page, $database;

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $success = false;

        if (isset($database) && $database) {
            echo _('Refused to test database connection after installation.');
            $response['dbTestSuccess'] = false;
        }
        else {
            try {
                $dsn = 'mysql:host=' . $_POST['DATABASE_HOST'] . ';dbname=' . $_POST['DATABASE_NAME'] . ';port=3306;charset=utf8';
                $pdo = new \PDO(
                    $dsn,
                    $_POST['DATABASE_USER'],
                    $_POST['DATABASE_PASSWORD']
                );

                $success = true;
            } catch (\Throwable $th) {
                echo $th->getMessage();
            }
        }

        $response['dbTestSuccess'] = $success;
        break;
}
