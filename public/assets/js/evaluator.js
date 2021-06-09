// Page Nav Script
$(document).ready(function() {
    if (location.hash) {
        $("a[href='" + location.hash + "']").tab("show");
    }
    $(document.body).on("click", "a[data-toggle='tab']", function(event) {
        location.hash = this.getAttribute("href");
    });
});
$(window).on("popstate", function() {
    let anchor = location.hash || $("a[data-toggle='tab']").first().attr("href");
    $("a[href='" + anchor + "']").tab("show");
});

// Show/hide Form Password
const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#password');
togglePassword.addEventListener('click', function (e) {
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    this.classList.toggle('fa-eye-slash');
});

//Modal Form
$(document).ready(function() {
    $('a.btn-success').click(function () {
//On initialise les modales materialize
        $('.update').modal();
        var url = $(this).attr('data-bs-target');
        $.get(url, function (data) {
            //on injecte le html dans la modale
            $('#update-form').html(data);
            //on ouvre la modale
            $('#update').modal('show');
        });
    });
});

