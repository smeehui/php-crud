<?php
require_once("controllers/base_api.php");
require_once("models/product.php");
require_once("repositories/product_repo.php");
class ProductApiController extends BaseApi
{
   protected $productRepository;
   protected $categoryRepository;
   public function __construct()
   {
      $this->productRepository = new ProductRepository();
      $this->categoryRepository = new CategoryRepository();
   }
   public function getById($id = 0)
   {
      $product = $this->productRepository->findById($id);
      $this->sendResponse(200,'{"product":'.json_encode($product).'}');
   }
   public function newProduct($args)
   {
      $product = new Product(floor(microtime(true) * 1000),$args['name'],$args['quantity'],$args['price'],$args['description'],$args['category']);
      $product = $this->productRepository->newProduct($product);
      $this->sendResponse(200,'{"product":'.json_encode($product).'}');
   }
   public function updateProduct($args)
   {
      $product = $this->productRepository->findById($args['id']);
      if (isset($args['name'])) {
         $product->name = $args['name'];
      }
      if (isset($args['price'])) {
         $product->price = $args['price'];
      }
      if (isset($args['quantity'])) {
         $product->quantity = $args['quantity'];
      }
      if (isset($args['category'])) {
         $product->category = $args['category'];
      }
      if (isset($args['description'])) {
         $product->description = $args['description'];
      }
      $product = $this->productRepository->updateProduct($product);
      $this->sendResponse(200,'{"product":'.json_encode($product).'}');
   }
   public function deleteProduct($id)
   {
      $this->productRepository->deleteProduct($id);
      $this->sendResponse(200);
   }
}