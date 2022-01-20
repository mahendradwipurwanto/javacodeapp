<?php

function validasi($data, $custom = [])
{
  $validasi = [
    "nama" => "required",
    "kategori" => "required",
    "harga" => "required"
  ];

  $cek = validate($data, $validasi, $custom);
  return $cek;
}

// ambil semua menu aktif

$app->get("/menu/all", function ($request, $response) {
  $db = $this->db;
  $db->select("a.id_menu, a.nama, a.kategori, a.harga, a.deskripsi, a.foto, status")
    ->from("m_menu a")
    ->where("a.is_deleted", "=", 0);
  $menu = $db->findAll();

  if (empty($menu)) {
    return nocontentResponse($response);
  }

  return successResponse($response, $menu);
});

// ambil semua menu aktif

$app->get("/menu/kategori/{kategori}", function ($request, $response) {
  $kategori = $request->getAttribute('kategori');
  $db = $this->db;
  $db->select("a.id_menu, a.nama, a.kategori, a.harga, a.deskripsi, a.foto, status")
    ->from("m_menu a")
    ->where("a.is_deleted", "=", 0);
  if (isset($kategori) && !empty($kategori)) {
    $db->andWhere("a.kategori", "LIKE", $kategori);
  }
  $menu = $db->findAll();

  if (empty($menu)) {
    return nocontentResponse($response);
  }

  return successResponse($response, $menu);
});

// ambil semua menu aktif

$app->get("/menu/detail/{id_menu}", function ($request, $response) {
  $id_menu = $request->getAttribute('id_menu');
  $db = $this->db;
  $db->select("a.id_menu, a.nama, a.kategori, a.harga, a.deskripsi, a.foto, status")
    ->from("m_menu a")
    ->where("id_menu", "=", $id_menu);
  $menu = $db->find();

  if (empty($menu)) {
    return nocontentResponse($response);
  }

  $topping = get_menuDetail($db, $id_menu, "topping");
  $level = get_menuDetail($db, $id_menu, "level");

  $data['menu'] = $menu;
  $data['topping'] = [];
  $data['level'] = [];
  if (!empty($topping)) {
    $data['topping'] = $topping;
  }
  if (!empty($level)) {
    $data['level'] = $level;
  }

  return successResponse($response, $data);
});

/**
 * Insert new menu
 */
$app->post("/menu/add", function ($request, $response) {
  $params = $request->getParams();
  $db = $this->db;

  $validasi = validasi($params);

  if ($validasi === true) {
    try {
      $params['created_at'] = time();

      $menu = $db->insert("m_menu", $params);
      return successResponse($response, $menu);
    } catch (Exception $e) {
      return unprocessResponse($response, ["Terjadi masalah pada server"]);
    }
  }
  return unprocessResponse($response, $validasi);
});