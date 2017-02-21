@extends('app')

@section('content')
    <div class="container" style="margin-top: 77px">
        <h1>Bourse</h1>
        <div class="row">
            <div class="col-md-12" style="margin-top: 5px">
                <table class="table table-stripped">
                    @foreach($bourse as $item)
                        <tr>
                            <!-- Todo: Translate in french -->
                            <td>{{ $item['name'] }}</td>
                            <td>${{ round($item['actual']) }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

@endsection