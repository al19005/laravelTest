@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ようこそ芝浦チャットシステムへ') }}</div>

                <div class="card-body">
                    <ul>
                        <div class="row justify-content-center">
                            <a href="{{ route('login') }}" class="btn btn-md btn-primary">ログイン</a>
                        </div>
                    </ul>
                    <ul>
                        <div class="row justify-content-center">
                            <a href="{{ route('register') }}" class="btn btn-md btn-primary">新規登録</a>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
