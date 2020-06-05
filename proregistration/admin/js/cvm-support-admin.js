jQuery(document).ready(function(){
    // delete item
    jQuery('.deleteItem').on('click', function(){
        var conf = confirm('Are you sure want to delete?');
        if(conf){
            var dataId = jQuery(this).attr('data-id');
            var postData = "action=cvm_request&param=delete_item&id=" + dataId;
            jQuery.post(proregistration_admin, postData, function(response){
                var data = jQuery.parseJSON(response);
                if(data.status == 1){
                    alert(data.message);
                    setTimeout(function(){
                        location.reload()
                    },1000);
                } else {
                    alert(data.message);
                }
            });
        }
    })

    jQuery('#addSupprtForm').validate({
        submitHandler:function(){
            var postData = jQuery('#addSupprtForm').serialize() + '&action=cvm_request&param=save_support';
            jQuery.post(proregistration_admin, postData, function(response){
                var data = jQuery.parseJSON(response);
                if(data.status == 1){
                    alert(data.message);
                    setTimeout(function(){
                        location.reload()
                    },1000);
                } else {
                    alert(data.message);
                }
                location.reload();
            });
        }
    });

    jQuery('#invoice-upload').on('click', function(){
        var image = wp.media({
            title: 'Upload Invoice',
            multiple: false
        }).open().on('select', function(){
            var files = image.state().get('selection').first();
            var jsonFiles = files.toJSON();
            jQuery('#media-image').attr('src', jsonFiles.url);
            jQuery('#invoice').val(jsonFiles.url);
        });
    });
});
