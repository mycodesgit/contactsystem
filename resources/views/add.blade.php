@extends('master')

@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Contact</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('create.contact') }}" id="addContact" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="formName">Name</label>
                            <input type="text" name="contact_name" class="form-control" id="formName" placeholder="Enter Name" required>
                        </div>
                        <div class="form-group">
                            <label for="formCompany">Company</label>
                            <input type="text" name="contact_company" class="form-control" id="formCompany" placeholder="Enter Company">
                        </div>
                        <div class="form-group">
                            <label for="formphone">Phone</label>
                            <input type="text" name="contact_phone" class="form-control" id="formphone" placeholder="Enter Phone" maxlength="14">
                        </div>
                        <div class="form-group">
                            <label for="formEmail">Email</label>
                            <input type="email" name="email" class="form-control" id="formEmail" placeholder="Enter Email">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-md btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection