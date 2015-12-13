<!-- resources/views/branch/product-finditem.blade.php -->
<p class="f-500 m-b-20 c-black">Filter: </p>

<div class="row">
    <div class="col-sm-3 m-b-20">
        <div class="form-group fg-line">
            <label>Code</label>
            <input type="text" class="form-control input-mask" placeholder="eg: PR-001">
        </div>
    </div>

    <div class="col-sm-3 m-b-20">
        <div class="form-group fg-line">
            <label>Description</label>
            <input type="text" class="form-control input-mask" placeholder="eg: printer">
        </div>
    </div>

    <div class="col-sm-3 m-b-20">
        <div class="form-group fg-line">
            <label>Cost</label>
            <input type="text" class="form-control input-mask" placeholder="eg: 250.20">
        </div>
    </div>

    <div class="col-sm-3 m-b-20">
        <div class="form-group fg-line">
            <label>Rack #</label>
            <input type="text" class="form-control input-mask" placeholder="">
        </div>
    </div>

    <div class="col-sm-3 m-b-20">
        <div class="form-group fg-line">
            <label>Category</label>
            <select class="selectpicker" name="category" data-live-search="true">
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-sm-3 m-b-20">
        <div class="form-group fg-line">
            <label>Brand</label>
            <select class="selectpicker" name="model" data-live-search="true">
                @foreach ($brands as $brand)
                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-sm-3 m-b-20">
        <div class="form-group fg-line">
            <label>Model</label>
            <select class="selectpicker" name="model" data-live-search="true">
                @foreach ($models as $model)
                <option value="{{ $model->id }}">{{ $model->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="row">
    <table class="data-table-command table table-striped table-vmiddle">
            <thead>
                <tr>
                    <th data-column-id="id" data-type="numeric">ID</th>
                    <th data-column-id="code" data-order="desc">Code</th>
                    <th data-column-id="description">Description</th>
                    <th data-column-id="address">Cost</th>
                    <th data-column-id="city">Price Level1</th>
                    <th data-column-id="contact_no">Price Level2</th>
                    <th data-column-id="contact_email">Price Level3</th>
                    <th data-column-id="contact_email">Total Stock</th>
                    <th data-column-id="contact_email">Available Stock</th>
                    <th data-column-id="commands" data-formatter="commands" data-sortable="false">Commands</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->code }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price_level1 }}</td>
                        <td>{{ $product->price_level2 }}</td>
                        <td>{{ $product->price_level3 }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
</div>

