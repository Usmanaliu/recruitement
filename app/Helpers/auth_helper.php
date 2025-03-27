<?php

use App\Models\UserModel;
use CodeIgniter\Session\Session;

if (!function_exists('getLoggedInUser')) {
    function getLoggedInUser()
    {
        $session = session();
        $userId = $session->get('id'); // Assuming you store user ID in session

        if (!$userId) {
            return null; // User not logged in
        }

        $userModel = new UserModel();
        return $userModel->find($userId); // Fetch user from database
    }
}
