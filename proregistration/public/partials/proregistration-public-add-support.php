<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://github.com/amirphp7
 * @since      1.0.0
 *
 * @package    Proregistration
 * @subpackage Proregistration/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="container">
    <h2 class="text-center mt-4 mb-5">Cerwin Vega Mobile Warranty Registration</h2>
    <div class="panel-body support-form">
        <form id="productRegisterForm" class="form-horizontal mb-5" method="post" action="javascript:void(0)" enctype="multipart/form-data">
            <div class="form-group">
                <label class="required" for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required />
            </div>
            <div class="form-group">
                <label class="required" for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required />
            </div>
            <div class="form-group">
                <label class="required" for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter a valid phone number" required />
            </div>
            <div class="form-group">
                <label class="required" for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Enter your address" required />
            </div>
            <div class="form-group">
                <label class="required" for="purchased_date">Purchased Date</label>
                <input type="date" class="form-control" id="purchased_date" name="purchased_date" required />
            </div>
            <div class="form-group">
                <label class="required" for="serial">Serial No.</label>
                <input type="text" class="form-control" id="serial" name="serial" placeholder="Enter your product serial number" required />
            </div>
            <div class="form-group">
                <label for="invoice">Invoice</label>
                <input type="file" class="form-control-file" id="invoice" name="invoice" />
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="submit" value="Submit" />
            </div>

        </form>
    </div>
</div>
