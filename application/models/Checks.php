<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checks extends CI_Model {
  public function Upload($data,$table){
    if ($this->db->insert($table,$data)) {
      return true;
    }else{
      return false;
    }
  }
  public function Update($table,$data,$where){
    $this->db->where($where);
    if ($this->db->update($table,$data)) {
      return true;
    }else{
      return false;
    }
  }
  public function Delete($table,$where){
    $this->db->where($where);
    if ($this->db->delete($table)) {
      return true;
    }else{
      return false;
    }
  }
  // Fetching Data
  public function Fetch($table,$where,$by,$slimit=0){
    switch ($where) {
      case 'all':
        $this->db->order_by($by, "DESC");
        return $this->db->get($table);
        break;
      case 'allwa':
        $this->db->select('*');
        $this->db->from('posts');
        $this->db->join('sigma', 'posts.post_author = sigma.UID');
        $this->db->order_by('ID', "DESC");
        return $query = $this->db->get();
      break;
      case 'homeposts':
        $this->db->limit(20);
        $this->db->order_by('ID', "DESC");
        return $this->db->get($table);
        break;
      case 'recents':
        $this->db->limit(12);
        $this->db->order_by('ID', "DESC");
        return $this->db->get($table);
        break;
      case 'search':
        $this->db->select("*");
        $this->db->from("posts");
        if ($slimit == 0) {
          $this->db->limit(20);
        }
        if($by != ''){
         $this->db->like('title', $by);
         $this->db->or_like('tags', $by);
         $this->db->or_like('category', $by);
        }
        $this->db->order_by('ID', 'DESC');
        return $this->db->get();
        break;
      default:
        $this->db->where($where);
        return $this->db->get($table);
        break;
    }
  }
  public function Limited($page=0,$perpage,$query = ''){
    if ($query != '') {
      $this->db->select("*");
      $this->db->from("posts");
      $offset = $page.'0';
      $this->db->limit($perpage,$offset);
      $this->db->like('title', $query);
      $this->db->or_like('tags', $query);
      $this->db->or_like('category', $query);
      $this->db->order_by('ID', 'DESC');
      return $this->db->get();
    }else{
      $offset = $page.'0';
      $this->db->limit($perpage,$offset);
      $this->db->order_by('ID', "DESC");
      return $this->db->get('posts');
    }
  }
  public function cats($page=0,$perpage,$ID){
    if ($page == 0) {
      $this->db->select("*");
      $this->db->from("posts");
      $this->db->limit($perpage);
      $this->db->like('category', $ID);
      $this->db->order_by('ID', 'DESC');
      return $this->db->get();
    }else{
      $offset = $page.'0';
      $this->db->select("*");
      $this->db->from("posts");
      $this->db->like('category', $ID);
      $this->db->limit($perpage,$offset);
      $this->db->order_by('ID', "DESC");
      return $this->db->get('posts');
    }
  }
  public function allcats($ID){
    $this->db->select("*");
    $this->db->from("posts");
    $this->db->like('category', $ID);
    $this->db->order_by('ID', 'DESC');
    return $this->db->get();
  }
}










