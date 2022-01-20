<?php

function validasi_order($data, $custom = array())
{

  $validasi = array(
    "id_user" => "required",
    "total_bayar" => "required"
  );

  $cek = validate($data, $validasi, $custom);
  return $cek;
}



/**
 * Insert new order
 */
$app->post("/order/add", function ($request, $response) {
  $params = $request->getParams();
  $db = $this->db;

  $no_struk = create_struk($db);

  $id_voucher = (isset($params['order']['id_voucher']) ? $params['order']['id_voucher'] : "");

  $id_diskon = (isset($params['order']['id_diskon']) ? json_encode($params['order']['id_diskon']) : "");
  $diskon = (isset($params['order']['diskon']) ? $params['order']['diskon'] : "");

  $potongan = (isset($params['order']['potongan']) ? $params['order']['potongan'] : "");

  try {

    $data = [
      'no_struk' => $no_struk,
      'id_user' => $params['order']['id_user'],
      'tanggal' => date("Y-m-d"),
      'id_voucher' => $id_voucher,
      'id_diskon' => $id_diskon,
      'diskon' => $diskon,
      'potongan' => $potongan,
      'total_bayar' => $params['order']['total_bayar']
    ];


    $order = $db->insert("m_order", $data);

    foreach ($params['menu'] as $menu) {

      $level = (isset($menu['level']) ? $menu['level'] : "");
      $topping = (isset($menu['topping']) ? json_encode($menu['topping']) : "");

      $menu = [
        'id_menu' => ($menu['id_menu'] * $menu['id_menu']),
        'id_order' => $order->id_order,
        'total' => ($menu['harga'] * $menu['jumlah']),
        'level' => $level,
        'topping' => $topping,
        'jumlah' => $menu['jumlah'],
        'catatan' => $menu['catatan']
      ];

      $detail = $db->insert("m_detail_order", $menu);
    }

    if (isset($id_voucher)) {
    #minus voucher
      orderVoucher($db, $id_voucher, $potongan);
    }

    if (isset($id_diskon)) {
    #minus diskon
      orderDiskon($db, $id_diskon);
    }
  // param for return
    $return = [
      'id_order' => $order->id_order,
      'no_struk' => $no_struk,
      'message' => 'Order has been successfuly added'
    ];

    return successResponse($response, $return);
  } catch (Exception $e) {
    return unprocessResponse($response, ["Terjadi masalah pada server"]);
  }
});

// ambil semua order aktif

$app->get("/order/all", function ($request, $response) {
  $db = $this->db;

  $db->select("a.id_order, a.no_struk, b.nama, a.total_bayar, a.tanggal, a.status")
    ->from("m_order a")
    ->leftJoin("m_user b", "a.id_user = b.id_user");
  $order = $db->findAll();

  if (empty($order)) {
    return nocontentResponse($response);
  }

  $i = 0;
  foreach ($order as $list => $key) {
    $data[$i]['id_order'] = $key->id_order;
    $data[$i]['no_struk'] = $key->no_struk;
    $data[$i]['nama'] = $key->nama;
    $data[$i]['total_bayar'] = $key->total_bayar;
    $data[$i]['tanggal'] = $key->tanggal;
    $data[$i]['status'] = $key->status;
    $data[$i]['menu'] = get_orderDetail($db, $key->id_order);
    $i++;
  }

  return successResponse($response, $data);
});

$app->get("/order/user/{id_user}", function ($request, $response) {
  $id_user = $request->getAttribute('id_user');
  $db = $this->db;

  $db->select("a.id_order, a.no_struk, b.nama, a.total_bayar, a.tanggal, a.status")
    ->from("m_order a")
    ->leftJoin("m_user b", "a.id_user = b.id_user")
    ->where("a.id_user", "=", $id_user);
  $order = $db->findAll();

  if (empty($order)) {
    return nocontentResponse($response);
  }

  $i = 0;
  foreach ($order as $list => $key) {
    $data[$i]['id_order'] = $key->id_order;
    $data[$i]['no_struk'] = $key->no_struk;
    $data[$i]['nama'] = $key->nama;
    $data[$i]['total_bayar'] = $key->total_bayar;
    $data[$i]['tanggal'] = $key->tanggal;
    $data[$i]['status'] = $key->status;
    $data[$i]['menu'] = get_orderDetail($db, $key->id_order);
    $i++;
  }

  return successResponse($response, $data);
});

