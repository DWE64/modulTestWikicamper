import jQuery from 'jquery';
import * as bootstrap from "bootstrap";

(function (window, $) {
    window.ContactApp = function ($wrapper) {
        this.$wrapper = $wrapper;

        this.$wrapper.on(
            'submit',
            '.form_contact_action',
            this.handleFormContactSubmit.bind(this)
        );
    };

    $.extend(window.ContactApp.prototype, {

        //listener pour form contact
        handleFormContactSubmit: function (e) {
            e.preventDefault();
            var $form = $(e.currentTarget);
            $.ajax({
                url: $form.attr('action'),
                method: 'POST',
                data: $form.serialize(),
                dataType: 'json',
                success: function (data) {
                    var newModal = new bootstrap.Modal('#success-alert-modal',{show: true});
                    newModal.show();
                    $('#successSending').text(data.message);
                },
                error: function (jqXHR) {
                    var newModal = new bootstrap.Modal('#danger-alert-modal',{show: true});
                    newModal.show();
                    $('#errorSending').text(jqXHR.message);
                }
            });
        },
    });


})(window, jQuery);
