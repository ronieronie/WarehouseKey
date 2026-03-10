<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Warehouse Key</title>
    <link rel="icon" href="{{ asset('img/CH_ICON1.ico') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #fde0de;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 2.5rem 2.5rem;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
        }

        .form-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #0f172a;
            text-align: center;
            margin-bottom: 1.75rem;
        }

        .form-label {
            font-size: 0.9rem;
            font-weight: 500;
            color: #0f172a;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .form-label i {
            font-size: 1rem;
            color: #0f172a;
        }

        .form-control {
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
            color: #0f172a;
            background: #fff;
            font-family: 'Inter', sans-serif;
            transition: border-color 0.2s, box-shadow 0.2s;
            margin-bottom: 1.25rem;
        }

        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            outline: none;
        }

        .form-control::placeholder {
            color: #cbd5e1;
        }

        .btn-submit {
            width: 100%;
            padding: 0.85rem;
            background: #d12f24;
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 1rem;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s;
            margin-top: 0.5rem;
        }

        .btn-submit:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .small-swal {
            font-size: 0.85rem !important;
            padding: 1rem !important;
        }
    </style>
</head>

<body style="padding: 20px;">

    <div class="form-card">

        <center><img src="{{ asset('img/ch_logo1.PNG') }}" alt="" style="border-radius: 10px;"></center>
        <center>
            <h5 style="padding: 10px">Borrowing Tracker Form</h5>
        </center>

        <form>
            <!-- Name -->
            <label class="form-label">
                <i class="bi bi-person"></i> Name
            </label>
            <input type="text" class="form-control" name="name" id="nameInput" placeholder="Enter your name" required/>

            <!-- Date Borrowed -->
            <label class="form-label">
                <i class="bi bi-calendar3"></i> Date Borrowed
            </label>
            <input type="date" class="form-control" name="date_borrowed" id="dateInput" required />

            <!-- Time Borrowed -->
            <label class="form-label">
                <i class="bi bi-clock"></i> Time Borrowed
            </label>
            <input type="time" class="form-control" name="time_borrowed" id="timeInInput" required />

            <!-- Time Returned -->
            <!-- <label class="form-label">
                <i class="bi bi-camera"></i> Photo
            </label>
            <input type="file" class="form-control" name="photo" accept="image/*" capture="environment" required /> -->
            <!-- Submit -->
            <button type="button" class="btn-submit" id="submit_btn">Submit</button>

        </form>
    </div>
</body>

</html>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        const now = new Date();

        // Format date as YYYY-MM-DD
        const date = now.toLocaleDateString('en-CA'); // gives YYYY-MM-DD format

        // Format time as HH:MM
        const time = now.toTimeString().slice(0, 5); // gives HH:MM format

        $('#dateInput').val(date);
        $('#timeInInput').val(time);
    });
    function convertTo12Hr(time) {
        return new Date('1970-01-01T' + time).toLocaleTimeString('en-US', {
            hour: '2-digit',
            minute: '2-digit',
            hour12: true
        });
    }

    $(document).on('click', '#submit_btn', function () {
        var name = $("#nameInput").val();
        var date_borrowed = $("#dateInput").val();
        var time_borrowed = convertTo12Hr($("#timeInInput").val());
        var time_return = 'Pending';

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes",
            cancelButtonText: "Cancel",
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            width: '400px',
            padding: '2rem',
            customClass: {
                confirmButton: 'btn btn-primary px-4',
                cancelButton: 'btn btn-danger px-4',
                actions: 'gap-2',
                title: 'fs-4',
                htmlContainer: 'fs-6'
            },
            buttonsStyling: false,
        }).then((result) => {
            if (result.isConfirmed) {

                // 👇 Show loading here
                Swal.fire({
                    title: 'Submitting...',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    width: '400px',
                    padding: '1rem',
                    customClass: {
                        title: 'fs-4', // 👈
                    },
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: '{{ route("add_borrower") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        name, date_borrowed, time_borrowed, time_return
                    },
                    success: function (response) {
                        Swal.fire({
                            title: "Success!",
                            text: "Record has been submitted.",
                            icon: "success",
                            confirmButtonText: "OK",
                            confirmButtonColor: "#3085d6",
                            width: '400px',
                            padding: '2rem',
                            customClass: {
                                confirmButton: 'btn btn-primary btn-sm px-4',
                                title: 'fs-4',
                                htmlContainer: 'fs-6'
                            },
                            buttonsStyling: false,
                        });
                        $("#nameInput").val('');
                        $("#dateInput").val('');
                        $("#timeInInput").val('');
                        $('#BorrowerTable').DataTable().ajax.reload();
                    },
                    error: function (xhr) {
                        var response = JSON.parse(xhr.responseText);
                        Swal.fire({  // 👈 Replaces loading automatically
                            title: "Warning!",
                            text: response.message,
                            icon: "warning",
                            width: '300px',
                        });
                    }
                });
            }
        });
    });

</script>