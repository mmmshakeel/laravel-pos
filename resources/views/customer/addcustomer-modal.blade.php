<form name="add_customer_form" method="POST" action="/customer/store">
{!! csrf_field() !!}
<div class="modal fade" id="addCustomerModal" tabindex="-1" role="dialog" aria-labelledby="addCustomerModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        &times;
                    </span>
                </button>
                <h4 class="modal-title" id="addCustomerModalLabel">
                    Add New Customer
                </h4>
            </div>
            <div class="modal-body">
                <div class="save-customer-result"></div>
                    <div class="row">
                        <div class="col-sm-4 m-b-20">
                            <div class="form-group fg-line">
                                <label>Title <sup class="req-star">*</sup></label>
                                <select class="selectpicker" name="title">
                                    <option value="Mr">Mr</option>
                                    <option value="Miss">Miss</option>
                                    <option value="Mrs">Mrs</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-4 m-b-20">
                            <div class="form-group fg-line">
                                <label>First Name <sup class="req-star">*</sup></label>
                                <input type="text" name="first_name" class="form-control input-mask" placeholder="First Name" value="" required />
                            </div>
                        </div>

                        <div class="col-sm-4 m-b-20">
                            <div class="form-group fg-line">
                                <label>Last Name</label>
                                <input type="text" name="last_name" class="form-control input-mask" placeholder="Last Name" value="" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 m-b-20">
                            <div class="form-group fg-line">
                                <label>Address</label>
                                <textarea name="address" class="form-control" placeholder="Address" data-autosize-on="true" style="overflow: hidden; word-wrap: break-word; height: 61px;"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 m-b-20">
                            <div class="form-group fg-line">
                                <label>City</label>
                                <input type="text" name="city" class="form-control input-mask" placeholder="City" value="" />
                            </div>
                        </div>

                        <div class="col-sm-6 m-b-20">
                            <div class="form-group fg-line">
                                <label>Country <sup class="req-star">*</sup></label>
                                <select class="selectpicker" name="country_id" data-live-search="true">
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 m-b-20">
                            <div class="form-group fg-line">
                                <label>Mobile <sup class="req-star">*</sup></label>
                                <input type="text" name="mobile" class="form-control input-mask" placeholder="Mobile" value="" required />
                            </div>
                        </div>

                        <div class="col-sm-4 m-b-20">
                            <div class="form-group fg-line">
                                <label>Telephone</label>
                                <input type="text" name="telephone" class="form-control input-mask" placeholder="Telephone" value="" />
                            </div>
                        </div>

                        <div class="col-sm-4 m-b-20">
                            <div class="form-group fg-line">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control input-mask" placeholder="Email" value="" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 m-b-20">
                            <div class="form-group fg-line">
                                <label>Notes</label>
                                <textarea name="notes" class="form-control" placeholder="Notes" data-autosize-on="true" style="overflow: hidden; word-wrap: break-word; height: 61px;"></textarea>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" onclick="closeCustomerModal();">
                    Close & Reload
                </button>
                <button type="button" class="btn btn-primary save-customer-btn" onclick="saveCustomer(this.form)">
                    Save customer
                </button>
            </div>
        </div>
    </div>
</div>
</form>
<script type="text/javascript">
    function saveCustomer(form) {
        $.post('/customer/ajaxStore', $(form).serialize(), function(data){
            if (data == 'SUCCESS') {
                var html = '<div class="alert alert-success" role="alert">';
                html += 'Customer saved successfully.';
                html += '</div>';

                $(".save-customer-btn").attr('disabled', 'disabled');
                $(".save-customer-result").html(html);
            } else {
                var html = '<div class="alert alert-danger" role="alert">';
                html += data;
                html += '</div>';

                $(".save-customer-result").html(html);
            }
        });
    }

    function closeCustomerModal() {
        $('#addCustomerModal').modal('hide');
        window.location.reload();
    }
</script>
