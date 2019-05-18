@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create A New Thread</div>

                <div class="card-body">

                    <form method='POST' action="/threads">

                    @csrf

                    <div class="form-group">
                        <input class="form-control" name="title" id="title" placeholder="title">
                    </div>


                    <div class="form-group">
                        <textarea class="form-control" name="body" id="body" placeholder="Have something to say?" rows="5"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary mb-2">Publish</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
