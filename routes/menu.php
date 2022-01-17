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

$app->get("/menu", function ($request, $response) {
  $param = $request->getParams();
  $db = $this->db;
  $db->select("*")
    ->from("m_menu")
    ->where("is_deleted", "=", 0);
  if (isset($param["kategori"]) && !empty($param["kategori"])) {
    $db->where("kategori", "=", $param["kategori"]);
    $menu = $db->find();
  } else {
    $menu = $db->findAll();
  }

  return successResponse($response, $menu)
    ->withHeader('Access-Control-Allow-Origin', '*')
    ->withHeader('content-type', 'application/json');
});


// ambil semua menu aktif

$app->get("/menu/view", function ($request, $response) {
  $param = $request->getParams();
  $db = $this->db;
  $db->select("*")
    ->from("m_menu")
    ->where("id_menu", "=", $param['id_menu']);
  $menu = $db->find();

  $db->select("*")
    ->from("m_menu_detail")
    ->where("id_menu", "=", $param['id_menu']);
  $detail = $db->findAll();

  if (isset($detail)) {
    $data['menu'] = $menu;
    $data['detail'] = $detail;
  } else {
    $data['menu'] = $menu;
  }

  return successResponse($response, $data)
    ->withHeader('Access-Control-Allow-Origin', '*')
    ->withHeader('content-type', 'application/json');
});
