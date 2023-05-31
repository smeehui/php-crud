<?php
require_once("models/product.php");
require_once("models/category.php");
require_once("repositories/category_repo.php");

class ProductRepository
{
   protected $db;
   protected $categoryRepository;
   public function __construct()
   {
      $this->db = DB::getInstance();
      $this->categoryRepository = new CategoryRepository();
   }
   public function all()
   {
      $list = [];
      $req = $this->db->query('SELECT * FROM products ORDER BY id ASC');
      foreach ($req->fetchAll() as $entity) {
         $category= $this->categoryRepository->findById($entity['category_id']);
         array_push($list, new Product($entity['id'], $entity['name'], $entity['quantity'], $entity['price'], $entity['description'], $category));
      }
      return $list;
   }
   public function findById($id)
   {
      $stm = $this->db->prepare("SELECT * FROM products WHERE id=:id");
      $stm->execute(['id'=>$id]);
      $entity = $stm->fetch();
      return new Product($entity['id'], $entity['name'], $entity['quantity'], $entity['price'], $entity['description'], $this->categoryRepository->findById($entity['category_id']));
   }
   public function newProduct(Product $product)
   {
      $this->db->beginTransaction();
      $stm  = $this->db->prepare("INSERT INTO `products` (`id`, `name`, `price`, `quantity`, `category_id`, `description`) VALUES (?,?,?,?,?,?)");
      $stm->execute([$product->id,$product->name,$product->price,$product->quantity,$product->category,$product->description]);
      $this->db->commit();
      return $this->findById($product->id);
   }
   public function updateProduct(Product $product)
   {
      $this->db->beginTransaction();
      $stm  = $this->db->prepare("UPDATE `products` SET `name` = ?, `price` = ?, `quantity` = ?,`category_id`=? ,`description` = ? WHERE `products`.`id` = ?");
      $stm->execute([$product->name,$product->price,$product->quantity,$product->category,$product->description,$product->id]);
      $this->db->commit();
      return $this->findById($product->id);
   }
   public function deleteProduct($id)
   {
      $stm = $this->db->prepare("DELETE FROM products WHERE `products`.`id` = ?");
      $stm->execute([$id]);
   }
}