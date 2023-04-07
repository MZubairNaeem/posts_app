@extends('layouts.app')

@section('content')
<div class="container text-center">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mx-auto flex justify-center">
                <div class="card-header">
                    {{ __('Add a new post') }}
                </div>
                <div class="card-body content-center text-center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="mt-4">
                        <form action="{{ route('post.store') }}" method="POST" class="mx-auto">
                            @csrf
                            <div>
                                <label class=" px-4" for="title">Title</label>
                                <input class="col-md-4 col-form-label @error('title') is-invalid @enderror" type="text" name="title" id="title">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mt-4">
                                <label class="px-4" for="body">Body</label>
                                <textarea  type="text" name="body" class="@error('body') is-invalid @enderror" id="body" cols="33" rows="10"></textarea>
                                @error('body')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
   
@endsection