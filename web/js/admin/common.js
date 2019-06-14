$(document).on('click', 'a[data-toggle=\'image\']', function(e) {
    e.preventDefault();

    var $element = $(this);
    var $popover = $element.data('bs.popover'); // Element has bs popover?


    // Destroy all image popovers
    $('a[data-toggle="image"]').popover('destroy');

    // Remove flickering (do not re-add popover when clicking for removal)
    if ($popover) {
        return;
    }

    var languageId = $element.data('language-id');
    var rowId = $element.data('row-id');

    $element.popover({
        html: true,
        placement: 'right',
        trigger: 'manual',
        content: function() {
            return '<label for="input-file-image-' + languageId + '-' + rowId + '" id="button-image" class="btn btn-primary"><i class="fa fa-pencil"></i></label> <button type="button" id="button-clear" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>';
        }
    });

    $element.popover('show');

    $('#button-image').on('click', function() {
        $element.popover('destroy');
    });

    $('#button-clear').on('click', function() {
        $element.find('img').attr('src', $element.find('img').attr('data-placeholder'));

        $element.parent().find('input').val('');

        $element.popover('destroy');
    });
});

$(document).on('click', 'a[data-toggle=\'product-image\']', function(e) {
    e.preventDefault();

    var $element = $(this);
    var $popover = $element.data('bs.popover'); // Element has bs popover?


    // Destroy all image popovers
    $('a[data-toggle="product-image"]').popover('destroy');

    // Remove flickering (do not re-add popover when clicking for removal)
    if ($popover) {
        return;
    }

    $element.popover({
        html: true,
        placement: 'right',
        trigger: 'manual',
        content: function() {
            return '<label for="input-file-image" id="button-image" class="btn btn-primary"><i class="fa fa-pencil"></i></label> <button type="button" id="button-clear" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>';
        }
    });

    $element.popover('show');

    $('#button-image').on('click', function() {
        $element.popover('destroy');
    });

    $('#button-clear').on('click', function() {
        $element.find('img').attr('src', $element.find('img').attr('data-placeholder'));

        $element.parent().find('input').val('');

        $element.popover('destroy');
    });
});

$(document).on('click', 'a[data-toggle=\'product-additional-image\']', function(e) {
    e.preventDefault();

    var $element = $(this);
    var $popover = $element.data('bs.popover'); // Element has bs popover?


    // Destroy all image popovers
    $('a[data-toggle="product-additional-image"]').popover('destroy');

    // Remove flickering (do not re-add popover when clicking for removal)
    if ($popover) {
        return;
    }

    var rowId = $element.data('row-id');

    $element.popover({
        html: true,
        placement: 'right',
        trigger: 'manual',
        content: function() {
            return '<label for="input-file-image-' + rowId + '" id="button-image" class="btn btn-primary"><i class="fa fa-pencil"></i></label> <button type="button" id="button-clear" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>';
        }
    });

    $element.popover('show');

    $('#button-image').on('click', function() {
        $element.popover('destroy');
    });

    $('#button-clear').on('click', function() {
        $element.find('img').attr('src', $element.find('img').attr('data-placeholder'));

        $element.parent().find('input').val('');

        $element.popover('destroy');
    });
});

$(document).on('click', 'a[data-toggle=\'design-favicon-image\']', function(e) {
    e.preventDefault();

    var $element = $(this);
    var $popover = $element.data('bs.popover'); // Element has bs popover?


    // Destroy all image popovers
    $('a[data-toggle="design-favicon-image"]').popover('destroy');

    // Remove flickering (do not re-add popover when clicking for removal)
    if ($popover) {
        return;
    }

    $element.popover({
        html: true,
        placement: 'right',
        trigger: 'manual',
        content: function() {
            return '<label for="input-file-image" id="button-image" class="btn btn-primary"><i class="fa fa-pencil"></i></label> <button type="button" id="button-clear" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>';
        }
    });

    $element.popover('show');

    $('#button-image').on('click', function() {
        $element.popover('destroy');
    });

    $('#button-clear').on('click', function() {
        $element.find('img').attr('src', $element.find('img').attr('data-placeholder'));

        $element.parent().find('input').val('');

        $element.popover('destroy');
    });
});

$(document).on('click', 'a[data-toggle=\'review-image\']', function(e) {
    e.preventDefault();

    var $element = $(this);
    var $popover = $element.data('bs.popover'); // Element has bs popover?


    // Destroy all image popovers
    $('a[data-toggle="review-image"]').popover('destroy');

    // Remove flickering (do not re-add popover when clicking for removal)
    if ($popover) {
        return;
    }

    $element.popover({
        html: true,
        placement: 'right',
        trigger: 'manual',
        content: function() {
            return '<label for="input-file-image" id="button-image" class="btn btn-primary"><i class="fa fa-pencil"></i></label> <button type="button" id="button-clear" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>';
        }
    });

    $element.popover('show');

    $('#button-image').on('click', function() {
        $element.popover('destroy');
    });

    $('#button-clear').on('click', function() {
        $element.find('img').attr('src', $element.find('img').attr('data-placeholder'));

        $element.parent().find('input').val('');

        $element.popover('destroy');
    });
});