@extends('layouts.admin')
@section('content')
    <div class="content">
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
            integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous" />
        <link rel="stylesheet" href="css/bootstrap-select.min.css" />

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Dashboard
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in!
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        Tree Chart
                    </div>

                    <div class="card-body">
                        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                            <!-- Bootstrap Nav Menu -->
                            <ul class="navbar-nav mr-auto">
                                <div class="navbar-header">
                                    <a class="navbar-brand" href="#">d3 Tree</a>
                                </div>
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-secondary active">
                                        <input type="radio" name="expand" id="expand_all_option" autocomplete="off"
                                            checked />Expand All
                                    </label>
                                    <label class="btn btn-secondary">
                                        <input type="radio" name="expand" id="collapse_all_option"
                                            autocomplete="off" />Collapse All
                                    </label>
                                </div>

                                <li class="nav-item">
                                    <a class="nav-link" href="#"></a>
                                </li>

                                <div class="btn-group btn-group-toggle node_selection_group" data-toggle="buttons">
                                    <label class="btn btn-secondary active">
                                        <input type="checkbox" class="node_selection" name="node_selection[]"
                                            autocomplete="off" id="node_selection_streams" checked />Streams
                                    </label>
                                    <label class="btn btn-secondary active">
                                        <input type="checkbox" class="node_selection" name="node_selection"
                                            autocomplete="off" id="node_selection_apps" checked />Apps
                                    </label>
                                    <label class="btn btn-secondary active">
                                        <input type="checkbox" class="node_selection" name="node_selection"
                                            autocomplete="off" id="node_selection_sheets" checked />Sheets
                                    </label>
                                </div>

                                <li class="nav-item">
                                    <a class="nav-link" href="#"></a>
                                </li>

                                <li class="nav-item" data-toggle="tooltip" data-placement="bottom"
                                    title="Refresh Dataset">
                                    <a class="btn btn-secondary" href="javascript:refresh()"><i
                                            class="fas fa-sync-alt"></i></a>
                                </li>

                                <li class="nav-item invisible" id="data_refreshed_message">
                                    <span class="nav-link"><span style="font-weight: bold; color: #fff">Data
                                            refreshed!</span></span>
                                </li>
                            </ul>

                            <!-- Search Bootstrap Select -->
                            <div class="col-lg-5">
                                <select class="selectpicker" data-live-search="true" title="Find a Stream, App or Sheet"
                                    data-width="100%" data-size="10">
                                    <optgroup label="Streams" id="select_streams"></optgroup>
                                    <optgroup label="Apps" id="select_apps"></optgroup>
                                    <optgroup label="Sheets" id="select_sheets"></optgroup>
                                </select>
                            </div>
                        </nav>

                        <!-- Side Panel Modal -->
                        <div id="slider" class="side-panel">
                            <span class="slider-title" id="sheet_name"></span><br />
                            <span>Created at: </span><span id="created_at"></span><br />
                            <span>Published on: </span><span id="published_on"></span><br />
                            <span>Last Loaded: </span><span id="last_loaded"></span><br />
                            <hr />
                            <p style="font-weight: bold">Owner:</p>
                            <p id="owner"></p>
                            <p style="font-weight: bold">Application:</p>
                            <p id="app_name"></p>
                            <p style="font-weight: bold">Stream:</p>
                            <p id="stream_name"></p>
                            <hr />
                            <span class="slider-title">Access:</span><br />

                            <div style="position: absolute; bottom: 0; width: 96%; margin-bottom: 10px">
                                <hr />
                                <a href="" id="node_url" role="button" class="btn btn-primary"
                                    target="_new">Jump to</a>
                                <span class="slider-close"><button type="button" id="slider-close-button"
                                        class="btn btn-outline-dark">
                                        Close
                                    </button></span>
                            </div>
                        </div>

                        <!-- Loading Modal -->
                        <div id="loading_modal" class="modal" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Refreshing dataset...</h5>
                                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button> -->
                                    </div>
                                    <div class="modal-body">
                                        <p class="text-center">
                                            <img src="css/loading.gif" alt="Loading..." />
                                        </p>
                                    </div>
                                    <!-- <div class="modal-footer">
                                          <button type="button" class="btn btn-primary">Save changes</button>
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      </div> -->
                                </div>
                            </div>
                        </div>

                        <div id="legend">
                            <table width="100%">
                                <tr>
                                    <td class="" style="font-size: 20px">Root</td>
                                    <td class="text-center">
                                        <div class="circle" style="background: #28a745"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="" style="font-size: 20px">Stream</td>
                                    <td class="text-center">
                                        <div class="circle" style="background: #dc3545"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="" style="font-size: 20px">App</td>
                                    <td class="text-center">
                                        <div class="circle" style="background: #007bff"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="" style="font-size: 20px">Sheet</td>
                                    <td class="text-center">
                                        <div class="circle"
                                            style="
                                  background: #fff;
                                  border-width: 2px;
                                  border-style: solid;
                                  border-color: #000;
                                ">
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <!-- d3 Tree -->
                        <div id="render" class="mt-3"></div>

                        <script src="js/jquery-3.2.1.slim.min.js"></script>
                        <script src="js/jquery.slidereveal.min.js"></script>
                        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js" crossorigin="anonymous">
                        </script>
                        <script src="js/d3.v3.min.js"></script>
                        <script src="js/index.js"></script>
                        <script src="js/bootstrap-select.min.js"></script>
                        <script>
                            $("#slider").slideReveal({
                                trigger: $("#slider-close-button"),
                                position: "right",
                                push: false,
                                overlay: true,
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
@endsection
