@extends('layouts/contentLayoutMaster')
@section('content')
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8 mt-3">
            <div class="card p-2">
                <div class="card-header">
                    <span>Wallet User Searcher</span>
                </div>
                <form action="{{ route('admin-wallet-search.user') }}" method="GET">
                    @csrf
                    <div class="card-body">
                        <label for="id">Search by user id or email</label>
                        <input class="form-control" type="text" name="user" >
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-sm-2"></div>
    </div>
@endsection
