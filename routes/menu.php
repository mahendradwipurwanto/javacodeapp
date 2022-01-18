<?php

function validasi($data, $custom = [])
{
  $validasi = [
    "nama" => "required",
    "kategori" => "required",
    "harga" => "required",
    "status" => "required"
  ];

  $cek = validate($data, $validasi, $custom);
  return $cek;
}

// ambil semua menu aktif

$app->get("/menu/all", function ($request, $response) {
  $db = $this->db;
  $db->select("*")
    ->from("m_menu")
    ->where("is_deleted", "=", 0);
  $menu = $db->findAll();

  return successResponse($response, $menu);
});

// ambil semua menu aktif

$app->get("/menu/kategori/{kategori}", function ($request, $response) {
  $kategori = $request->getAttribute('kategori');
  $db = $this->db;
  $db->select("*")
    ->from("m_menu")
    ->where("is_deleted", "=", 0);
  if (isset($kategori) && !empty($kategori)) {
    $db->where("kategori", "=", $kategori);
    $menu = $db->find();
  } else {
    $menu = $db->findAll();
  }

  return successResponse($response, $menu);
});

// ambil semua menu aktif

$app->get("/menu/detail/{id_menu}", function ($request, $response) {
  $id_menu = $request->getAttribute('id_menu');
  $db = $this->db;
  $db->select("*")
    ->from("m_menu")
    ->where("id_menu", "=", $id_menu);
  $menu = $db->find();

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

      $menu = $db->insert("m_menu", $params);
      return successResponse($response, $menu);
    } catch (Exception $e) {
      return unprocessResponse($response, ["Terjadi masalah pada server"]);
    }
  }
  return unprocessResponse($response, $validasi);
});