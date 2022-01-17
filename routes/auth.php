<?php

function validasi($data, $custom = array())
{
    $validasi = array(
        "username" => "required",
        "password" => "required",
    );

    $cek = validate($data, $validasi, $custom);
    return $cek;
}

$app->get('/', function ($request, $responsep) {
    return unprocessResponse($response, ['can`t find any route with this end point']);
});

/**
 * Ambil session user
 */
$app->get('/auth/session', function ($request, $response) {
    if (isset($_SESSION['user']['m_roles_id'])) {
        return successResponse($response, $_SESSION);
    }
    return unprocessResponse($response, ['can`t find session']);
})->setName('session');

/**
 * Proses login
 */
$app->post('/auth/login', function ($request, $response) {
    $params = $request->getParams();
    $db = $this->db;

    if (!isset($params['username']) || !isset($params['password'])) {
        return unprocessResponse($response, $validasi);
    }

    $username = isset($params['username']) ? $params['username'] : '';
    $password = isset($params['password']) ? $params['password'] : '';

    /**
     * Get data
     */
    $db->select("m_user.*, m_roles.akses")
        ->from("m_user")
        ->leftJoin("m_roles", "m_roles.id = m_user.m_roles_id")
        ->where("username", "=", $username);
    $model = $db->find();

    if (!isset($model->id_user)) {
        return unprocessResponse($response, ['Mohon maaf tidak dapat menemukan data anda !']);
    }

    /**
     * Simpan user ke dalam session
     */
    if (sha1($password) == $model->password) {
        $_SESSION['user']['id_user'] = $model->id_user;
        $_SESSION['user']['username'] = $model->username;
        $_SESSION['user']['nama'] = $model->nama;
        $_SESSION['user']['m_roles_id'] = $model->m_roles_id;
        $_SESSION['user']['akses'] = json_decode($model->akses);
        $_SESSION['token'] = token();

        return successResponse($response, $_SESSION);
    }

    return unprocessResponse($response, ['Password yang anda masukkan salah !']);

})->setName('login');
/**
 * Hapus semua session
 */
$app->get('/auth/logout', function ($request, $response) {
    session_destroy();
    return successResponse($response, ['Berhasil logout']);
})->setName('logout');
