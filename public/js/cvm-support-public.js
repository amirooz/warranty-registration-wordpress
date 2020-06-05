jQuery(document).ready(function(){
    // add product
    jQuery('#productRegisterForm').validate({
        submitHandler:function(){
            var postData = jQuery('#productRegisterForm').serialize() + '&action=cvm_warranty_request&param=save_support';
            jQuery.post(proregistration_public, postData, function(response){
                console.log('ok');return;
                var data = jQuery.parseJSON(response);
                if(data.status == 1){
                    alert(data.message);
                } else {
                    alert(data.message);
                }
                location.reload();
            });
        }
    });

});
