(function($) {    var $formGroup = $('#form-admin-group'), $formUser = $('#form-admin-user');    //select users for group    $('.select2').select2();    //form create group on submit    $('#btn-submit-group').on('click', function(e) {        var users = $formGroup.find('#group-select-users').val();        var $inputUsers = $("<input>")                .attr("type", "hidden")                .attr("name", "users").val(users);        $formGroup.append($inputUsers).submit();        e.preventDefault();    });    $('#btn-submit-user').on('click', function(e) {        var groups = $formUser.find('#user-select-group').val();        var $inputGroups = $("<input>")                .attr("type", "hidden")                .attr("name", "groups").val(groups);        $formUser.append($inputGroups).submit();        e.preventDefault();    });    $('.resource-parent input').on('click', function() {        var $container = $(this).parents('.resource-group');        var checkStatus = $(this).prop('checked');        $container.find('ul.resource-children input').each(function() {            $(this).prop('checked', checkStatus);        });    });    $(document).on('click', 'a[data-method="delete"]', function() {        var dataConfirm = $(this).attr('data-confirm');        if (typeof dataConfirm === 'undefined') {            dataConfirm = 'Are you sure ?';        }        var token = dataToken;        var action = $(this).attr('href');        if (confirm(dataConfirm)) {            var form =                    $('<form>', {                        'method': 'POST',                        'action': action                    });            var tokenInput =                    $('<input>', {                        'type': 'hidden',                        'name': '_token',                        'value': token                    });            var hiddenInput =                    $('<input>', {                        'name': '_method',                        'type': 'hidden',                        'value': 'delete'                    });            form.append(tokenInput, hiddenInput).hide().appendTo('body').submit();        }        return false;    });})(jQuery);