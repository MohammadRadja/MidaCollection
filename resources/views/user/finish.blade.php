@extends('layouts.index')
@section('title')
    Finish
@endsection
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <div class="btn-group" role="group" aria-label="Basic example">
                <a href="/my/order" class="btn px-5" style="background-color:#034f84; border-color:white; color:white;">Order <i
                            class="fa-solid fa-bag-shopping"></i></a>
                    <a href="/my/finish" class="btn btn-dark px-5">Finish <i class="fa-regular fa-circle-check"></i></a>
                </div>
            </div>
        </div>
        <div class="row mt-2 mb-5">
            <div class="col" id="data_finish">


            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            read_finish()
        })

        function read_finish() {
            $.get("{{ url('my/finish/read') }}", {}, function(data, status) {
                $("#data_finish").html(data);

            })
        }
    </script>
@endsection
