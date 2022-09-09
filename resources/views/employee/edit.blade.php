<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('main.Edit Company') }}

        </h2>

        @if($errors->any())
            {!!  implode('', $errors->all('<div class="text-danger">:message</div>'))  !!}
        @endif
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Edit Company</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <form method="POST" action="{{route('employee.update',$employee->id)}}">
                                        @method('PUT')
                                        @csrf
                                        <div class="container">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Employee First Name*</label>
                                                <input type="text" name="first_name"  value="{{$employee->first_name}}" class="form-control" placeholder="Enter Company Name"
                                                >
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Employee Last Name*</label>
                                                <input type="text" name="last_name"  value="{{$employee->last_name}}" class="form-control" placeholder="Enter Company Name"
                                                >
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Employee Email address</label>
                                                <input type="text" name="email"  value="{{$employee->email}}" class="form-control" placeholder="Enter Email">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Phone</label>
                                                <input type="number" name="phone"   value="{{$employee->phone}}" class="form-control" placeholder="Enter Website"
                                                >
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Company</label>
                                                <select name="company_id"  class="form-control">
                                                    <option value="">Select Company</option>
                                                    @foreach($companies as $company)
                                                        <option value="{{$company->id}}" style=" background-image:url('/storage/company_logos/IMG-631952f0ad587-1662604016.png')" {{$company->id==$employee->company_id?"selected":''}}>{{$company->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary brn-sm" value="Update">
                                        </div>

                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
