@extends('layouts.admin')
@section('title')
    All Schools
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <a href="{{url('/school/new')}}">
                <button type="button" class="btn rounded-pill btn-primary" style="float: right">
                    <span class="tf-icons bx bx-pie-chart-alt"></span>
                    Create New School
                </button>
            </a>
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> @yield('title')</h4>
            <br>
            <div class="card">
                <div class="table-responsive text-nowrap">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID #</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        @foreach($schools as $school)
                            <tr>
                                <td>
                                    <input type="hidden" name="id" value="{{$school->id}}">
                                    <i class="fab fa-bootstrap fa-lg text-primary me-3"></i>
                                    <strong>{{$school->id}}</strong>
                                </td>
                                <td>{{$school->name}}</td>
                                <td>
                                    @if($school->status == '1')
                                        <span class="badge bg-label-primary me-1">
                                            Active
                                        </span>
                                    @else
                                        <span class="badge bg-label-danger me-1">
                                            Disabled
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{url('/school/edit/'.$school->id)}}"
                                            ><i class="bx bx-edit-alt me-1"></i> Edit</a
                                            >
                                            <a id="delete" class="dropdown-item"><i class="bx bx-trash me-1"></i>Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'ACCEPT': "application/json",
            }
        });

        $(document).on('click','#delete',function(e) {
            e.preventDefault();
            var ID = $("input[name=id]").val();
            var postData = {
                _token: "{{ csrf_token() }}",
            }
            var url = '{{ url('/SchoolApi/') }}' + '/' + ID;

            $.ajax({
                url: url,
                method: 'DELETE',
                data: postData,
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    window.location.replace('/schools')
                },
                error: function (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    })
                }
            });

        });
    </script>
@endsection

