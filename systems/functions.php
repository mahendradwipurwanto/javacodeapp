<?php

function vd($data)
{
  var_dump($data);
  die;
}

function token()
{
  return "m_app";
}

function create_password()
{
  $password = random_int(1000, 9999);

  // insert checking process here

  return $password;
}

// Database function
function get_account($db, $email)
{
  $db->select("m_user.*, m_roles.akses")
    ->from("m_user")
    ->leftJoin("m_roles", "m_roles.id = m_user.m_roles_id")
    ->where("email", "=", $email);
  $model = $db->find();
  return $model;
}

function get_menuDetail($db, $id_menu, $type = null)
{
  $db->select("*")
    ->from("m_menu_detail")
    ->where("id_menu", "=", $id_menu);
  if ($type != null) {
    $db->where("type", "LIKE", $type);
  }

  return $db->findAll();
}

function insert_data($db, $data)
{
}

function update_data($db, $data)
{

}