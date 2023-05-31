<?php
require_once('controllers/base_controller.php');
require_once('repositories/product_repo.php');
require_once('repositories/category_repo.php');

class PagesController extends BaseController
{
  protected $productRepository;
  protected $categoryRepository;
  function __construct()
  {
    $this->folder = 'pages';
    $this->productRepository = new ProductRepository;
    $this->categoryRepository = new CategoryRepository;
  }

  public function home()
  {
    $data['products'] = $this->productRepository->all();
    $data['categories'] = $this->categoryRepository->all();
    $this->render('home', $data);
  }
  public function product($id)
  {
    $data['product'] = $this->productRepository->findById($id);
    $this->render('product', $data);
  }

  public function error()
  {
    $this->render('error');
  }
}