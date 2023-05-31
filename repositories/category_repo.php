
<?php
require_once("models/category.php");

class CategoryRepository{
   protected $db;
   public function __construct() {
      $this->db = DB::getInstance();
   }
   public function all(){
      $list = [];
      $req = $this->db->query('SELECT * FROM categories');
  
      foreach ($req->fetchAll() as $item) {
        $list[] = new Category($item['id'],$item['name']);
      }
      return $list;
   }
   public function findById($id)
   {
      $stm = $this->db->prepare('SELECT * FROM categories WHERE id=:id');
      $stm->execute(['id'=>$id]);
      $db_category = $stm->fetch();
      return new Category ($db_category['id'], $db_category['name']);
   }
}