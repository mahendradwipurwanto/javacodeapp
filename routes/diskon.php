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

// ambil semua diskon aktif

$app->get("/diskon/all", function ($request, $response) {
  $db = $this->db;
  $menu = $db->findAll("SELECT a.id_diskon, a.id_user, c.nama as nama_user, b.nama, b.diskon FROM m_diskon a, m_promo b, m_user c WHERE a.id_promo = b.id_promo AND a.id_user = c.id_user AND b.type = 'diskon'");

  return successResponse($response, $menu);
});

// ambil semua diskon aktif dari seorang user

$app->get("/diskon/user/{id_user}", function ($request, $response) {
  $id_user = $request->getAttribute('id_user');
  $db = $this->db;
  $menu = $db->findAll("SELECT a.id_diskon, a.id_user, c.nama as nama_user, b.nama, b.diskon FROM m_diskon a, m_promo b, m_user c WHERE a.id_promo = b.id_promo AND a.id_user = c.id_user AND b.type = 'diskon' AND a.id_user = '$id_user'");

  return successResponse($response, $menu);
});

// ambil semua diskon aktif dari seorang user

$app->get("/diskon/detail/{id_diskon}", function ($request, $response) {
  $id_diskon = $request->getAttribute('id_diskon');
  $db = $this->db;
  $menu = $db->findAll("SELECT a.id_diskon, a.id_user, c.nama as nama_user, b.nama, b.diskon FROM m_diskon a, m_promo b, m_user c WHERE a.id_promo = b.id_promo AND a.id_user = c.id_user AND b.type = 'diskon' AND a.id_diskon = '$id_diskon'");

  return successResponse($response, $menu);
});

?>