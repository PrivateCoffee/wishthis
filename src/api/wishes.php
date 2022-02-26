<?php

/**
 * wishes.php
 *
 * @author Jay Trees <github.jay@grandel.anonaddy.me>
 */

use wishthis\User;

$api      = true;
$response = array(
    'success' => false,
);

require '../../index.php';

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        if (isset($_POST['wishlist_id'], $_POST['wish_url'])) {
            /**
             * Insert New Wish
             */
            $database->query('INSERT INTO `wishes`
                             (
                                `wishlist`,
                                `type`,
                                `url`
                             ) VALUES ('
                                . $_POST['wishlist_id'] . ',
                                "' . $_POST['wish_type'] . '",
                                "' . $_POST['wish_url'] . '"
                             )
            ;');

            $response['success'] = true;
            $response['data']    = array(
                'lastInsertId' => $database->lastInsertId(),
            );
        }
        break;

    case 'PUT':
        parse_str(file_get_contents("php://input"), $_PUT);

        if (isset($_PUT['wish_id'], $_PUT['wish_status'])) {
            /**
             * Update Wish Status
             */
            $database->query('UPDATE `wishes`
                                 SET `status` = "' . $_PUT['wish_status'] . '"
                               WHERE `id` = ' . $_PUT['wish_id'] . '
            ;');

            $response['success'] = true;
        } elseif (isset($_PUT['wish_url_current'], $_PUT['wish_url_proposed'])) {
            /**
             * Update Wish URL
             */
            $database->query('UPDATE `wishes`
                                 SET `url` = "' . $_PUT['wish_url_proposed'] . '"
                               WHERE `url` = "' . $_PUT['wish_url_current'] . '"
            ;');

            $response['success'] = true;
        }
        break;

    case 'DELETE':
        parse_str(file_get_contents("php://input"), $_DELETE);

        if (isset($_DELETE['wish_id'])) {
            $database->query('DELETE FROM `wishes`
                                    WHERE `id` = ' . $_DELETE['wish_id'] . '
            ;');

            $response['success'] = true;
        }
        break;
}

header('Content-type: application/json; charset=utf-8');
echo json_encode($response);
die();
