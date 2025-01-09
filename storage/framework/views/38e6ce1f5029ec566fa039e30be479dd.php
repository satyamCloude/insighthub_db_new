<style>
    #disabl {
        display: none !important;
    }

    .custom-file-input-container {
        position: relative;
        overflow: hidden;
        cursor: pointer;
        width: 150px;
        height: 40px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .input-group {
        display: flex;
        align-items: end;
    }

    .input-group-text {
        border-top-left-radius: 0px;
        border-bottom-left-radius: 0px;
    }

    .custom-file-input {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        background-color: #f8f9fa;
        padding: 10px;
    }

    .custom-file-input:hover {
        background-color: #e9ecef;
    }

    #selectedFileName {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .form-control {
/*        margin-top: 10px;*/
    }
</style>
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Invoice Settings /</span> Home</h4>
<div class="row">
    <div class="col-md-6">
        <h5 class="card-header">Invoice Settings</h5>
    </div>
    <div class="col-md-6 text-end">
    </div>
    <div class="col-md-12">
        <form action="<?php echo e(url('admin/InvoiceSettings/store')); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6 d-flex">
                        <div class="col-md-7">
                            <label for="invoice_logo" class="form-label">
                                <h5>Invoice Logo <span class="text-danger">*</span></h5>
                            </label>
                            <div class="custom-file-input-container"
                                onclick="document.getElementById('invoiceLogoInput').click();">
                                <div class="custom-file-input">
                                    <span id="selectedFileNameLogo">Choose File</span>
                                </div>
                            </div>
                            <input type="file" name="invoice_logo" id="invoiceLogoInput" 
                                class="form-control" style="display: none;"
                                onchange="displayFileName('invoiceLogoInput', 'selectedFileNameLogo')">
                        </div>
                        <div class="col-md-5 text-center">
                            <?php if($chk_exst && $chk_exst->invoice_logo): ?>
                                <img src="<?php echo e(url($chk_exst->invoice_logo)); ?>" style="width:100%">
                            <?php else: ?>
                                <img src="<?php echo e(url('public/logo/company.png')); ?>" style="width:100%">
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex">
                        <div class="col-md-7">
                            <label for="autorised_sign" class="form-label">
                                <h5>Authorised Signatory Signature<span class="text-danger">*</span></h5>
                            </label>
                            <div class="custom-file-input-container"
                                onclick="document.getElementById('authorisedSignInput').click();">
                                <div class="custom-file-input">
                                    <span id="selectedFileNameSign">Choose File</span>
                                </div>
                            </div>
                            <input type="file" name="autorised_sign" id="authorisedSignInput" 
                                class="form-control" style="display: none;"
                                onchange="displayFileName('authorisedSignInput', 'selectedFileNameSign')">
                        </div>
                        <div class="col-md-5 text-center">
                            <?php if($chk_exst && $chk_exst->autorised_sign): ?>
                                <img src="<?php echo e(url($chk_exst->autorised_sign)); ?>" height="50px" width="50px">
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="form-group mb-0 border-right-0">
                                <label for="status" class="form-label">
                                    <h5 class=" mb-0">Post-Deadline Mail Frequency<span class="text-danger">*</span></h5>
                                </label>
                                <select required name="reminder_type" id="reminder_type" class="form-control " style="border-radius: 5px 0px 0px 5px;">
                                    <option value="0" <?php if($chk_exst && $chk_exst->reminder_type == 0): ?> selected <?php endif; ?> >Send Reminder Before</option>
                                    <option value="1" <?php if($chk_exst && $chk_exst->reminder_type == 1): ?> selected <?php endif; ?>>Send Reminder After</option>
                                </select>
                            </div>
                            <input type="number" required name="reminder_days" id="reminder_days" class="form-control height-35 f-14" min="0" autocomplete="off"
                            <?php if($chk_exst && $chk_exst->reminder_type == 0): ?> 
                                value="<?php echo e($chk_exst->send_reminder_before); ?>"
                            <?php else: ?>
                                value="<?php echo e($chk_exst->send_reminder_after); ?>"
                            <?php endif; ?>
                            />
                            <div class="input-group-append">
                                <span class="input-group-text height-35 bg-white border-grey">Day(s)</span>
                            </div>
                        </div>
                    </div>
               
                    <div class="col-md-6">
                        <label for="User_ip_address" class="form-label">
                            <h5 class=" mb-0">Reminder Frequency<span class="text-danger">*</span>
                            </h5>
                        </label>
                        <br>
                        <div class="input-group">
                            <input type="number"
                                <?php if($chk_exst && $chk_exst->reminder_frequency): ?> value="<?php echo e($chk_exst->reminder_frequency); ?>" <?php endif; ?>
                                name="reminder_frequency" id="reminder_frequency" required
                                class="form-control height-35 f-14" min="0" autocomplete="off">
                            <div class="input-group-append">
                                <span class="input-group-text height-35 bg-white border-grey">Day(s)</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-lg-4 mt-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="show_status" <?php if($chk_exst && $chk_exst->show_status): ?> checked="" <?php endif; ?>
                                id="show_status" autocomplete="off">
                            <label
                                class="form-check-label form_custom_label text-dark-grey pl-2 mr-3 justify-content-start cursor-pointer checkmark-20 pt-1 text-wrap"
                                for="show_status">
                                Show Status
                                &nbsp;
                                <i class="fa fa-question-circle" data-toggle="popover" data-placement="top"
                                    data-html="true"
                                    data-content="This will show the invoice status (paid/unpaid/partial paid) on the invoice pdf"
                                    data-trigger="hover"></i>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <h5 class="heading-h4">Client info to show on invoice</h5>
                    </div>
                    <div class="col-lg-4 mt-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="show_client_name" <?php if($chk_exst && $chk_exst->show_client_name): ?> checked="" <?php endif; ?>
                                id="show_client_name" autocomplete="off">
                            <label
                                class="form-check-label form_custom_label text-dark-grey pl-2 mr-3 justify-content-start cursor-pointer checkmark-20 pt-1 text-wrap"
                                for="show_client_name">
                                Client Name
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-4 mt-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="show_client_email" <?php if($chk_exst && $chk_exst->show_client_email): ?> checked="" <?php endif; ?>
                                id="show_client_email" autocomplete="off">
                            <label
                                class="form-check-label form_custom_label text-dark-grey pl-2 mr-3 justify-content-start cursor-pointer checkmark-20 pt-1 text-wrap"
                                for="show_client_email">
                                Client Email
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-4 mt-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="show_client_phone" <?php if($chk_exst && $chk_exst->show_client_phone): ?> checked="" <?php endif; ?>
                                id="show_client_phone" autocomplete="off">
                            <label
                                class="form-check-label form_custom_label text-dark-grey pl-2 mr-3 justify-content-start cursor-pointer checkmark-20 pt-1 text-wrap"
                                for="show_client_phone">
                                Client Phone
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-4 mt-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="show_client_company_name"
                                <?php if($chk_exst && $chk_exst->show_client_company_name): ?> checked="" <?php endif; ?> id="show_client_company_name" autocomplete="off">
                            <label
                                class="form-check-label form_custom_label text-dark-grey pl-2 mr-3 justify-content-start cursor-pointer checkmark-20 pt-1 text-wrap"
                                for="show_client_company_name">
                                Client Company Name
                            </label>
                        </div>
                    </div>
                    <div class="col-lg-4 mt-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="show_client_company_address"
                                <?php if($chk_exst && $chk_exst->show_client_company_address): ?> checked="" <?php endif; ?> id="show_client_company_address" autocomplete="off">
                            <label
                                class="form-check-label form_custom_label text-dark-grey pl-2 mr-3 justify-content-start cursor-pointer checkmark-20 pt-1 text-wrap"
                                for="show_client_company_address">
                                Client Address
                            </label>
                        </div>
                    </div>

                    <div class="col-lg-12 mt-3">
                        <div class="form-group my-3">
                            <div class="form-group my-3 mr-0 mr-lg-2 mr-md-2">
                                <label class="f-14 mb-1 text-dark-grey mb-12" data-label="" for="invoice_terms">Terms and
                                    Conditions
                                </label>

                                <textarea class="form-control f-14 pt-2" rows="3" required placeholder="Enter invoice terms" name="invoice_terms" id="invoice_terms"><?php if($chk_exst && $chk_exst->invoice_terms): ?><?php echo e($chk_exst->invoice_terms); ?><?php endif; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 ">
                        <div class="form-group my-3">
                            <div class="form-group my-3 mr-0 mr-lg-2 mr-md-2">
                                <label class="f-14 mb-1 text-dark-grey mb-12" data-label="" for="other_info">Other
                                    information
                                </label>

                                <textarea class="form-control f-14 pt-2" required rows="3" placeholder="Enter Other Information" name="other_info" id="other_info"><?php if($chk_exst && $chk_exst->other_info): ?><?php echo e($chk_exst->other_info); ?><?php endif; ?></textarea>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer">
                <div class="row mb-4">
                    <!-- <div class="col-md-6 text-end">
                        <a href="<?php echo e(url('admin/InvoiceSettings/home')); ?>" type="button"
                            class="btn btn-outline-danger">Discard</a>
                    </div> -->
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


