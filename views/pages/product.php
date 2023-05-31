<div class="container mt-5">
   <div class="card border-primary mb-1">
      <div class="card-body">
         <h4 class="card-title">Product details:</h4>
         <div class="vstack gap-1">
            <div class="col-12 d-flex">
               <div class="col-6">
                  <div class="card">
                     <div class="card-body">
                        <h4 class="card-title"><?php echo $data['product']->name ?></h4>
                        <p class="card-text">Product's name:</p>
                     </div>
                  </div>

               </div>
               <div class="col-6">
                  <div class="card">
                     <div class="card-body">
                        <h4 class="card-title"><?php echo $data['product']->category->name ?></h4>
                        <p class="card-text">Product's category:</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-12 d-flex">
               <div class="col-6">
                  <div class="card">
                     <div class="card-body">
                        <h4 class="card-title"><?php echo $data['product']->price ?>$</h4>
                        <p class="card-text">Product's price:</p>
                     </div>
                  </div>

               </div>
               <div class="col-6">
                  <div class="card">
                     <div class="card-body">
                        <h4 class="card-title"><?php echo $data['product']->quantity ?></h4>
                        <p class="card-text">Product's quantity:</p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="card">
               <div class="card-body">
                  <h4 class="card-title"><?php echo $data['product']->description ?></h4>
                  <p class="card-text">Product's Description:</p>
               </div>
            </div>
         </div>
      </div>
      <div class="card-footer">
         <button class="btn btn-outline-secondary" onclick="history.back()">Back</button>
      </div>
   </div>
   <div>

   </div>
</div>