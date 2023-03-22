@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Event</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">

</head>

<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Event') }}</div>
                    <div class="container mt-2">
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Edit Event information</h2>
                </div>
            </div>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <form id="live_form" action="{{ route('events.update', $event->id) }}" method="Post" enctype="multipart/form-data" class="pb-3">
        @csrf
        @method('PUT')

            @foreach($errors->all() as $error)
                {{ $error  }}
            @endforeach

            <!-- creating events -->
            @foreach($errors->all() as $error)
                {{ $error  }}
            @endforeach
            <div class="d-flex gap-3 w-100">
                <div class="d-flex flex-column w-50">
                    <div class="row mb-3 ">
                        <label for="name" class="col-form-label" >{{ __('Name:*') }}</label>
                        <div class="col-md-6 w-100">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $event->name) }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="image" class="col-form-label">{{ __('Image:') }}</label>
                        <div class="col-md-6 w-100">
                            <input id="image" type="file" class="form-control @error('image') is-invalid @enderror w-100" name="image" value="{{old('image', $event->image)}}" autocomplete="image">
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-column w-50">
                    <div class="row mb-3">
                        <label for="eventType" class="col-form-label">{{ __('Event Type:*') }}</label>
                        <div class="col-md-6 w-100">
                            <select id="eventType" type="text" class="form-control @error('eventType') is-invalid @enderror" name="eventType" value="{{ old('eventType', $event->eventType) }}" required autocomplete="eventType" selected="Birth">
                                <option value="Death">Death</option>
                                <option value="Birth">Birth</option>
                                <option value="Birth">Other</option>
                            </select>
                            @error('eventType')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="epoce" class="col-form-label">{{ __('Epoce:*') }}</label>
                        <div class="col-md-6 w-100">
                            <select id="epoce" type="text" class="form-control @error('epoce') is-invalid @enderror" name="epoce" value="{{ old('epoce', $event->epoce) }}" required autocomplete="epoce" selected="AC">
                                <option value="BC">B.C.</option>
                                <option value="AC">A.C.</option>
                            </select>
                            @error('epoce')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>                                
            </div>
            <hr/>
                
                <div>
                <div>
                    <div class="form-group">
                        <label class="control-label">Select 'yes' if you know the exact date of the event, else select 'no'.</label>
                    <div>
                    @if($event->event_trigger_date == '')
                    <div class="radio">
                        <label class="radio">
                        <input name="rating" type="radio" value="Yes" checked="checked"/>
                        Yes
                        </label>
                    </div>
                    <div class="radio">
                        <label class="radio">
                        <input name="rating" type="radio" value="No" />
                        No
                        </label>
                    </div>
                    @endif
                    @if($event->year == '')
                    <div class="radio">
                        <label class="radio">
                        <input name="rating" type="radio" value="Yes"/>
                        Yes
                        </label>
                    </div>
                    <div class="radio">
                        <label class="radio">
                        <input name="rating" type="radio" value="No" checked="checked"/>
                        No
                        </label>
                    </div>

                    @endif
                </div>
            </div>
            <!--  -->
            @if($event->event_trigger_date == '')

                <div class="form-group d-flex gap-2">
                    <div class="row mb-3">
                        <label for="year" class="col-form-label">{{ __('Year:*') }}</label>
                        <div class="col-md-6 w-100">
                            <input id="year" type="text" class="form-control @error('year') is-invalid @enderror" name="year" value="{{ old('year', $event->year) }}"  autocomplete="year">
                            @error('year')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="month" class="col-form-label">{{ __('Month:*') }}</label>
                        <div class="col-md-6 w-100">
                            <input id="month" type="number" class="form-control @error('month') is-invalid @enderror" name="month" value="{{ old('month', $event->month) }}" autocomplete="month">
                            @error('month')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3" id="feedback_yes" name="feedback_yes">
                        <label for="day" class="col-form-label">{{ __('Day:*') }}</label>
                        <div class="col-md-6 w-100">
                            <input type="number" id="day" class="form-control @error('day') is-invalid @enderror" name="day" value="{{ old('day', $event->day) }}" autocomplete="day"/>
                            @error('day')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                </div>
                <div class="form-group d-none w-50">
                    <div class="row mb-3" id="feedback_no" name="feedback_no">
                        <label for="event_trigger_date" class="col-form-label">{{ __('Event Date:') }}</label>
                        <div class="col-md-6 w-100">
                            <input id="datepicker" type="text" class="form-control @error('event_trigger_date') is-invalid @enderror w-100" name="event_trigger_date" value="{{old('event_trigger_date', $event->event_trigger_date)}}" autocomplete="event_trigger_date">
                            @error('event_trigger_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            @endif
            @if($event->year == '' && $event->month == '' && $event->day == '')
                <div class="form-group d-none d-flex gap-2">
                    <div class="row mb-3">
                        <label for="year" class="col-form-label">{{ __('Year:*') }}</label>
                        <div class="col-md-6 w-100">
                            <input id="year" type="text" class="form-control @error('year') is-invalid @enderror" name="year" value="{{ old('year', $event->year) }}"  autocomplete="year">
                            @error('year')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="month" class="col-form-label">{{ __('Month:*') }}</label>
                        <div class="col-md-6 w-100">
                            <input id="month" type="number" class="form-control @error('month') is-invalid @enderror" name="month" value="{{ old('month', $event->month) }}" autocomplete="month">
                            @error('month')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3" id="feedback_yes" name="feedback_yes">
                        <label for="day" class="col-form-label">{{ __('Day:*') }}</label>
                        <div class="col-md-6 w-100">
                            <input type="number" id="day" class="form-control @error('day') is-invalid @enderror" name="day" value="{{ old('day', $event->day) }}" autocomplete="day"/>
                            @error('day')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                </div>
                <div class="form-group  w-50">
                    <div class="row mb-3" id="feedback_no" name="feedback_no">
                        <label for="event_trigger_date" class="col-form-label">{{ __('Event Date:') }}</label>
                        <div class="col-md-6 w-100">
                            <input id="datepicker" type="text" class="form-control @error('event_trigger_date') is-invalid @enderror w-100" name="event_trigger_date" value="{{old('event_trigger_date', $event->event_trigger_date)}}" autocomplete="event_trigger_date">
                            @error('event_trigger_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            @endif
                <div class="row mb-3">
                    <label for="description" class="col-form-label">{{ __('Description:*') }}</label>
                    <div class="col-md-6 w-100">
                        <textarea id="description" type="text" class="textarea @error('description') is-invalid @enderror" value="{{ old('description', $event->description) }}" autocomplete="description" name="description" cols="22" rows="5">
                            {{$event->description}}
                        </textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-0 mt-4">
                    <div class="d-flex gap-1">
                        <div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-dark" href="{{ route('events.index') }}" enctype="multipart/form-data">
                                Back</a>
                        </div>
                    </div>
                </div>
            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
    $(document).ready( function() {
        $( "#datepicker" ).datepicker({
            dateFormat:"yy-mm-dd"
        });
    } );
    </script>
<script>
    $( document ).ready(function() { //wait until body loads

        //Inputs that determine what fields to show
        var rating = $('#live_form input:radio[name=rating]');
        var testimonial=$('#live_form input:radio[name=testimonial]');				

        //Wrappers for all fields
        var yes = $('#live_form div[name="feedback_yes"]').parent();
        var no = $('#live_form div[name="feedback_no"]').parent();
        var great = $('#live_form textarea[name="feedback_great"]').parent();
        var testimonial_parent = $('#live_form #div_testimonial');
        var thanks_anyway  = $('#live_form #thanks_anyway');
        var all=yes.add(no).add(great).add(testimonial_parent).add(thanks_anyway); //shortcut for all wrapper elements

        rating.change(function(){ //when the rating changes
            var value=this.value;	

            console.log(rating, 'this is rating');					

            console.log(value);					
            all.addClass('d-none'); //hide everything and reveal as needed
            
            if (value == 'Yes' ){
                yes.removeClass('d-none'); //show feedback_yes	
                document.getElementById("datepicker").value='';
				
            }
            else if (value == 'No'){
                is_value = false;
                no.removeClass('d-none'); //show feedback_no	
                document.getElementById("year").value='';
                document.getElementById("month").value='';
                document.getElementById("day").value='';

            }		
            console.log(is_value);
        });	
    });
    </script>
        <!-- TinyMcs script -->
        <script src="{{ asset('js/tinymce/tinymce.js')}}"></script>

    <script>
        tinymce.init({
            selector: '#description', 
            plugins: [ "image", "code", "table", "link", "media", "codesample"],
            toolbar: 'undo redo | blocks| bold italic | bullist numlist checklist | code | table'
        });
    </script>

</body>

</html>
@endsection