</div>
</div>

<script>
    function displayFileName(inputId, displayId) {
        var input = document.getElementById(inputId);
        var display = document.getElementById(displayId);
        var fileName = input.files[0].name;
        display.innerText = fileName;
    }
</script>
<script>
    function checkPass() {
        var passwordInput = $('#password').val();
        var userId = $('#log_user_id').val();

        // Perform any client-side validation if needed

        // Example: Check if the password is not empty
        if (passwordInput.trim() === "") {
            alert("Please enter your password.");
            return;
        }

        // You can perform additional client-side logic here if needed

        // Perform AJAX request to check the password on the server side
        $.ajax({
            url: "<?php echo e(url('admin/SecuritySettings/confirm_password')); ?>",
            type: "POST",
            data: {
                password: passwordInput,
                user_id: userId,
                _token: "<?php echo e(csrf_token()); ?>"
            },
            success: function(response) {
                if (response.status === 'success') {
                    console.log('Password is correct');
                    $("#err_msg").text('');
                    $("#password").val('');
                    $("#disabl").show(); // Show the enable button
                    $('#backDropModal').modal('hide');
                } else {
                    $("#disabl").hide(); // Hide the enable button
                    $("#err_msg").text('Password is incorrect. Please enter the correct password.');
                }
            },
            error: function(error) {
                $("#disabl").show(); // Show the enable button in case of an error
                console.log('Error:', error);
            }
        });
    }

    $(document).ready(function() {
        $('#submit-login').on('click', function() {
            var passwordInput = $('#password').val();

            // Perform AJAX request to check the password against the database
            $.ajax({
                url: "",
                type: "POST",
                data: {
                    password: passwordInput,
                    _token: "<?php echo e(csrf_token()); ?>"
                },
                success: function(response) {
                    // Handle the response from the server
                    if (response.success) {
                        // Password is correct, proceed with further actions
                        // You can update this part based on your application's logic
                        console.log('Password is correct');
                    } else {
                        // Password is incorrect, show an error message or take appropriate action
                        console.log('Password is incorrect');
                    }
                },
                error: function(error) {
                    console.log('Error:', error);
                }
            });
        });
    });


    $(document).ready(function() {
        $('.toggle-password').on('click', function() {
            var passwordInput = $('#password');
            var icon = $(this).find('i');
            // Toggle the type attribute of the password input
            if (passwordInput.attr('type') === 'password') {
                passwordInput.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                passwordInput.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
    });

    function BulkMail(value) {
        var type = "Bulk";
        $.ajax({
            url: "<?php echo e(url('admin/MailSettings/MailViaUpdate')); ?>",
            type: "get",
            data: {
                value: value,
                type: type,
                _token: "<?php echo e(csrf_token()); ?>"
            },
            success: function(response) {
                location.reload();
            },
            error: function(error) {
                console.log('Error:', error);
            }
        });
    }

    function Completemailsetup(value) {
        var type = "Complete";
        $.ajax({
            url: "<?php echo e(url('admin/MailSettings/MailViaUpdate')); ?>",
            type: "get",
            data: {
                value: value,
                type: type,
                _token: "<?php echo e(csrf_token()); ?>"
            },
            success: function(response) {
                location.reload();
            },
            error: function(error) {
                console.log('Error:', error);
            }
        });
    }
</script>
<?php /**PATH /home/insighthub/public_html/resources/views/admin/settings/InvoiceSettings/home.blade.php ENDPATH**/ ?>