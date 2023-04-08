<?php

require_once __DIR__ . './../models/UserSubcription.php';
require_once __DIR__ . './../helpers/mitransHelper.php';

// Fungso untuk 
switch ($_GET['action']) {
    case 'checkout':
        checkoutSubcription();
        break;
    case 'handling-status':
        handlingStatusMidtrans();
        break;
    case 'stop':
        stopSubcription();
        break;
    default:
        return json_encode([
            'status' => 400,
            'message' => 'Route not support this method'
        ]);
        break;
}


/**
 *  Function to handle checkout 
 */
function checkoutSubcription()
{
    if (isset($_POST['idplan']) and (!$_POST['idplan'] == '' or !$_POST['idplan'] == null)) {

        $id_plan = $_POST['idplan'];

        $kode_unik = 'STREAM-' . generateRandomString();

        $dataSubcriptionPlan = UserSubcription::getSubcriptionPlan($id_plan);

        $data_midtrans = [
            "transaction_details" => [
                "order_id" => $kode_unik,
                "gross_amount" => $dataSubcriptionPlan->fetch()['price']
            ],
            'enabled_payments' => array('gopay', 'shopeepay', 'indomaret', 'bank_transfer'),
            'vtweb' => array()
        ];

        $midtrans = midtrans($data_midtrans);

        $checkout = UserSubcription::checkout($id_plan, $kode_unik, $midtrans);

        if ($checkout) {
            echo json_encode(
                [
                    'status' => 200,
                    'message' => 'Subcription Success',
                    'data' => $midtrans
                ],
            );
        } else {
            echo json_encode([
                'status' => 400,
                'message' => 'Subcription failed !'
            ]);
        }
    } else {
        echo json_encode([
            'status' => 400,
            'message' => 'id plan is required'
        ]);
    }
}


/**
 *  Handling status payment
 */
function handlingStatusMidtrans()
{
    $status = $_POST['status'];
    $kode_unik = $_POST['code_unique'];

    if (isset($status) and (!$status == '' or !$status == null)) {
        $handlingStatus = UserSubcription::updateStatus($kode_unik, $status);
        if ($handlingStatus) {
            echo json_encode(
                [
                    'status' => 200,
                    'message' => 'Update Status Payment Success',
                ],
            );
        } else {
            echo json_encode([
                'status' => 400,
                'message' => 'Update Status Payment Failed !'
            ]);
        }
    } else {
        echo json_encode([
            'status' => 400,
            'message' => 'status is required'
        ]);
    }
}

function stopSubcription()
{
    $id = $_POST['id'];

    if (isset($_POST['id'])) {
        $stopSubcription = UserSubcription::deleteUserSubcription($id);

        if ($stopSubcription) {
            echo json_encode([
                'status' => 400,
                'message' => 'Subcription failed !'
            ]);
        }
    }
}
