$(function() {
    $('.delete').click(function () {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success ml-2',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Czy na pewno chcesz to usunąć?',
            text: "Nie będziesz mógł tego przywrócić!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Tak, usuń to!',
            cancelButtonText: 'Nie, zatrzymaj!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: "DELETE",
                    url: deleteUrl + $(this).data('id')
                })
                    .done(function (data) {
                        window.location.reload();
                    })
                    .fail(function(data) {
                        swalWithBootstrapButtons.fire('Oops...', data.responseJSON.message, data.responseJSON.status)
                    })
                swalWithBootstrapButtons.fire('Usunięto!', 'Element został usunięty prawidłowo.', 'success')
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire('Zatrzymano!', 'Element nie został usunięty, jesteś bezpieczny.', 'error')
            }
        })
    });
});
