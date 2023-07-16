import './bootstrap';
import 'laravel-datatables-vite';

$(document).ready(function (){
    window.csrfToken = $('meta[name="csrf-token"]').attr('content');
    let table = $('#episodes');

    table.on('click', 'tbody tr', function () {
        table = new DataTable('#episodes');

        let id = $(this).attr('id');

        $.ajax({
            beforeSend: function (request) {
                request.setRequestHeader("X-CSRF-TOKEN", csrf_token());
            },
            method: "POST",
            url: '/episodes/get_characters',
            data: {
                id: id
            }
        })
            .done(function (response) {
                let modalDiv = $('#episodeModal');

                let tbody = modalDiv.find('table#characterTable tbody');
                tbody.children().remove();

                let modal = new bootstrap.Modal(modalDiv);

                $.each(response, function (index, item) {
                   let row = '<tr id="' + item.id_character + '">';
                   row += '<td>' + item.id_character + '</td>';
                   row += '<td>' + item.name + '</td>';
                   row += '<td>' + item.status + '</td>';
                   row += '<td>' + item.species + '</td>';
                   row += '<td>' + item.type + '</td>';
                   row += '<td>' + item.gender + '</td>';
                   row += '</tr>';

                   tbody.append(row);
                });

                modal.show();
            })
            .fail(function (response) {
                console.log(response);
            });


    });

    $('.close-modal').on('click', function () {
        let modal = $(this).closest('div.modal');

        modal.hide();
        $('.modal-backdrop').remove();
    });

    /**
     * Get actual Laravel csrf token
     * @returns {string}
     */
    function csrf_token() {
        if (window.csrfToken === undefined) {
            console.error('CSRF token not found. Document ready has gone? You have csrf-token meta element?')
        }
        return window.csrfToken;
    }
});


