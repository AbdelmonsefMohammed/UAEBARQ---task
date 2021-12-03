jQuery(document).ready(function($){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    //----- Open model CREATE -----//
    jQuery('#btn-add').click(function () {
        jQuery('#btn-save').val("add");
        jQuery('#myForm').trigger("reset");
        jQuery('#formModal').modal('show');
        jQuery('#form-errors').empty();
    });

    // Edit

    $('body').on('click', '.edit-task', function () {
        let task_id = $(this).data('id');
        
        $.get('tasks/'+task_id+'/edit', function (data) {
            jQuery('#formModalLabel').text("Edit Task");
            jQuery('#btn-save').val("edit");
            jQuery('#formModal').modal('show');
            jQuery('#form-errors').empty();
            jQuery('#task_id').val(data.id);
            jQuery('#title').val(data.title);
            jQuery('#description').val(data.description);  
        })
     });

         // STORE / UPDATE
    $("#btn-save").click(function (e) {
        e.preventDefault();
        let formData = {
            title: jQuery('#title').val(),
            description: jQuery('#description').val(),
        };
        let task_id = jQuery('#task_id').val();
        let state = jQuery('#btn-save').val();
        let type = '';
        let ajaxurl = '';
        if (state  == "add") {
            type = "POST";
            ajaxurl = 'tasks';
        }else{
            type = "PUT";
            ajaxurl = 'tasks/'+task_id;
        }
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                let task = `<tr id='task${data.id}'>
                                <td>-</td>
                                <td> ${data.user.name}</td>
                                <td> ${data.title}</td>
                                <td> ${data.description}</td>
                                <td>
                                    <button type="button" class="btn btn-primary edit-task" id="btn-edit" data-id="${data.id}" value="edit">Edit</button>
                                    <button type="button" class="btn btn-danger delete-task" id="btn-delete" data-id="${data.id}" value="delete">Delete</button>
                                </td>
                            </tr>`
                if (state == "add") {
                    jQuery('#tasks-list').prepend(task);
                } else {
                    jQuery("#task" + task_id).replaceWith(task);
                }
                jQuery('#myForm').trigger("reset");
                jQuery('#formModal').modal('hide')
            },
            error: function (data) {
                let errors = data.responseJSON;

                 let errorsHtml = '<div class="alert alert-danger"><ul>';

                 $.each( errors.errors, function( key, value ) {
                      errorsHtml += '<li>'+ value + '</li>';
                 });
                 errorsHtml += '</ul></div>';

                 $( '#form-errors' ).html( errorsHtml );
            }
        });
    });

    // Delete
    $('body').on('click', '.delete-task', function () {
        let task_id = $(this).data("id");
        let type = "DELETE";
        let ajaxurl = 'tasks/' + task_id;
        confirm("Are You sure want to delete !");
        $.ajax({
            type: type,
            url: ajaxurl,
            success: function (data) {
                $("#task" + task_id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });  
});