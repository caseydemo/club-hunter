@extends('layouts.app-panel')

@section('title')
Let's Find a Venue
<a href="/home"><button class="btn btn-alert">Back to search</button></a>

@endsection

@section('content')
@if(!empty(\Auth::user()->name))
	@for($i=0; $i<$search_count-1; $i++)
		<form action="/recent-searches" method="post" class="input form-inline" id="{{$i}}">
	    <input type="hidden" name="_token" value="{{ csrf_token() }}">
	    <input type="hidden" name="lattitude" value="{{ $lattitude[$i] }}" >
	    <input type="hidden" name="longitude" value="{{ $longitude[$i] }}">
	    <input type="hidden" name="keyword" value="{{ $recent_keyword[$i]}} ">
	    <input type="hidden" name="city-name" value="{{ $recent_city[$i]}} ">
	    <input type="hidden" name="search-date" value="{{ $searched_at[$i] }}">
		</form>
	@endfor

	<div style="margin-top: 20px;" class="flex-center position-ref full-height">
    <div class="jumbotron vertical-center">
	<div class="jumbo-center">

	<h3>{{ \Auth::user()->name }}'s Recent Searches</h3>
	<table class="table table-striped">
		<tr>
		    <th>City</th>
		    <th>Keyword</th> 
		    <th>Searched At</th>
		    <th>Delete</th>
	  	</tr>
	@for($i=0; $i<$search_count-1; $i++)
		@if($user_id[$i]==\Auth::user()->name)		  
				  	<tr>
				  		<td><button style="font-weight: bold" class="btn hvr-bounce-to-right" type="submit" form="{{$i}}">{{ $recent_city[$i] }}</button></td>
					    <td>{{ $recent_keyword[$i] }}</td>
					    <td>{{ $searched_at[$i] }}</td>
					     <td>
						     <form class="button-form" method="post" action="/places/{{ $recent_search_id[$i] }}">
						     	{{ csrf_field() }}
	      						{{ method_field('DELETE') }}
	      						<button class="btn">
	      						<i class="fa fa-trash" aria-hidden="true"></i>
	      						</button>
						     </form>
						 </td>
					</tr>
				@endif
		@endfor
		</table>
@endif
			</div>
		</div>
	</div>
	</body>
@endsection