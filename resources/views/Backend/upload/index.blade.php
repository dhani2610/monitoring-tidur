@extends('BE.app')

@section('style-BE')

@endsection

@section('content-BE')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session()->get('success') }}
                    </div>
                    @endif

                    @if(session()->has('warning'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session()->get('warning') }}
                    </div>
                    @endif

                    @if(session()->has('failed'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session()->get('failed') }}
                    </div>
                    @endif
                    <form action="{{ ('send') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>File upload</label>
                            <input type="file" name="file" accept=".xlsx" class="form-control ">
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script-BE')

@endsection