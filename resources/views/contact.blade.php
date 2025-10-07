@extends('master')

@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Contact List</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('store.contact') }}" class="btn btn-primary btn-sm mb-4" >
                                Add New Contact
                            </a>
                        </div>
                        <div class="col-md-6">
                            <input type="text" id="searchContact" class="form-control" placeholder="Search contact...">
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Company</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="contactTableBody">
                                <tr>
                                    <td colspan="5" class="text-center">Loading contacts...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <nav>
                        <ul class="pagination justify-content-center" id="paginationLinks"></ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    
@endsection
