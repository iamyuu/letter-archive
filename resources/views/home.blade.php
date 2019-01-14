@extends('layouts.app')

@section('title', 'Home')

@section('content')
{{-- @if (Auth::id() == 1)
    <div class="row" style="margin-bottom: 10px;">
        <div class="col s12 m4">
            <div class="card">
                <i class="medium material-icons" style="margin-left: 37.5%">inbox</i>
            </div>
        </div>
        <div class="col s12 m4">
            <div class="card">
                <i class="medium material-icons" style="margin-left: 37.5%">mail</i>
            </div>
        </div>
        <div class="col s12 m4">
            <div class="card">
                <i class="medium material-icons" style="margin-left: 37.5%">assignment</i>
            </div>
        </div>
    </div>
@elseif (Auth::id() == 2)
    <div class="row" style="margin-bottom: 10px;">
        <div class="col s12 m4">
            <div class="card">
                <div class="y-widget-content">
                    <p class="y-widget-title">
                        <i class="material-icons">inbox</i> Letter In
                    </p>
                    <h4 class="y-widget-number">566</h4>
                </div>
                <div class="card-action">
                    <i class="small material-icons right">wc</i>
                </div>
            </div>
            <div class="card">
                <i class="medium material-icons" style="margin-left: 37.5%">inbox</i>
            </div>
        </div>
        <div class="col s12 m4">

            <!-- <div class="card">
                <i class="medium material-icons" style="margin-left: 37.5%">mail</i>
            </div> -->
        </div>
        <div class="col s12 m4">

            <!-- <div class="card">
                <i class="medium material-icons" style="margin-left: 37.5%">assignment</i>
            </div> -->
        </div>
    </div> --}}
    <div class="card-panel">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus illo consectetur aut, asperiores repellendus unde, atque! Blanditiis est modi alias quis, veniam sit iste maxime possimus beatae aut recusandae dignissimos!
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Impedit iste delectus pariatur sint possimus deleniti qui, obcaecati at, non ab provident fugit earum laudantium similique explicabo incidunt asperiores architecto quasi.
    </div>
{{-- @elseif (Auth::id() > 3)
    <script>window.location = 'inbox'</script>
@endif --}}
@endsection