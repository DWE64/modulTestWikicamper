import $ from 'jquery';
$(document).ready(function() {
    $('.form_Search_action').on('submit', function(e) {
        e.preventDefault();
        console.log('Form submitted');
        var $form = $(this);
        $.ajax({
            url: $form.attr('action'),
            method: 'POST',
            data: $form.serialize(),
            dataType: 'json',
            success: function(data) {
                var html = '';
                data.forEach(function(rental) {
                    html += '<div class="row bg-light border rounded my-2 py-2">' +
                        '<div class="col-3">' +
                        '<img src="/upload/picture/' + rental.filename + '" alt="Image" class="img-fluid"/>' +
                        '</div>' +
                        '<div class="col-7">' +
                        '<h2>' + rental.title + '</h2>' +
                        '<p>' + rental.describe + '</p>' +
                        '</div>' +
                        '<div class="col-2 text-center">' +
                        '<a href="/rental/' + rental.id + '" class="btn btn-primary">Voir</a>' +
                        '</div>' +
                        '</div>';
                });
                $('.result').html(html);
            },
            error: function(jqXHR) {
                console.log(jqXHR);
            }
        });
    });
});