<?php

// ambil semua diskon aktif

$app->get("/diskon/all", function ($request, $response) {
  $db = $this->db;

  $db->select('a.id_diskon, a.id_user, b.nama as nama_user, c.nama, c.diskon')
    ->from('m_diskon a')
    ->leftJoin('m_user b', 'a.id_user = b.id_user')
    ->leftJoin('m_promo c', 'a.id_promo = c.id_promo')
    ->where('c.type', 'LIKE', 'diskon');
  $diskon = $db->findAll();

  if (empty($diskon)) {
    return nocontentResponse($response);
  }

  return successResponse($response, $diskon);
});

// ambil semua diskon aktif dari seorang user

$app->get("/diskon/user/{id_user}", function ($request, $response) {
  $id_user = $request->getAttribute('id_user');
  $db = $this->db;

  $db->select('a.id_diskon, a.id_user, b.nama as nama_user, c.nama, c.diskon')
    ->from('m_diskon a')
    ->leftJoin('m_user b', 'a.id_user = b.id_user')
    ->leftJoin('m_promo c', 'a.id_promo = c.id_promo')
    ->where('c.type', 'LIKE', 'diskon')
    ->customWHere("a.id_user = {$id_user} AND a.status = 1", 'AND');

  $diskon = $db->findAll();

  if (empty($diskon)) {
    return nocontentResponse($response);
  }

  return successResponse($response, $diskon);
});

// ambil semua diskon aktif dari seorang user

$app->get("/diskon/detail/{id_diskon}", function ($request, $response) {
  $id_diskon = $request->getAttribute('id_diskon');
  $db = $this->db;

  $db->select('a.id_diskon, a.id_user, b.nama as nama_user, c.nama, c.diskon, a.status')
    ->from('m_diskon a')
    ->leftJoin('m_user b', 'a.id_user = b.id_user')
    ->leftJoin('m_promo c', 'a.id_promo = c.id_promo')
    ->where('c.type', 'LIKE', 'diskon')
    ->andWhere('a.id_diskon', 'LIKE', $id_diskon);

  $diskon = $db->find();

  if (empty($diskon)) {
    return nocontentResponse($response);
  }

  return successResponse($response, $diskon);
});

?>