@extends('layouts.admin')
@section('title')
    New Student
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> @yield('title')</h4>
            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form id="new_student" class="new_student">
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" id="name" name="name"
                                               placeholder="Student Name..." required/>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <label for="exampleFormControlSelect1" class="form-label">School</label>
                                    <select class="form-select" id="school_id" name="school_id"
                                            aria-label="Default select example">
                                        <option selected="">Open this select menu</option>
                                        @foreach($schools as $school)
                                            <option value="{{$school->id}}">{{$school->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">Order ID</label>
                                    <div class="form-group col-md-6">
                                        <input type="number" class="form-control" id="order_id" name="order_id"
                                               placeholder="Order Number..." required/>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <label for="exampleFormControlSelect1" class="form-label">Status</label>
                                    <select class="form-select" id="status" name="status"
                                            aria-label="Default select example">
                                        <option selected="">Open this select menu</option>
                                        <option value="0">Disable</option>
                                        <option value="1">Enable</option>
                                    </select>
                                </div>
                                <div class="row justify-content-start">
                                    <div class="col-sm-10">
                                        <input class="btn btn-primary" type="submit" name="submit" id="submit_btn"
                                               value="{{__('Create New')}}"/>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
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
        $(".new_student").submit(function (e) {
            e.preventDefault();
            var Name = $("input[name=name]").val();
            var Status = $("select[name=status]").val();
            var SchoolID = $("select[name=school_id]").val();
            var OrderID = $("input[name=order_id]").val();
            var postData = {
                _token: "{{ csrf_token() }}",
                name: Name,
                school_id: SchoolID,
                order: OrderID,
                status: Status,
            }
            var url = '{{ url('/StudentApi') }}';

            $.ajax({
                url: url,
                method: 'POST',
                data: postData,
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    window.location.replace('/students')
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

