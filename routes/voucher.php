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

// ambil semua voucher

$app->get("/voucher/all", function ($request, $response) {
  $db = $this->db;

  $menu = $db->findAll('SELECT a.*, b.nama FROM m_voucher a, m_promo b WHERE a.id_promo = b.id_promo AND b.type = "voucher"');

  return successResponse($response, $menu);
});

// ambil detail voucher

$app->get("/voucher/detail/{id_voucher}", function ($request, $response) {
  $id_voucher = $request->getAttribute('id_voucher');
  $db = $this->db;

  $menu = $db->findAll("SELECT a.*, b.nama FROM m_voucher a, m_promo b WHERE a.id_promo = b.id_promo AND b.type = 'voucher' AND a.id_voucher = '$id_voucher'");

  return successResponse($response, $menu);
});

$app->get('/images/vouvher/{id_voucher}', function ($request, $response, $args) {
  $id_voucher = $args['id_voucher'];
  $image = @file_get_contents("../img/" . $data);
  if ($image === false) {
    $handler = $this->notFoundHandler;
    return $handler($request, $response);
  }

  $response->write($image);
  return $response->withHeader('Content-Type', FILEINFO_MIME_TYPE);
});

?>