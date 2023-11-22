$(document).ready(function () {
    $('.btnDelete').on('click', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure!',
            text: 'Do you want to continue',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes'
        }).then((result) => {
            if(result.isConfirmed){
                $(e.target).closest('form').submit();
            }
        });
    })
});
