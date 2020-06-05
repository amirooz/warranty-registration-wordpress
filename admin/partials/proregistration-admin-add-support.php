<?php wp_enqueue_media(); ?>

<div class="wrap">
    <h1 class="wp-heading-inline">Add new</h1>
    <hr class="wp-header-end">

    <div class="panel-body">
        <form id="addSupprtForm" class="form-horizontal" action="javascript:void(0)" enctype="multipart/form-data">
            <div class="form-group row">
                <label class="col-form-label col-sm-2" for="name">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-sm-2" for="email">Email</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-sm-2" for="phone">Phone</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter a valid phone number" required />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-sm-2" for="address">Address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter your address" required />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-sm-2" for="purchased_date">Purchased Date</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" id="purchased_date" name="purchased_date" required />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-sm-2" for="serial">Serial No.</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="serial" name="serial" placeholder="Enter a serial number" required />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-sm-2" for="invoice">Invoice</label>
                <div class="col-sm-2 col-md-1">
                    <button type="button" class="btn btn-info" id="invoice-upload">Upload</button>
                </div>
                <div class="col-sm-6">
                    <span><img id="media-image" src="http://127.0.0.1/devpress/wp-content/uploads/woocommerce-placeholder.png" alt="media image" /></span>
                    <input type="hidden" id="invoice" name="invoice" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-sm-2" for="store_note">Note</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="store_note" name="store_note" placeholder="Enter your note...">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-form-label col-sm-2" for="status">Status</label>
                <div class="col-sm-2">
                    <select class="form-control" id="status" name="status">
                        <option value="1">Pending</option>
                        <option value="2">Proceessing</option>
                        <option value="3">Complete</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                    <input type="submit" class="btn btn-primary" name="submit" value="Submit" />
                </div>
            </div>

        </form>
    </div>
</div>
