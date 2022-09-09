<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('main.Employees') }}

            <button class="btn btn-primary btn-sm ml-3" data-toggle="modal" data-target=".bd-example-modal-lg"><i
                    class="fa-solid fa-plus"></i></button>
        </h2>

        @if($errors->any())
            {!!  implode('', $errors->all('<div class="text-danger">:message</div>'))  !!}
        @endif
    </x-slot>

    <!-- Bootstrap Modal -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{route('employee.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add Employee</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Employee First Name*</label>
                                <input type="text" name="first_name" class="form-control" placeholder="Enter Company Name"
                                >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Employee Last Name*</label>
                                <input type="text" name="last_name" class="form-control" placeholder="Enter Company Name"
                                >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Employee Email address</label>
                                <input type="text" name="email" class="form-control" placeholder="Enter Email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone</label>
                                <input type="number" name="phone" class="form-control" placeholder="Enter Website"
                                >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Company</label>
                                <select name="company_id"  class="form-control">
                                    <option value="">Select Company</option>
                                    @foreach($companies as $company)
                                        <option value="{{$company->id}}">{{$company->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Companies</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="myTable" style="width:100%;">
                                        <thead>
                                        <tr>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Company</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($employees as $employee)
                                            <tr>
                                                <td>{{$employee->first_name}}</td>
                                                <td>{{$employee->last_name}}</td>
                                                <td>{{$employee->email}}</td>
                                                <td>{{$employee->phone}}</td>
                                                <td>{{$employee->company}}</td>
                                                <td>
                                                    <button class="btn btn-danger btn-sm ml-3 delete"
                                                            data-id="{{$employee->id}}"><i class="fa-solid fa-trash"></i>
                                                    </button>
                                                    <a href="{{route('employee.edit',$employee->id)}}">
                                                        <button class="btn btn-primary btn-sm ml-3 edit" data-id="{{$employee->id}}"><i class="fa-solid fa-pencil"></i></button>
                                                    </a>


                                                </td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('script')
        <script>
            $(document).ready(function () {
                $('#myTable').DataTable()

                $(document).on("click", ".delete", function () {
                    let delete_btn = $(this);
                    let id = $(this).attr('data-id');
                    $.ajax({
                        url: "/employee/" + id,
                        type: "delete",
                        data: {
                            '_token': "{{csrf_token()}}"
                        },
                        success: function (result) {
                            if (result) {
                                delete_btn.parent().parent().remove();
                            }
                        }
                    });

                });
            });
        </script>

    @endsection
</x-app-layout>
