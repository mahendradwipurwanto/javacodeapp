<?php





/**
 * Insert new order
 */
$app->post("/test/order/add", function ($request, $response) {
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
        'jumlah' => $menu['jumlah']
      ];

      $detail = $db->insert("m_detail_order", $menu);
    }

    if (isset($id_voucher)) {
    #minus voucher
      orderVoucher($db, $id_voucher, $potongan);
    }

    if (!empty($id_diskon)) {
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