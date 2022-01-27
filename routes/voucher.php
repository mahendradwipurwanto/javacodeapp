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

  $db->select('a.id_voucher, b.nama, a.id_user, c.nama as nama_user, a.nominal, a.info_voucher, a.periode_mulai, a.periode_selesai, a.type, a.status, a.catatan')
    ->from('m_voucher a')
    ->innerJoin('m_promo b', 'a.id_promo = b.id_promo')
    ->leftJoin('m_user c', 'a.id_user = c.id_user')
    ->where('b.type', '=', 'voucher');

  $voucher = $db->findAll();

  if (empty($voucher)) {
    return nocontentResponse($response);
  }

  return successResponse($response, $voucher);
});

// ambil list voucher user

$app->get("/voucher/user/{id_user}", function ($request, $response) {
  $id_user = $request->getAttribute('id_user');
  $db = $this->db;

  $db->select('a.id_voucher, b.nama, a.id_user, a.nominal, a.info_voucher, a.periode_mulai, a.periode_selesai, a.type, a.status, a.catatan')
    ->from('m_voucher a')
    ->innerJoin('m_promo b', 'a.id_promo = b.id_promo')
    ->where('b.type', '=', 'voucher')
    ->customWhere("a.id_user = {$id_user} AND a.status = 1", 'AND');

  $voucher = $db->findAll();

  if (empty($voucher)) {
    return nocontentResponse($response);
  }

  return successResponse($response, $voucher);
});

// ambil detail voucher

$app->get("/voucher/detail/{id_voucher}", function ($request, $response) {
  $id_voucher = $request->getAttribute('id_voucher');
  $db = $this->db;

  $db->select('a.id_voucher, b.nama, a.id_user, a.nominal, a.info_voucher, a.periode_mulai, a.periode_selesai, a.type, a.status, a.catatan')
    ->from('m_voucher a')
    ->innerJoin('m_promo b', 'a.id_promo = b.id_promo')
    ->where('a.id_voucher', '=', $id_voucher);

  $voucher = $db->findAll();

  if (empty($voucher)) {
    return nocontentResponse($response);
  }

  return successResponse($response, $voucher);
});


/**
 * Insert new voucher
 */
$app->post("/voucher/add", function ($request, $response) {
  $params = $request->getParams();
  $db = $this->db;

  try {
    $params['created_at'] = time();

    $promo = $db->insert("m_voucher", $params);
    return successResponse($response, $promo);
  } catch (Exception $e) {
    return unprocessResponse($response, ["Terjadi masalah pada server"]);
  }
});
