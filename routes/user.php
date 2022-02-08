<?php

/**
 * Validasi
 * @param  array $data
 * @param  array $custom
 * @return array
 */
function validasi($data, $custom = array())
{
    $validasi = array(
        "nama" => "required",
        "username" => "required",
        "m_roles_id" => "required",
    );

    $cek = validate($data, $validasi, $custom);
    return $cek;
}

/**
 * Ambil semua user aktif
 */
$app->get("/user/all", function ($request, $response) {
    $db = $this->db;
    $db->select("a.id_user, a.nama, a.email, a.tgl_lahir, a.alamat, a.telepon, a.foto, a.ktp, a.status, a.is_google, a.m_roles_id as roles_id, a.is_customer, b.nama as roles")
        ->from('m_user a')
        ->leftJoin('m_roles b', 'a.m_roles_id = b.id')
        ->where("a.is_deleted", "=", 0);
    $user = $db->findAll();

    if (empty($user)) {
        return nocontentResponse($response);
    }

    return successResponse($response, $user);
});

$app->get("/user/customer", function ($request, $response) {
    $db = $this->db;
    $db->select("a.id_user, a.nama, a.email, a.tgl_lahir, a.alamat, a.telepon, a.foto, a.ktp, a.status, a.is_google, a.m_roles_id as roles_id, a.is_customer, b.nama as roles")
        ->from('m_user a')
        ->leftJoin('m_roles b', 'a.m_roles_id = b.id')
        ->where("a.is_deleted", "=", 0)
        ->andWhere("a.is_customer", "=", 1);
    $user = $db->findAll();

    if (empty($user)) {
        return nocontentResponse($response);
    }

    return successResponse($response, $user);
});

/**
 * Ambil semua user aktif tanpa pagination
 */
$app->get("/user/detail/{id_user}", function ($request, $response) {
    $id_user = $request->getAttribute('id_user');
    $db = $this->db;
    $db->select("a.id_user, a.nama, a.email, a.tgl_lahir, a.alamat, a.telepon, a.foto, a.ktp, a.pin, a.status, a.m_roles_id as roles_id, b.nama as roles")
        ->from("m_user a")
        ->leftJoin('m_roles b', 'a.m_roles_id = b.id')
        ->where("a.id_user", "=", $id_user);
    $user = $db->find();

    if (empty($user)) {
        return nocontentResponse($response);
    }

    if (isset($user->id_user)) {
        return successResponse($response, $user);
    } else {
        return unprocessResponse($response, ["Tidak dapat menemukan data"]);
    }
});

/**
 * Update detail user
 */
$app->post("/user/update/{id_user}", function ($request, $response) {
    $id_user = $request->getAttribute('id_user');
    $params = $request->getParams();
    $db = $this->db;

    try {
        $user = $db->update("m_user", $params, ["id_user" => $id_user]);
        return successResponse($response, $user);
    } catch (Exception $e) {
        return unprocessResponse($response, ["Terjadi masalah pada server: " . $e]);
    }
});

/**
 * Send image
 */
$app->post("/user/profil/{id_user}", function ($request, $response) {
    $id_user = $request->getAttribute('id_user');
    $params = $request->getParams();
    $db = $this->db;

    $folder = config('PATH_IMG') . "{$id_user}/profil/";

    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    $name = uniqid() . '.jpeg';

    $simpan_foto = base64ToFile(['base64' => $params['image']], $folder, $name);

    $foto = config('SITE_IMG') . "{$id_user}/profil/" . $simpan_foto['fileName'];

    try {
        $user = $db->update("m_user", ['foto' => $foto], ["id_user" => $id_user]);
        return successResponse($response, $user);
    } catch (Exception $e) {
        return unprocessResponse($response, ["Terjadi masalah pada server"]);
    }
});

$app->post("/user/ktp/{id_user}", function ($request, $response) {
    $id_user = $request->getAttribute('id_user');
    $params = $request->getParams();
    $db = $this->db;

    $folder = config('PATH_IMG') . "{$id_user}/ktp/";

    if (!is_dir($folder)) {
        mkdir($folder, 0777, true);
    }

    $name = uniqid() . '.jpeg';

    $simpan_foto = base64ToFile(['base64' => $params['image']], $folder, $name);

    $foto = config('SITE_IMG') . "{$id_user}/ktp/" . $simpan_foto['fileName'];

    try {
        $user = $db->update("m_user", ['ktp' => $foto, 'status' => 1], ["id_user" => $id_user]);
        return successResponse($response, $user);
    } catch (Exception $e) {
        return unprocessResponse($response, ["Terjadi masalah pada server"]);
    }
});