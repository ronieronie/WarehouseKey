<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warehouse Key</title>
    <link rel="icon" href="{{ asset('img/CH_ICON1.ico') }}">

    <!-- Bootstrap CSS -->
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- DataTables Bootstrap 5 CSS -->
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg" style="background-color: #d12f24; box-shadow: 0 2px 10px rgba(0,0,0,0.1); ">
        <div class="container">
            <img src="{{ asset('img/ch_logo1.PNG') }}" alt="" style="border-radius: 10px; width: 15%; height: auto;">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#" style="color: white">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" style="color: white">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        <div class="card-body p-4">
            <form id="keyForm" class="form-section">
                <div class="d-flex justify-content-between align-items-center">
                    <h5>Warehouse Key</h5>
                    <button type="button" class="btn btn-danger" style="background-color: #d12f24"
                        id="add_record_btn">Add Record</button>
                </div>
                <div class="row g-3">
                    <div class="col-12 col-md-6 col-lg-3">
                        <label for="dateInput" class="form-label">Date</label>
                        <input type="date" class="form-control" id="dateInput" required />
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <label for="nameInput" class="form-label">Name</label>
                        <input type="text" class="form-control" id="nameInput" placeholder="Enter name" required />
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <label for="timeInInput" class="form-label">Time Borrowed</label>
                        <input type="time" class="form-control" id="timeInInput" step="60" required />
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <label for="timeOutInput" class="form-label">Time Returned</label>
                        <input type="time" class="form-control" id="timeOutInput" step="60" disabled />
                    </div>
                </div>

            </form>
            <br>
            <br>
            <div class="table-responsive">
                <table id="BorrowerTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Time Borrowed</th>
                            <th>Time Returned</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="update_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <input type="text" class="form-control" id="id" hidden />
                        <div class="form-group">
                            <label for="dateInput" class="form-label">Date</label>
                            <input type="date" class="form-control" id="update_date" required />
                        </div>

                        <div class="form-group">
                            <label for="dateInput" class="form-label">Name</label>
                            <input type="text" class="form-control" id="update_name" required />
                        </div>

                        <div class="form-group">
                            <label for="dateInput" class="form-label">Time Borrowed</label>
                            <input type="text" class="form-control" id="update_time_borrowed" step="60" required />
                        </div>

                        <div class="form-group">
                            <label for="dateInput" class="form-label">Time Returned</label>
                            <input type="time" class="form-control" id="update_time_returned" step="60" required />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="update_btn">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <!-- DataTables Bootstrap 5 JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>

    <script>

    </script>

    <script>
        function convertTo12Hr(time) {
            return new Date('1970-01-01T' + time).toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            });
        }

        $(document).ready(function () {
            $('#BorrowerTable').DataTable({
                destroy: true,
                serverSide: false,
                processing: false,
                ajax: {
                    url: '{{ route('get_borrowers') }}',
                    type: 'GET', //if GET, no need for csrf token
                    // data: {_token:'{{ csrf_token() }}'} 

                },
                columns: [{
                    data: 'id'
                },
                {
                    data: 'date_borrowed'
                },
                {
                    data: 'name'
                },
                {
                    data: 'time_borrowed'
                },
                {
                    data: 'time_return'
                },
                {
                    data: 'action'
                }]
            });


        });

        $(document).on('click', '#add_record_btn', function () {
            var name = $("#nameInput").val();
            var date_borrowed = $("#dateInput").val();
            var time_borrowed = convertTo12Hr($("#timeInInput").val());
            var time_return = "Pending";

            $.ajax({
                url: '{{ route('add_borrower') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    name, date_borrowed, time_borrowed, time_return
                },
                success: function (response) {
                    $('#BorrowerTable').DataTable().ajax.reload();
                },
                error: function (xhr) {
                    var response = JSON.parse(xhr.responseText);
                    Swal.fire({
                        title: "Warning!",
                        text: response.message,
                        icon: "warning",
                    });
                }
            })
        });

        $(document).on('click', '.btn_update', function () {
            var time_borrowed = $(this).data('time_borrowed')

            $('#update_modal').modal('show');
            $('#id').val($(this).data('id'));
            $('#update_date').val($(this).data('date'));
            $('#update_name').val($(this).data('name'));
            // $('#update_time_borrowed').val(convertTo12Hr($(this).data('time_borrowed')));
            $('#update_time_borrowed').val(time_borrowed);
            $('#update_time_returned').val($(this).data('time_return'));
        });

        $(document).on('click', '#update_btn', function () {
            $('#update_modal').modal('hide');
            var id = $("#id").val();
            var name = $("#update_name").val();
            var date_borrowed = $("#update_date").val();
            var time_borrowed = $("#update_time_borrowed").val();
            var time_return = convertTo12Hr($("#update_time_returned").val());

            $.ajax({
                url: '{{ route('update_borrower') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id, name, date_borrowed, time_borrowed, time_return
                },
                success: function (response) {
                    Swal.fire({
                        title: "Success!",
                        text: "Record has been updated",
                        icon: "success",
                    });
                    $('#BorrowerTable').DataTable().ajax.reload();
                }
            })
        });

        $(document).on('click', '.btn_delete', function () {
            var delete_id = $(this).data('id');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('delete_borrower') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            delete_id
                        },
                        success: function (response) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Record has been deleted.",
                                icon: "success"
                            });
                            $('#BorrowerTable').DataTable().ajax.reload();
                        }
                    })

                }
            });

        });


    </script>

</body>

</html>