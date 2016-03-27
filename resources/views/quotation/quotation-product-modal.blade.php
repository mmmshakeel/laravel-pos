<div class="modal fade" id="addQuotationItemModal" tabindex="-1" role="dialog" aria-labelledby="addQuotationItemModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        &times;
                    </span>
                </button>
                <h4 class="modal-title" id="addCustomerModalLabel">
                    Add Item
                </h4>
            </div>
            <div class="modal-body">
                <div class="save-customer-result"></div>
                    <div class="row">
                        <div class="col-sm-6 m-b-20">
                            <div class="form-group fg-line">
                                <label>Product Code <sup class="req-star">*</sup></label>
                                <select class="selectpicker" name="product_id" id="productId" data-live-search="true" onchange="updateForm(this.value)">
                                    <option value=""></option>
                                    @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->code }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6 m-b-20">
                            <div class="form-group fg-line">
                                <label>Price Level<sup class="req-star">*</sup></label>
                                <div id="priceLevelOptions"></div>
                            </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 m-b-20">
                            <div class="form-group fg-line">
                                <label>Price</label>
                                <input type="text" name="" id="productPrice" class="form-control input-mask" placeholder="" value="" disabled />
                            </div>
                        </div>

                        <div class="col-sm-6 m-b-20">
                            <div class="form-group fg-line">
                                <label>Discription</label>
                                <input type="text" name="description" id="productDescription" class="form-control input-mask" placeholder="Product Description" value="" disabled />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4 m-b-20">
                            <div class="form-group fg-line">
                                <label>Discount (%)</label>
                                <input type="text" name="discount" id="productDiscount" class="form-control input-mask" placeholder="" value="" onkeyup="applyDiscount(this.value)" />
                            </div>
                        </div>

                        <div class="col-sm-4 m-b-20">
                            <div class="form-group fg-line">
                                <label>Sale Price</label>
                                <input type="text" name="sale_price" id="productSalePrice" class="form-control input-mask" placeholder="" value="" disabled />
                            </div>
                        </div>

                        <div class="col-sm-4 m-b-20">
                            <div class="form-group fg-line">
                                <label>Qty <sup class="req-star">*</sup></label>
                                <input type="text" name="quantity" id="productQuantity" class="form-control input-mask" placeholder="" value="" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 total-stock">
                            <h3>Total Stock:</h3>
                            <div class="total-stock-count"></div>
                        </div>
                        <div class="col-sm-6 actual-stock">
                            <h3>Available Stock:</h3>
                            <div class="available-total-stock-count"></div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" onclick="closeModal()">
                    Close
                </button>
                <button type="button" class="btn btn-primary" onclick="saveQuotationItem();">
                    Add Item
                </button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function updateForm(product_id) {

        // populate price level selections
        $.getJSON('/quotation/get-price-level-by-product/' + product_id, function(data){
            if (data.length != 0) {

                var level_count = 1;
                var html = '';

                $.each(data, function(key, value) {
                    if (value) {
                        html += '<label class="radio radio-inline m-r-20">';
                        html += '<input type="radio" name="product_price_level" value="'+ (value) +'" data-pricelevel="'+ (level_count) +'" onclick="updateItemPrice(this.value);">';
                        html += '<i class="input-helper"></i>';
                        html += 'Level ' + (level_count++) + ' - ' + value;
                        html += '</label>';
                    }
                });

                $("#priceLevelOptions").empty();
                $("#priceLevelOptions").append(html);
            } else {
                alert('There are no Price Level found');
            }
        });

        // update product description
        $.get('/quotation/get-product-description/' + product_id, function(data) {
            $("#productDescription").val(data);
        });

        // update product stock
        $.getJSON('/product/get-product-stock/' + product_id, function(data) {
            $(".total-stock-count").html('<h3>' + data.total_stock + '</h3>');
            $(".available-total-stock-count").html('<h3>' + data.available_stock + '</h3>');
        });
    }

    function updateItemPrice(item_price) {
        $("#productPrice").val(item_price);
        $("#productSalePrice").val(item_price);
    }

    function applyDiscount(item_discount) {
        var item_price = $("#productPrice").val();

        var discount_amount = (item_price / 100) * item_discount;
        var item_sale_price = item_price - discount_amount;

        $("#productSalePrice").val(item_sale_price);
    }

    function closeModal() {
        $('#addQuotationItemModal').modal('hide');
    }
</script>
