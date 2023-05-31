console.log("out run");
$(document).ready(function () {
    console.log("run");
    $(".btn-edit").on("click", function (event) {
        appendProductDataToForm($(this).data("pid"));
    });
    $(".btn-delete").on("click", function (event) {
        showDeleteConfirm($(this).data("pid"));
    });
    $("#btnAdd").on("click", function (event) {
        console.log(123);
        $("#modalCreate").modal("show");
    });
    $("#btnAddSubmit").on("click", function (event) {
        handleAddNewProduct();
    });
    $("#btnEditSubmit").on("click", function (event) {
        handleEditProduct($(this).data("pid"));
    });
    $("#btnDeleteConfirm").on("click", function (event) {
        handleDeleteProduct($(this).data("pid"));
    });

    function handleAddNewProduct() {
        const url =
            location.origin + "/?controller=productApi&action=newProduct";
        $.ajax({
            url: url,
            method: "post",
            data: {
                name: $("#productName").val() ?? undefined,
                price: $("#productPrice").val() ?? undefined,
                quantity: $("#productQuantity").val() ?? undefined,
                description: $("#productDescription").val() ?? undefined,
                category: $("#productCategory").val() ?? undefined,
            },
        })
            .done((data) => {
                location.reload();
            })
            .fail((err) => {
                console.log(err);
            });
    }

    function appendProductDataToForm(id) {
        const url =
            location.origin +
            "/?controller=productApi&action=getById&params=" +
            id;
        console.log(url);
        $.ajax({
            url: url,
        })
            .done((data) => {
                const { id, name, price, quantity, description, category } =
                    JSON.parse(data).product;
                console.log(JSON.parse(data).product);
                $("#productIdEdit").val(id);
                $("#productNameEdit").val(name);
                $("#productPriceEdit").val(price);
                $("#productQuantityEdit").val(quantity);
                $("#productDescriptionEdit").val(description);
                $("#productCategoryEdit").val(category.id);
                $("#modalEdit").modal("show");
                $("#btnEditSubmit").data("pid", id);
            })
            .fail((err) => {
                console.log(err);
            });
    }

    function handleEditProduct(id) {
        const url =
            location.origin + "/?controller=productApi&action=updateProduct";
        $.ajax({
            url: url,
            method: "post",
            data: {
                id: $("#productIdEdit").val(),
                name: $("#productNameEdit").val() ?? undefined,
                price: $("#productPriceEdit").val() ?? undefined,
                quantity: $("#productQuantityEdit").val() ?? undefined,
                description: $("#productDescriptionEdit").val() ?? undefined,
                category: $("#productCategoryEdit").val() ?? undefined,
            },
        })
            .done((data) => {
                location.reload();
            })
            .fail((err) => {
                console.log(err);
            });
    }

    function showDeleteConfirm(id) {
        const url =
            location.origin +
            "/?controller=productApi&action=getById&params=" +
            id;
        $.ajax({
            url: url,
        })
            .done((data) => {
                data = JSON.parse(data).product;
                $("#modalDeleteContent").text("Delete " + data.name);
                $("#btnDeleteConfirm").data("pid", id);
                $("#modalDelete").modal("show");
            })
            .fail((err) => {
                console.log(err);
            });
    }

    function handleDeleteProduct(id) {
        const url =
            location.origin +
            "/?controller=productApi&action=deleteProduct&params=" +
            id;
        $.ajax({
            url: url
        })
            .done((data) => {
                location.reload();
            })
            .fail((err) => {
                console.log(err);
            });
    }
    $("#productTable").DataTable({
        lengthMenu: [5, 15, 30, 60, 100],
    });
});
