<div class="container mt-5 position-relative">
  <div class=" bg-secondary rounded rounded-1 text-white d-flex p-2 position-relative">
    <h3 class="flex-1">Product management</h3>
    <button id="btnAdd" class="btn btn-success position-absolute" style="right: 12px">New product</button>
  </div>
  <table id="productTable" class="table table-striped ">
    <thead class="bg-dark text-white table-hover">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col" class="text-end">Quantity</th>
        <th scope="col" class="text-end">Price</th>
        <th scope="col" class="flex-1">Description</th>
        <th scope="col">Category</th>
        <th scope="col" class="text-center">Action</th>
      </tr>
    </thead>
    <tbody class="bg-light">
      <?php
      foreach ($data['products'] as $product) {
        // echo "{$value->name}";<tr>
        echo "<th scope='row'> $product->id</th>
        <td><a href='/?controller=pages&action=product&params=$product->id'> $product->name</a></td>
        <td class='text-end'> $product->quantity</td>
        <td class='text-end'> $product->price$</td>
        <td> $product->description</td>
        <td> {$product->category->name}</td>
        <td class='text-center'>
          <div class='stack gap-1'>
            <button data-pid={$product->id} type='button' class='btn btn-primary btn-sm btn-edit'>Edit</button>
            <button data-pid={$product->id} class='btn btn-sm btn-danger btn-delete'>Remove</button>
          </div>
        </td>
      </tr>";
      }
      ?>
    </tbody>
  </table>
  <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add new product</h5>
          <button type="button" class="close btn btn-sm" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" id="prodCreateForm" action="http://localhost:8000?controller=productApi&action=newProduct">
            <div class="row mb3">
              <div class="col-6">
                <div class="col-12">
                  <label for="productName" class="form-label">Name</label>
                  <input type="text" class="form-control" id="productName" name="name"
                    placeholder="Enter product's name ...">
                </div>
              </div>
              <div class="col-6">
                <div class="col-12">
                  <label for="productCategory" class="form-label">Category</label>
                  <select id="productCategory" class="form-select" name="category">
                    <?php
                    foreach ($data['categories'] as $category) {
                      echo "<option value = {$category->id}>{$category->name}</option>";
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <div class=" col-6">
                <label for="productPrice" class="form-label">Price</label>
                <input type="number" class="form-control" id="productPrice" name="price"
                  placeholder="Enter product's price ...">
              </div>
              <div class="col-6">
                <label for="productQuantity" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="productQuantity" name="quantity"
                  placeholder="Enter product's quantity ...">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-12">
                <label for="productDescription" class="form-label">Description</label>
                <textarea class="form-control" id="productDescription" name="description"
                  placeholder="Enter description ..." rows="4"></textarea>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button id="btnAddSubmit" type="button" class="btn btn-primary">Add</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="close btn btn-sm" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="prodEditForm">
            <input type="hidden" id="productIdEdit" readonly/>
            <div class="row mb3">
              <div class="col-6">
                <div class="col-12">
                  <label for="productNameEdit" class="form-label">Name</label>
                  <input type="text" class="form-control" id="productNameEdit" name="name"
                    placeholder="Enter product's name ...">
                </div>
              </div>
              <div class="col-6">
                <div class="col-12">
                  <label for="productCategoryEdit" class="form-label">Category</label>
                  <select id="productCategoryEdit" class="form-select" name="category">
                    <?php
                    foreach ($data['categories'] as $category) {
                      echo "<option value = {$category->id}>{$category->name}</option>";
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>

            <div class="row mb-3">
              <div class=" col-6">
                <label for="productPriceEdit" class="form-label">Price</label>
                <input type="number" class="form-control" id="productPriceEdit" name="price"
                  placeholder="Enter product's price ...">
              </div>
              <div class="col-6">
                <label for="productQuantityEdit" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="productQuantityEdit" name="quantity"
                  placeholder="Enter product's quantity ...">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-12">
                <label for="productDescriptionEdit" class="form-label">Description</label>
                <textarea class="form-control" id="productDescriptionEdit" name="description"
                  placeholder="Enter description ..." rows="4"></textarea>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" data-bs-dismiss="modal" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button id="btnEditSubmit" type="button" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Are you sure want to continue?</h5>
          <button type="button" class="close btn btn-sm" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="modalDeleteContent" class="container-fluid">

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" data-bs-dismiss="modal" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button id="btnDeleteConfirm" type="button" class="btn btn-danger">Confirm</button>
        </div>
      </div>
    </div>
  </div>
</div>
<script defer src="assets/js/home.js">

</script>