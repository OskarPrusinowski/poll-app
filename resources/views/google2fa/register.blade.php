@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Set up Google Authenticator</div>

                    <div class="panel-body" style="text-align: center;">
                        <p>Set up your two factor authentication by scanning the barcode below. Alternatively, you can use
                            the code {{ $secret }}</p>
                        <div>
                            {!! $QR_Image !!}
                        </div>
                        <p>You must set up your Google Authenticator app before continuing. You will be unable to login
                            otherwise</p>
                        <div>

                            <form class="form-horizontal" method="GET" action="/complete-registration">
                                <a href="/complete-registration"><button class="btn-primary">Complete
                                        Registration</button></a>
                                @foreach ($registration_data as $key => $data)
                                    <input type="hidden" name="{{ $key }}" value="{{ $data }}">
                                @endforeach

                                <input type="hidden" name="secret" value="{{ $secret }}">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
