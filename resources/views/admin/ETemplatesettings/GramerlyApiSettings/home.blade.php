@extends('layouts.admin')
@section('title', 'Grammarly API Settings')
@section('content')
<style>
    #disabl {
        display: none !important;
    }
</style>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Grammarly Settings /</span> Home</h4>
    @if(Session::has('success'))
        <div class="alert alert-success" Security="alert">{{ Session::get('success') }}</div>
    @endif

    <!-- Security List Table -->
    <div class="card">
        <div class="row">
            <div class="col-md-6">
                <h5 class="card-header">Grammarly API Settings </h5>
            </div>
            <div class="col-md-6 text-end">
                <!-- <a href="{{url('admin/Security/home')}}" class="btn btn-warning mt-3 m-3"><i class="fas fa-sync-alt"></i></a> -->
                <!-- <a href="{{url('admin/Security/add')}}" class="btn btn-primary mt-3 m-3">Add</a> -->
            </div>
        </div>
        <div class="card-datatable table-responsive">
            <div id="DataTables_Table_3_wrapper" class="dataTables_wrapper dt-bootstrap5 d-flex">
                <div class="col-md-6 mb-4">
                    <label class="form-label" for="customCheckPrimary">API Token</label>
                    <input type="text" name="api_token" id="api_token" class="form-control">
                </div>
                <div class="col-md-6 mb-4">
                    <label class="form-label" for="customCheckPrimary">API Password</label>
                    <input type="text" name="api_password" id="api_password" class="form-control">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