$app->get("/order/status/{id_user}/{status}", function ($request, $response) {
  $id_user = $request->getAttribute('id_user');
  $status = $request->getAttribute('status');
  $db = $this->db;

  $db->select("a.id_order, a.no_struk, b.nama, a.total_bayar, a.tanggal, a.status")
    ->from("m_order a")
    ->leftJoin("m_user b", "a.id_user = b.id_user")
    ->where("a.id_user", "=", $id_user)
    ->andWhere("a.status", "=", $status);
  $order = $db->findAll();

  if (empty($order)) {
    return nocontentResponse($response);
  }

  $i = 0;
  foreach ($order as $list => $key) {
    $data[$i]['id_order'] = $key->id_order;
    $data[$i]['no_struk'] = $key->no_struk;
    $data[$i]['nama'] = $key->nama;
    $data[$i]['total_bayar'] = $key->total_bayar;
    $data[$i]['tanggal'] = $key->tanggal;
    $data[$i]['status'] = $key->status;
    $data[$i]['menu'] = get_orderDetail($db, $key->id_order);
    $i++;
  }

  return successResponse($response, $data);
});

$app->get("/order/proses/{id_user}", function ($request, $response) {
  $db = $this->db;
  $id_user = $request->getAttribute('id_user');

  $db->select("a.id_order, a.no_struk, b.nama, a.total_bayar, a.tanggal, a.status")
    ->from("m_order a")
    ->leftJoin("m_user b", "a.id_user = b.id_user")
    ->where('a.id_user', '=', $id_user)
    ->customWhere("a.status = 0 or a.status = 1 or a.status = 2", 'AND')
    ->orderBy('a.status', 'DESC');
  $order = $db->findAll();

  if (empty($order)) {
    return nocontentResponse($response);
  }

  $i = 0;
  foreach ($order as $list => $key) {
    $data[$i]['id_order'] = $key->id_order;
    $data[$i]['no_struk'] = $key->no_struk;
    $data[$i]['nama'] = $key->nama;
    $data[$i]['total_bayar'] = $key->total_bayar;
    $data[$i]['tanggal'] = $key->tanggal;
    $data[$i]['status'] = $key->status;
    $data[$i]['menu'] = get_orderDetail($db, $key->id_order);
    $i++;
  }

  return successResponse($response, $data);
});

$app->get("/order/history/{id_user}", function ($request, $response) {
  $id_user = $request->getAttribute('id_user');
  $db = $this->db;

  $db->select("a.id_order, a.no_struk, b.nama, a.total_bayar, a.tanggal, a.status")
    ->from("m_order a")
    ->leftJoin("m_user b", "a.id_user = b.id_user")
    ->where("a.id_user", "=", $id_user)
    ->customWhere("a.status = 3 or a.status = 4", 'AND')
    ->orderBy("a.status", "asc");
  $order = $db->findAll();

  if (empty($order)) {
    return nocontentResponse($response);
  }

  $i = 0;
  foreach ($order as $list => $key) {
    $data[$i]['id_order'] = $key->id_order;
    $data[$i]['no_struk'] = $key->no_struk;
    $data[$i]['nama'] = $key->nama;
    $data[$i]['total_bayar'] = $key->total_bayar;
    $data[$i]['tanggal'] = $key->tanggal;
    $data[$i]['status'] = $key->status;
    $data[$i]['menu'] = get_orderDetail($db, $key->id_order);
    $i++;
  }

  return successResponse($response, $data);
});

$app->get("/order/detail/{id_order}", function ($request, $response) {
  $id_order = $request->getAttribute('id_order');
  $db = $this->db;

  $db->select("a.id_order, a.no_struk, b.nama, a.id_voucher, d.nama as nama_voucher, a.diskon, a.potongan, a.total_bayar, a.tanggal, a.status")
    ->from("m_order a")
    ->leftJoin("m_user b", "a.id_user = b.id_user")
    ->leftJoin("m_voucher c", "a.id_voucher = c.id_voucher")
    ->leftJoin("m_promo d", "c.id_promo = d.id_promo")
    ->where("a.id_order", "=", $id_order);
  $order = $db->find();

  $data['order'] = $order;
  $data['detail'] = get_orderDetail($db, $id_order);

  return successResponse($response, $data);
});