<div id="vehicules" class="panel panel-default">
    <div class="panel-heading">
        <span style="font-weight: bold;font-size: 20px !important;">Véhicules</span>
    </div>
    <div class="panel-wrapper collapse in" aria-expanded="true">
        <div class="panel-body">
            <div id="accordion" role="tablist" aria-multiselectable="true" class="panel-group">
                <div class="panel panel-default">
                    <div id="headingOne" role="tab" class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="">Terrestre</a>
                        </h4>
                    </div>
                    <div id="collapseOne" role="tabpanel" aria-labelledby="headingOne" class="panel-collapse collapse in" aria-expanded="true">
                        <div class="panel-body">
                            <table class="table table-striped table-responsive">
                                <tr>
                                    <th>Nom</th>
                                    <th>Emplacement du garage</th>
                                    <th>Type</th>
                                    @if($insure && $insure->value_associated == 1)
                                        <th>Assurance</th>
                                    @endif
                                    <th>Active</th>
                                    <th>Actions</th>
                                </tr>
                                @foreach($vehicles_cars as $vehicle_car)
                                    <tr>
                                        <td>{{ $vehicle_car->classname }}</td>
                                        <td>{{ $vehicle_car->side }}</td>
                                        <td>{{ $vehicle_car->type }}</td>
                                        @if($insure && $insure->value_associated == 1)
                                            <td>
                                                @if($vehicle_car->insure == 1)
                                                    <i class="fa fa-check" style="color: #2cc36b;"></i>
                                                @elseif($vehicle_car->insure == 0)
                                                    <i class="fa fa-close" style="color: #c0392b;"></i>
                                                @endif
                                            </td>
                                        @endif
                                        <td>
                                            @if($vehicle_car->active == 1)
                                                <i class="fa fa-check" style="color: #2cc36b;"></i>
                                            @elseif($vehicle_car->active == 0)
                                                <i class="fa fa-close" style="color: #c0392b;"></i>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/vehicule', ['id' => $vehicle_car->id]) }}"><i class="fa fa-exchange" style="color: #4aa3df;"></i></a>
                                            <span style="display: inline-block">
                                                <form action="{{ url('admin/vehicule') }}" method="post">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="id" value="{{ $vehicle_car->id }}">
                                                    <button class="btn btn-danger btn-xs " ><i class="fa fa-trash"></i></button>
                                                </form>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div id="headingTwo" role="tab" class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="collapsed">Aérien</a>
                        </h4>
                    </div>
                    <div id="collapseTwo" role="tabpanel" aria-labelledby="headingTwo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                        <div class="panel-body">
                            <table class="table table-striped table-responsive">
                                <tr>
                                    <th>Nom</th>
                                    <th>Emplacement du garage</th>
                                    <th>Type</th>
                                    @if($insure && $insure->value_associated == 1)
                                        <th>Assurance</th>
                                    @endif
                                    <th>Active</th>
                                    <th>Actions</th>
                                </tr>
                                @foreach($vehicles_airs as $vehicle_air)
                                    <tr>
                                        <td>{{ $vehicle_air->classname }}</td>
                                        <td>{{ $vehicle_air->side }}</td>
                                        <td>{{ $vehicle_air->type }}</td>
                                        @if($insure && $insure->value_associated == 1)
                                            <td>
                                                @if($vehicle_air->insure == 1)
                                                    <i class="fa fa-check" style="color: #2cc36b;"></i>
                                                @elseif($vehicle_air->insure == 0)
                                                    <i class="fa fa-close" style="color: #c0392b;"></i>
                                                @endif
                                            </td>
                                        @endif
                                        <td>
                                            @if($vehicle_air->active == 1)
                                                <i class="fa fa-check" style="color: #2cc36b;"></i>
                                            @elseif($vehicle_air->active == 0)
                                                <i class="fa fa-close" style="color: #c0392b;"></i>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/vehicule', ['id' => $vehicle_air->id]) }}"><i class="fa fa-exchange" style="color: #4aa3df;"></i></a>
                                            <span style="display: inline-block">
                                                <form action="{{ url('admin/vehicule') }}" method="post">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="id" value="{{ $vehicle_air->id }}">
                                                    <button class="btn btn-danger btn-xs " ><i class="fa fa-trash"></i></button>
                                                </form>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div id="headingThree" role="tab" class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree" class="collapsed">Aquatique</a>
                        </h4>
                    </div>
                    <div id="collapseThree" role="tabpanel" aria-labelledby="headingThree" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                        <div class="panel-body">
                            <table class="table table-striped table-responsive">
                                <tr>
                                    <th>Nom</th>
                                    <th>Emplacement du garage</th>
                                    <th>Type</th>
                                    @if($insure && $insure->value_associated == 1)
                                        <th>Assurance</th>
                                    @endif
                                    <th>Active</th>
                                    <th>Actions</th>
                                </tr>
                                @foreach($vehicles_ships as $vehicle_ship)
                                    <tr>
                                        <td>{{ $vehicle_ship->classname }}</td>
                                        <td>{{ $vehicle_ship->side }}</td>
                                        <td>{{ $vehicle_ship->type }}</td>
                                        @if($insure && $insure->value_associated == 1)
                                            <td>
                                                @if($vehicle_ship->insure == 1)
                                                    <i class="fa fa-check" style="color: #2cc36b;"></i>
                                                @elseif($vehicle_ship->insure == 0)
                                                    <i class="fa fa-close" style="color: #c0392b;"></i>
                                                @endif
                                            </td>
                                        @endif
                                        <td>
                                            @if($vehicle_ship->active == 1)
                                                <i class="fa fa-check" style="color: #2cc36b;"></i>
                                            @elseif($vehicle_ship->active == 0)
                                                <i class="fa fa-close" style="color: #c0392b;"></i>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/vehicule', ['id' => $vehicle_ship->id]) }}"><i class="fa fa-exchange" style="color: #4aa3df;"></i></a>
                                            <span style="display: inline-block">
                                                <form action="{{ url('admin/vehicule') }}" method="post">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="hidden" name="id" value="{{ $vehicle_ship->id }}">
                                                    <button class="btn btn-danger btn-xs " ><i class="fa fa-trash"></i></button>
                                                </form>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>