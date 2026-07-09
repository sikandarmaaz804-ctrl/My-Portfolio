@extends('layouts.admin')

@section('page_title', 'No Access')

@section('content')
<div class="page-header">
    <h1>No admin sections assigned</h1>
    <p>Your login is active, but this role does not have access to any admin page yet.</p>
</div>

<div class="alert alert-warning">
    Please ask the main administrator to assign at least one permission to your role.
</div>
@endsection
