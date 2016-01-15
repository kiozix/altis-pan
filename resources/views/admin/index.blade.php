@extends('admin.app')

@section('widget')
    <div class="col-lg-3 col-sm-6">
        <!-- START widget-->
        <div class="panel widget bg-primary">
            <div class="row row-table">
                <div class="col-xs-4 text-center bg-primary-dark pv-lg">
                    <em class="icon-cloud-upload fa-3x"></em>
                </div>
                <div class="col-xs-8 pv-lg">
                    <div class="h2 mt0">1700</div>
                    <div class="text-uppercase">Uploads</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6">
        <!-- START widget-->
        <div class="panel widget bg-purple">
            <div class="row row-table">
                <div class="col-xs-4 text-center bg-purple-dark pv-lg">
                    <em class="icon-globe fa-3x"></em>
                </div>
                <div class="col-xs-8 pv-lg">
                    <div class="h2 mt0">700
                        <small>GB</small>
                    </div>
                    <div class="text-uppercase">Quota</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <!-- START widget-->
        <div class="panel widget bg-green">
            <div class="row row-table">
                <div class="col-xs-4 text-center bg-green-dark pv-lg">
                    <em class="icon-bubbles fa-3x"></em>
                </div>
                <div class="col-xs-8 pv-lg">
                    <div class="h2 mt0">500</div>
                    <div class="text-uppercase">Reviews</div>
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
@endsection

@section('content')
<!-- START dashboard main content-->
    <div class="col-lg-9">
        <!-- START chart-->
        <div class="row">
            <div class="col-lg-12">
                <!-- START widget-->
                <div id="panelChart9" class="panel panel-default panel-demo">
                    <div class="panel-heading">
                        <a href="#" data-tool="panel-refresh" data-toggle="tooltip" title="Refresh Panel"
                           class="pull-right">
                            <em class="fa fa-refresh"></em>
                        </a>
                        <a href="#" data-tool="panel-collapse" data-toggle="tooltip" title="Collapse Panel"
                           class="pull-right">
                            <em class="fa fa-minus"></em>
                        </a>
                        <div class="panel-title">Inbound visitor statistics</div>
                    </div>
                    <div class="panel-body">
                        <div class="chart-spline flot-chart"></div>
                    </div>
                </div>
                <!-- END widget-->
            </div>
        </div>
        <!-- END chart-->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel widget">
                    <div class="row row-table">
                        <div class="col-md-2 col-sm-3 col-xs-6 text-center bg-info pv-xl">
                            <em class="wi wi-day-sunny fa-4x"></em>
                        </div>
                        <div class="col-md-2 col-sm-3 col-xs-6 pv br">
                            <div class="h1 m0 text-bold">32&deg;</div>
                            <div class="text-uppercase">Clear</div>
                        </div>
                        <div class="col-md-2 col-sm-3 hidden-xs pv text-center br">
                            <div class="text-info text-sm">10 AM</div>
                            <div class="text-muted text-md">
                                <em class="wi wi-day-cloudy"></em>
                            </div>
                            <div class="text-info">
                                <em class="wi wi-sprinkles"></em>
                                <span class="text-muted">20%</span>
                            </div>
                            <div class="text-muted">27&deg;</div>
                        </div>
                        <div class="col-md-2 col-sm-3 hidden-xs pv text-center br">
                            <div class="text-info text-sm">11 AM</div>
                            <div class="text-muted text-md">
                                <em class="wi wi-day-cloudy"></em>
                            </div>
                            <div class="text-info">
                                <em class="wi wi-sprinkles"></em>
                                <span class="text-muted">30%</span>
                            </div>
                            <div class="text-muted">28&deg;</div>
                        </div>
                        <div class="col-md-2 hidden-sm hidden-xs pv text-center br">
                            <div class="text-info text-sm">12 PM</div>
                            <div class="text-muted text-md">
                                <em class="wi wi-day-cloudy"></em>
                            </div>
                            <div class="text-info">
                                <em class="wi wi-sprinkles"></em>
                                <span class="text-muted">20%</span>
                            </div>
                            <div class="text-muted">30&deg;</div>
                        </div>
                        <div class="col-md-2 hidden-sm hidden-xs pv text-center">
                            <div class="text-info text-sm">1 PM</div>
                            <div class="text-muted text-md">
                                <em class="wi wi-day-sunny-overcast"></em>
                            </div>
                            <div class="text-info">
                                <em class="wi wi-sprinkles"></em>
                                <span class="text-muted">0%</span>
                            </div>
                            <div class="text-muted">30&deg;</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <!-- START widget-->
                <div class="panel widget">
                    <div class="panel-body">
                        <div class="clearfix">
                            <h3 class="pull-left text-muted mt0">300</h3>
                            <em class="pull-right text-muted fa fa-coffee fa-2x"></em>
                        </div>
                        <div data-sparkline="" data-type="line" data-height="80" data-width="100%" data-line-width="2"
                             data-line-color="#7266ba" data-spot-color="#888" data-min-spot-color="#7266ba"
                             data-max-spot-color="#7266ba" data-fill-color=""
                             data-highlight-line-color="#fff" data-spot-radius="3" data-values="1,3,4,7,5,9,4,4,7,5,9,6,4"
                             data-resize="true" class="pv-lg"></div>
                        <p>
                            <small class="text-muted">Actual progress</small>
                        </p>
                        <div class="progress progress-xs">
                            <div role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"
                                 style="width: 80%" class="progress-bar progress-bar-info progress-bar-striped">
                                <span class="sr-only">80% Complete</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END widget-->
            </div>

        </div>
    </div>
<!-- END dashboard main content-->

<!-- START dashboard sidebar-->
    <aside class="col-lg-3">
        <!-- START loader widget-->
        <div class="panel panel-default">
            <div class="panel-body">
                <a href="#" class="text-muted pull-right">
                    <em class="fa fa-arrow-right"></em>
                </a>
                <div class="text-info">Average Monthly Uploads</div>
                <canvas data-classyloader="" data-percentage="70" data-speed="20" data-font-size="40px" data-diameter="70" data-line-color="#23b7e5" data-remaining-line-color="rgba(200,200,200,0.4)" data-line-width="10"
                        data-rounded-line="true" class="center-block"></canvas>
                <div data-sparkline="" data-bar-color="#23b7e5" data-height="30" data-bar-width="5" data-bar-spacing="2" data-values="5,4,8,7,8,5,4,6,5,5,9,4,6,3,4,7,5,4,7" class="text-center"></div>
            </div>
            <div class="panel-footer">
                <p class="text-muted">
                    <em class="fa fa-upload fa-fw"></em>
                    <span>This Month</span>
                    <span class="text-dark">1000 Gb</span>
                </p>
            </div>
        </div>
        <!-- END loader widget-->
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
                                <div role="progressbar" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100" style="width: 22%" class="progress-bar progress-bar-warning progress-bar-striped">
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
@endsection