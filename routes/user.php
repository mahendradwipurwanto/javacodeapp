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
    GUMP::set_field_name("m_roles_id", "Hak Akses");
    $cek = validate($data, $validasi, $custom);
    return $cek;
}
/**
 * Ambil semua user aktif tanpa pagination
 */
$app->get("/user", function ($request, $response) {
    $params = $request->getParams();
    $db = $this->db;
    $db->select("*")
        ->from("m_user")
        ->where("is_deleted", "=", 0);
    if (isset($params["id_user"]) && !empty($params["id_user"])) {
        $db->where("id_user", "=", $params["id_user"]);
        $user = $db->find();
    } else {
        $user = $db->findAll();
    }

    return successResponse($response, $user)
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('content-type', 'application/json');
});
/**
 * Ambil data user untuk update profil
 */
$app->get("/user/view", function ($request, $response) {
    $db = $this->db;
    $data = $db->find("select * from m_user where id_user = '" . $_SESSION["user"]["id_user"] . "'");
    unset($data->password);
    return successResponse($response, $data)
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('content-type', 'application/json');
});

/**
 * Ambil semua user aktif tanpa pagination
 */
$app->get("/user/detail", function ($request, $response) {
    $param = $request->getParams();
    $db = $this->db;
    $db->select("*")
        ->from("m_user")
        ->where("id_user", "=", $param['id_user']);
    $user = $db->find();
    return successResponse($response, $user)
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('content-type', 'application/json');
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
