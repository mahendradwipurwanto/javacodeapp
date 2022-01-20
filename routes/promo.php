<?php

// ambil semua promo aktif

$app->get("/promo/all", function ($request, $response) {
  $db = $this->db;
  $db->select("a.id_promo, a.type, a.nama, a.diskon, a.nominal, a.kadaluarsa, a.syarat_ketentuan, a.foto")
    ->from("m_promo a")
    ->where("a.is_deleted", "=", 0)
    ->limit(4)
    ->orderBy("type", "asc");
  $promo = $db->findAll();

  if (empty($promo)) {
    return nocontentResponse($response);
  }

  return successResponse($response, $promo);
});

// ambil semua promo aktif

$app->get("/promo/type/{type}", function ($request, $response) {
  $type = $request->getAttribute('type');
  $db = $this->db;
  $db->select("a.id_promo, a.nama, a.diskon, a.nominal, a.kadaluarsa, a.syarat_ketentuan, a.foto")
    ->from("m_promo a")
    ->where("a.is_deleted", "=", 0)
    ->andWhere("a.type", "=", $type);
  $promo = $db->findAll();

  if (empty($promo)) {
    return nocontentResponse($response);
  }

  return successResponse($response, $promo);
});

// ambil detail promo

$app->get("/promo/detail/{id_promo}", function ($request, $response) {
  $id_promo = $request->getAttribute('id_promo');
  $db = $this->db;
  $db->select("a.id_promo, a.nama, a.diskon, a.nominal, a.kadaluarsa, a.syarat_ketentuan, a.foto")
    ->from("m_promo a")
    ->where("a.is_deleted", "=", 0)
    ->andWhere("a.id_promo", "=", $id_promo);
  $promo = $db->find();

  if (empty($promo)) {
    return nocontentResponse($response);
  }

  return successResponse($response, $promo);
});

?>