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
$app->get("/user", function ($request, $response) {
    $db = $this->db;
    $db->select("a.id_user, a.nama, a.email, a.tgl_lahir, a.alamat, a.telepon, a.foto, a.ktp, a.status, a.m_roles_id as roles_id, a.is_customer, b.nama as roles")
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
 * Ambil data user
 */
$app->get("/user/view", function ($request, $response) {
    $db = $this->db;
    $user = $db->find("select * from m_user where id_user = '" . $_SESSION["user"]["id_user"] . "'");
    unset($user->password);

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
 * Update detail user
 */
$app->post("/user/add", function ($request, $response) {
    $params = $request->getParams();
    $db = $this->db;

    $data = array(
        "nama" => $params['nama'],
        "email" => $params['email'],
        "foto" => (isset($params['foto']) ? $params['foto'] : ''),
        "password" => sha1($params['password']),
        "m_roles_id" => $params['m_roles_id'],
        "is_customer" => 0
    );

    try {
        $user = $db->insert("m_user", $data);
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



# ========= THIS IS NOT ME ========== #
/**
 * Ambil semua list user
 */
$app->get("/appuser/index", function ($request, $response) {
    $params = $request->getParams();
    $db = $this->db;
    $db->select("m_user.*, m_roles.nama as hakakses")
        ->from("m_user")
        ->join("left join", "m_roles", "m_user.m_roles_id = m_roles.id");
    /**
     * Filter
     */
    if (isset($params["filter"])) {
        $filter = (array)json_decode($params["filter"]);
        foreach ($filter as $key => $val) {
            if ($key == "nama") {
                $db->where("m_user.nama", "LIKE", $val);
            } else if ($key == "is_deleted") {
                $db->where("m_user.is_deleted", "=", $val);
            } else {
                $db->where($key, "LIKE", $val);
            }
        }
    }
    /**
     * Set limit dan offset
     */
    if (isset($params["limit"]) && !empty($params["limit"])) {
        $db->limit($params["limit"]);
    }
    if (isset($params["offset"]) && !empty($params["offset"])) {
        $db->offset($params["offset"]);
    }
    $models = $db->findAll();
    $totalItem = $db->count();
    foreach ($models as $key => $val) {
        $val->m_roles_id = (string)$val->m_roles_id;
    }
    return successResponse($response, ["list" => $models, "totalItems" => $totalItem]);
});
/**
 * save user
 */
$app->post("/appuser/save", function ($request, $response) {
    $data = $request->getParams();
    $db = $this->db;

    if (isset($data["id_user"])) {
        /**
         * Update user
         */
        if (!empty($data["password"])) {
            $data["password"] = sha1($data["password"]);
        } else {
            unset($data["password"]);
        }
        $validasi = validasi($data);
    } else {
        /**
         * Buat user baru
         */
        $data["password"] = isset($data["password"]) ? sha1($data["password"]) : "";
        $validasi = validasi($data, ["password" => "required"]);
    }

    if ($validasi === true) {
        try {
            if (isset($data["id"])) {
                $model = $db->update("m_user", $data, ["id_user" => $data["id_user"]]);
            } else {
                $model = $db->insert("m_user", $data);
            }
            return successResponse($response, $model);
        } catch (Exception $e) {
            return unprocessResponse($response, ["Terjadi masalah pada server"]);
        }
    }
    return unprocessResponse($response, $validasi);
});
/**
 * save status user
 */
$app->post("/appuser/saveStatus", function ($request, $response) {
    $data = $request->getParams();
    $db = $this->db;
    unset($data["password"]);
    $validasi = validasi($data);
    if ($validasi === true) {
        try {
            $model = $db->update("m_user", $data, ["id_user" => $data["id_user"]]);
            return successResponse($response, $model);
        } catch (Exception $e) {
            return unprocessResponse($response, ["Terjadi masalah pada server"]);
        }
    }
    return unprocessResponse($response, $validasi);
});
