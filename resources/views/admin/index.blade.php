@extends('admin.app')

@section('page-info')
    <div class="content-heading">
        Dashboard
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <!-- START widget-->
            <div class="panel widget bg-primary">
                <div class="row row-table">
                    <div class="col-xs-4 text-center bg-primary-dark pv-lg">
                        <em class="icon-people fa-3x"></em>
                    </div>
                    <div class="col-xs-8 pv-lg">
                        <div class="h2 mt0">{{ $players }}</div>
                        <div class="text-uppercase">Joueurs</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <!-- START widget-->
            <div class="panel widget bg-purple">
                <div class="row row-table">
                    <div class="col-xs-4 text-center bg-purple-dark pv-lg">
                        <em class="icon-people fa-3x"></em>
                    </div>
                    <div class="col-xs-8 pv-lg">
                        <div class="h2 mt0">{{ $users }}</div>
                        <div class="text-uppercase">Utilisateurs</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <!-- START widget-->
            <div class="panel widget bg-green">
                <div class="row row-table">
                    <div class="col-xs-4 text-center bg-green-dark pv-lg">
                        <em class="icon-book-open fa-3x"></em>
                    </div>
                    <div class="col-xs-8 pv-lg">
                        <div class="h2 mt0">{{ $news }}</div>
                        <div class="text-uppercase">News</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <!-- START date widget-->
            <div class="panel widget">
                <div class="row row-table">
                    <div class="col-xs-4 text-center bg-green pv-lg">
                        <!-- See formats: https://docs.angularjs.org/api/ng/filter/date-->
                        <div data-now="" data-format="MMMM" class="text-sm"></div>
                        <br>
                        <div data-now="" data-format="D" class="h2 mt0"></div>
                    </div>
                    <div class="col-xs-8 pv-lg">
                        <div data-now="" data-format="dddd" class="text-uppercase"></div>
                        <br>
                        <div data-now="" data-format="h:mm" class="h2 mt0"></div>
                        <div data-now="" data-format="a" class="text-muted text-sm"></div>
                    </div>
                </div>
            </div>
            <!-- END date widget    -->
        </div>
    </div>

    <div class="row">
        <!-- START dashboard main content-->
        <div class="col-lg-9">
            @include('flash')
            <!-- START chart-->
            <div class="row">
                <div class="col-lg-12">
                    <!-- START widget-->
                    <div id="panelChart9" class="panel panel-default panel-demo">
                        <div class="panel-heading">
                            <a href="#" data-tool="panel-collapse" data-toggle="tooltip" title="Collapse Panel"
                               class="pull-right">
                                <em class="fa fa-minus"></em>
                            </a>
                            <div class="panel-title">Dernier joueurs</div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-responsive table-striped">
                                <tr>
                                    <th>Nom du joueur</th>
                                    <th>ID Arma</th>
                                    <th>Argent</th>
                                </tr>
                                @foreach($players_last as $player)
                                    <tr>
                                        <td><a href="{{ url('admin/player/'. $player->playerid) }}">{{ $player->name }}</a></td>
                                        <td>{{ $player->playerid }}</td>
                                        <td>
                                            <?php
                                            $money = $player->cash + $player->bankacc;

                                            if ($money < 500000) {
                                                $argent = number_format($money, 2, ',', ' ');
                                                echo "<span class='label label-success'>". $argent ." $</span>";
                                            } elseif (800000 > $money) {
                                                $argent = number_format($money, 2, ',', ' ');
                                                echo "<span class='label label-warning'>". $argent ." $</span>";
                                            } else {
                                                $argent = number_format($money, 2, ',', ' ');
                                                echo "<span class='label label-danger'>". $argent ." $</span>";
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <!-- END widget-->
                </div>
            </div>
            <!-- END chart-->

        </div>
        <!-- END dashboard main content-->

        <!-- START dashboard sidebar-->
        <aside class="col-lg-3">
            <!-- START messages and activity-->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">Latest activities</div>
                </div>
                <!-- START list group-->
                <div class="list-group">
                    <!-- START list group item-->
                    <div class="list-group-item">
                        <div class="media-box">
                            <div class="pull-left">
                                <span class="fa-stack">
                                   <em class="fa fa-circle fa-stack-2x text-purple"></em>
                                   <em class="fa fa-cloud-upload fa-stack-1x fa-inverse text-white"></em>
                                </span>
                            </div>
                            <div class="media-box-body clearfix">
                                <small class="text-muted pull-right ml">15m</small>
                                <div class="media-box-heading"><a href="#" class="text-purple m0">NEW FILE</a>
                                </div>
                                <p class="m0">
                                    <small><a href="#">Bootstrap.xls</a>
                                    </small>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- END list group item-->
                    <!-- START list group item-->
                    <div class="list-group-item">
                        <div class="media-box">
                            <div class="pull-left">
                                         <span class="fa-stack">
                                            <em class="fa fa-circle fa-stack-2x text-info"></em>
                                            <em class="fa fa-file-text-o fa-stack-1x fa-inverse text-white"></em>
                                         </span>
                            </div>
                            <div class="media-box-body clearfix">
                                <small class="text-muted pull-right ml">2h</small>
                                <div class="media-box-heading"><a href="#" class="text-info m0">NEW DOCUMENT</a>
                                </div>
                                <p class="m0">
                                    <small><a href="#">Bootstrap.doc</a>
                                    </small>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- END list group item-->
                    <!-- START list group item-->
                    <div class="list-group-item">
                        <div class="media-box">
                            <div class="pull-left">
                                         <span class="fa-stack">
                                            <em class="fa fa-circle fa-stack-2x text-danger"></em>
                                            <em class="fa fa-exclamation fa-stack-1x fa-inverse text-white"></em>
                                         </span>
                            </div>
                            <div class="media-box-body clearfix">
                                <small class="text-muted pull-right ml">5h</small>
                                <div class="media-box-heading"><a href="#" class="text-danger m0">BROADCAST</a>
                                </div>
                                <p class="m0"><a href="#">Read</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- END list group item-->
                    <!-- START list group item-->
                    <div class="list-group-item">
                        <div class="media-box">
                            <div class="pull-left">
                                         <span class="fa-stack">
                                            <em class="fa fa-circle fa-stack-2x text-success"></em>
                                            <em class="fa fa-clock-o fa-stack-1x fa-inverse text-white"></em>
                                         </span>
                            </div>
                            <div class="media-box-body clearfix">
                                <small class="text-muted pull-right ml">15h</small>
                                <div class="media-box-heading"><a href="#" class="text-success m0">NEW MEETING</a>
                                </div>
                                <p class="m0">
                                    <small>On
                                        <em>10/12/2015 09:00 am</em>
                                    </small>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- END list group item-->
                    <!-- START list group item-->
                    <div class="list-group-item">
                        <div class="media-box">
                            <div class="pull-left">
                                         <span class="fa-stack">
                                            <em class="fa fa-circle fa-stack-2x text-warning"></em>
                                            <em class="fa fa-tasks fa-stack-1x fa-inverse text-white"></em>
                                         </span>
                            </div>
                            <div class="media-box-body clearfix">
                                <small class="text-muted pull-right ml">1w</small>
                                <div class="media-box-heading"><a href="#" class="text-warning m0">TASKS COMPLETION</a>
                                </div>
                                <div class="progress progress-xs m0">
                                    <div role="progressbar" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"
                                         style="width: 22%"
                                         class="progress-bar progress-bar-warning progress-bar-striped">
                                        <span class="sr-only">22% Complete</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END list group item-->
                </div>
                <!-- END list group-->
                <!-- START panel footer-->
                <div class="panel-footer clearfix">
                    <a href="#" class="pull-left">
                        <small>Load more</small>
                    </a>
                </div>
                <!-- END panel-footer-->
            </div>
            <!-- END messages and activity-->
        </aside>
        <!-- END dashboard sidebar-->

    </div>
@endsection