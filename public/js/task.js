jQuery(document).ready(function($){

    //----- Open model CREATE -----//
    jQuery('#btn-add').click(function () {
        jQuery('#btn-save').val("add");
        jQuery('#myForm').trigger("reset");
        jQuery('#formModalCreate').modal('show');
    });

    // CREATE
    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        let formData = {
            title: jQuery('#title').val(),
            description: jQuery('#description').val(),
        };
        let state = jQuery('#btn-save').val();
        let type = "POST";
        let task_id = jQuery('#task_id').val();
        let ajaxurl = 'tasks';

        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                let task = '<tr id="task' + data.id + '"><td>' + data.id + '</td><td>' + data.user.name + '</td><td>' + data.title + '</td><td>' + data.description + '</td>';
                if (state == "add") {
                    jQuery('#tasks-list').append(task);
                } else {
                    jQuery("#task" + task_id).replaceWith(task);
                }
                jQuery('#myForm').trigger("reset");
                jQuery('#formModal').modal('hide')
            },
            error: function (data) {
                console.log(data);
            }
        });
    });
});