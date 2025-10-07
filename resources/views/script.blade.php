<script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right"
    };
    $(document).ready(function() {
        fetchContacts();

        $('#searchContact').on('keyup', function() {
            fetchContacts($(this).val());
        });

        function fetchContacts(search = '', page = 1) {
            $.ajax({
                url: fetchContactsRoute + '?search=' + search + '&page=' + page,
                type: "GET",
                success: function(response) {
                    let rows = '';
                    let data = response.data;
                    if (data.length > 0) {
                        $.each(data, function(index, contact) {
                            let editUrl = editContactRoute.replace(':id', contact.id);
                            rows += `
                                <tr>
                                    <td>${contact.contact_name}</td>
                                    <td>${contact.contact_company}</td>
                                    <td>${contact.contact_phone}</td>
                                    <td>${contact.email}</td>
                                    <td>
                                        <a href="${editUrl}" class="btn btn-sm btn-warning">Edit</a>
                                        <button class="btn btn-sm btn-danger deleteContactBtn" data-id="${contact.id}">Delete</button>
                                    </td>
                                </tr>`;
                        });
                    } else {
                        rows = `<tr><td colspan="6" class="text-center">No contacts found</td></tr>`;
                    }
                    $('#contactTableBody').html(rows);

                    let paginationHtml = '';
                    if (response.last_page > 1) {
                        for (let i = 1; i <= response.last_page; i++) {
                            paginationHtml += `<li class="page-item ${i == response.current_page ? 'active' : ''}">
                                <a class="page-link" href="#" data-page="${i}">${i}</a>
                            </li>`;
                        }
                    }
                    $('#paginationLinks').html(paginationHtml);
                },
                error: function() {
                    toastr.error('Failed to load contacts.');
                }
            });
        }

        $(document).on('click', '.page-link', function(e) {
            e.preventDefault();
            const page = $(this).data('page');
            const search = $('#searchContact').val();
            fetchContacts(search, page);
        });

        $(document).on('click', '.deleteContactBtn', function() {
            const id = $(this).data('id');
            const url = deleteContactRoute.replace(':id', id);

            Swal.fire({
                title: 'Are you sure you want to DELETE?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: "DELETE",
                        data: { _token: "{{ csrf_token() }}" },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire('Deleted!', response.message, 'success');
                                fetchContacts();
                            } else {
                                toastr.error(response.message);
                            }
                        },
                        error: function() {
                            toastr.error('Failed to delete contact.');
                        }
                    });
                }
            });
        });
    });

    $(document).ready(function() {
        $('#formphone').on('input', function() {
            let input = $(this).val();

            input = input.replace(/\D/g, '');

            if (input.length > 3 && input.length <= 6) {
                input = '(' + input.substring(0, 3) + ') ' + input.substring(3);
            } else if (input.length > 6) {
                input = '(' + input.substring(0, 3) + ') ' + input.substring(3, 6) + ' ' + input.substring(6, 10);
            }

            $(this).val(input);
        });
    });

</script>