@extends('layouts.app')

@section('content')
<div class="container">

    <vue-alert></vue-alert>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Testimonials</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{--<testimonials-list></testimonials-list>--}}

                    <router-view></router-view>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
