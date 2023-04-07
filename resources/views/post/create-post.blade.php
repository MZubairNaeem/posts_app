@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card flex justify-center">
                <div class="card-header">
                    {{ __('Create a post') }}
                </div>
                <div class="card-body content-center">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    <div class="flex justify-center" >
                        <form method="POST" action="{{ route('post.store') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>
                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="" required autocomplete="title" autofocus>
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="body" class="col-md-4 col-form-label text-md-end">{{ __('Body') }}</label>
                                <div class="col-md-6">
                                    <textarea id="body" type="text" class="form-control @error('body') is-invalid @enderror" name="body" required autocomplete="body" autofocus></textarea>
                                    @error('body')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="m-3">
                                <label for="user" class="col-md-4 col-form-label text-md-end px-4">Select user for this post</label>
                                <select class="form-control" name="user_name" id="user">
                                    @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                   @endforeach
                                </select>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Create') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection