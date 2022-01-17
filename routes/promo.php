<?php

// function validasi($data, $custom = [])
// {
//   $validasi = [
//     "nama" => "required",
//     "kategori" => "required",
//     "harga" => "required",
//     "status" => "required"
//   ];

//   $cek = validate($data, $validasi, $custom);
//   return $cek;
// }

// ambil semua promo aktif

$app->get("/promo/all", function ($request, $response) {
  $db = $this->db;
  $db->select("*")
    ->from("m_promo")
    ->where("is_deleted", "=", 0);
  $menu = $db->findAll();

  return successResponse($response, $menu);
});

// ambil semua promo aktif

$app->get("/promo/type/{type}", function ($request, $response) {
  $type = $request->getAttribute('type');
  $db = $this->db;
  $db->select("*")
    ->from("m_promo")
    ->where("is_deleted", "=", 0)
    ->andWhere("type", "=", $type);
  $menu = $db->findAll();

  return successResponse($response, $menu);
});

?>