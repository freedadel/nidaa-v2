$('#edit').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var title = button.data('mytitle')
    var description = button.data('mydescription')
    var status = button.data('mystatus')
    var cat_id = button.data('catid')
    var modal = $(this)

    modal.find('.modal-body #title').val(title);
    modal.find('.modal-body #des').val(description);
    modal.find('.modal-body #status').val(status);
    modal.find('.modal-body #cat_id').val(cat_id);
    })

    $('#view').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget)
    var title = button.data('mytitle')
    var description = button.data('mydescription')
    var status = button.data('mystatus')
    var cat_id = button.data('catid')
    var modal = $(this)

    modal.find('.modal-body #title').val(title);
    modal.find('.modal-body #des').val(description);
    modal.find('.modal-body #status').val(status);
    modal.find('.modal-body #cat_id').val(cat_id);
    })

    $('#delete').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget)

    var cat_id = button.data('catid')
    var modal = $(this)

    modal.find('.modal-body #cat_id').val(cat_id);
    })

    /* Gallary */

    $('#EditGallary').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var title = button.data('mytitle')
        var body = button.data('mybody')
        var status = button.data('mystatus')
        var gallary_id = button.data('gallarid')
        var modal = $(this)

        modal.find('.modal-body #title').val(title);
        modal.find('.modal-body #bod').val(body);
        modal.find('.modal-body #status').val(status);
        modal.find('.modal-body #gallary_id').val(gallary_id);
        })

        $('#DeleteGallary').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget)

        var gallary_id = button.data('gallarid')
        var modal = $(this)

        modal.find('.modal-body #gallary_id').val(gallary_id);
        })


          /* Users */

    $('#EditUser').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var name = button.data('myname')
        var email = button.data('myemail')
        var type = button.data('mytype')
        var pass = button.data('mypassword')
        var user_id = button.data('userid')
        var modal = $(this)

        modal.find('.modal-body #name').val(name);
        modal.find('.modal-body #email').val(email);
        modal.find('.modal-body #type').val(type);
        modal.find('.modal-body #password').val(pass);
        modal.find('.modal-body #us_id').val(user_id);
        })

        $('#DeleteUser').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget)

        var user_id = button.data('userid')
        var modal = $(this)

        modal.find('.modal-body #us_id').val(user_id);
        })
