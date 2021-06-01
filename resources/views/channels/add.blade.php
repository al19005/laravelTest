@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Channel</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('channels.store') }}">
                        @csrf

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <input class="form-control @error('text') is-invalid @enderror" name="text" required autocomplete="text" rows="4">

                                @error('text')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-right">
                                <p></p>
                                <button type="submit" class="btn btn-primary">
                                    CREATE
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 vertical-scroll-table">
            <ul class="list-group list-group-flush">
                <p class="list-group-item">Join Channel</p>
                @foreach ($channels as $channel)
                    <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="list-group-item list-group-item-action">
                        {{ '#'. $channel->channel_name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <form method="POST" action="{{ url('joins/') }}" class="mb-0">
                            @csrf

                            <input type="hidden" name="channel_id" value="{{ $channel->id }}">
                            <button type="submit" class="dropdown-item">参加</button>
                        </form>
                    </div>
                @endforeach
                <p></p>
            </ul>
        </div>
    </div>
</div>
@endsection
