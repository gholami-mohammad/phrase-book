@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xs-12 col-sm-12">
            <p class="">
                <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    Filters
                </a>
            </p>
            <div class="collapse" id="collapseExample">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="GET">
                            <div class="form-group">
                                <label for="from">Source language</label>
                                <select name="from" id="from" class="form-control">
                                    @foreach ($langs as $lang)
                                    <option value="{{$lang->alpha2code}}" data-dir="{{$lang->dir}}"
                                    {{request()->input("from", null) == $lang->alpha2code ? "selected" : ""}}>{{$lang->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="word">Word</label>
                                <input type="text" name="word" id="word" class="form-control" value="{{request()->input('word', null)}}">
                            </div>
                            <div>
                                <button type="submit" class="btn btn-sm btn-primary">filter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>word</th>
                                <th>Language</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($words as $w)
                            <tr class="phrasebook-row" data-id='{{$w->id}}'>
                                <td>{{$w->word}}</td>
                                <td>{{$w->language->alpha2code}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection