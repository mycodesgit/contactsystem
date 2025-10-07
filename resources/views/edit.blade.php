@extends('master')

@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Contact</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('update.contact', $contact->id) }}"id="editContactForm" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="contactId" value="{{ $contact->id }}">
                        <div class="form-group">
                            <label for="formName">Name</label>
                            <input type="text" name="contact_name" class="form-control" id="formName" value="{{ $contact->contact_name }}" placeholder="Enter Name" required>
                        </div>
                        <div class="form-group">
                            <label for="formCompany">Company</label>
                            <input type="text" name="contact_company" class="form-control" id="formCompany" value="{{ $contact->contact_company }}" placeholder="Enter Company">
                        </div>
                        <div class="form-group">
                            <label for="formphone">Phone</label>
                            <input type="text" name="contact_phone" class="form-control" id="formphone" value="{{ $contact->contact_phone }}" placeholder="Enter Phone" maxlength="14">
                        </div>
                        <div class="form-group">
                            <label for="formEmail">Email</label>
                            <input type="email" name="email" class="form-control" id="formEmail" value="{{ $contact->email }}"  placeholder="Enter Email">
                        </div>

                        <div class="form-group">
                            <a href="{{ route('index.contact') }}" class="btn btn-secondary">Back</a>
                            <button class="btn btn-md btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
