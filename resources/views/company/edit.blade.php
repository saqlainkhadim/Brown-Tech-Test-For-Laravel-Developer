<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Company') }}

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
                                    <form method="POST" action="{{route('company.update',$company->id)}}">
                                        @method('PUT')
                                        @csrf
                                        <div class="container">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Company Name*</label>
                                            <input type="text" name="name" class="form-control" value="{{$company->name}}" placeholder="Enter Company Name"
                                            >
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Company Email address</label>
                                            <input type="text" name="email" class="form-control" value="{{$company->email}}" placeholder="Enter Email">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Company Website</label>
                                            <input type="text" name="website" class="form-control" value="{{$company->website}}" placeholder="Enter Website"
                                            >
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Company Logo</label>
                                            <input type="file" name="logo" accept="image/png, image/gif, image/jpeg"
                                                   class="form-control" placeholder="Enter Email">
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
