@extends('layouts.admin')
@section('title')
    Update School
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> @yield('title')</h4>
            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form id="new_school" class="new_school">
                                <input type="hidden" name="id" value="{{$school->id}}">
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" id="name" name="name"
                                               placeholder="School Name..." value="{{$school->name}}" required/>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <label for="exampleFormControlSelect1" class="form-label">Status</label>
                                    <select class="form-select" id="status" name="status"
                                            aria-label="Default select example">
                                        <option
                                            selected="{{$school->status}}">{{$school->status ? "Enabled" : "Disabled"}}</option>
                                        <option value="0">Disabled</option>
                                        <option value="1">Enabled</option>
                                    </select>
                                </div>
                                <div class="row justify-content-start">
                                    <div class="col-sm-10">
                                        <input class="btn btn-primary" type="submit" name="submit" id="submit_btn"
                                               value="{{__('Update')}}"/>
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
        $(".new_school").submit(function (e) {
            e.preventDefault();
            var ID = $("input[name=id]").val();
            var Name = $("input[name=name]").val();
            var Status = $("select[name=status]").val();
            var postData = {
                _token: "{{ csrf_token() }}",
                name: Name,
                status: Status,
            }
            var url = '{{ url('/SchoolApi/') }}' + '/' + ID;

            $.ajax({
                url: url,
                method: 'PATCH',
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

