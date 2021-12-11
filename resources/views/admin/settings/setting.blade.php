@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        Edit blog settings
    </div>
    <div class="card-body">
        <form action="{{ route('setting.update') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="site_name">Site Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="site_name" value="{{ $setting->site_name }}">
                @if($errors->has('site_name'))
                    <div class="text-danger">{{ $errors->first('site_name') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="contact_number">Contact Number <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="contact_number" value="{{ $setting->contact_number }}">
                @if($errors->has('contact_number'))
                    <div class="text-danger">{{ $errors->first('contact_number') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="contact_email">Contact Email <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="contact_email" value="{{ $setting->contact_email }}">
                @if($errors->has('contact_email'))
                    <div class="text-danger">{{ $errors->first('contact_email') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="address">Address <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="address" value="{{ $setting->address }}">
                @if($errors->has('address'))
                    <div class="text-danger">{{ $errors->first('address') }}</div>
                @endif
            </div>
            <div class="form-group">
                <div class="text-left">
                    <button class="btn btn-success" type="submit">Update site setting</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection