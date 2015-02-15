@extends('admininja::layouts.master')

@section('content')
	<h1 title="{{ $title }}">{{ $title }}</h1>
	{!! Form::open(['url' => isset($object) ? route('admininja.model.update', ['model' => $modelName, 'id' => $object->id]) : route('admininja.model.store', ['model' => $modelName]), 'method' => isset($object) ? 'put' : 'post', 'class' => 'form-horizontal']) !!}
		@foreach($fields as $field => $options)
			<div class="form-group">
				{!! Form::label($field, $field, ['class' => 'col-sm-2 control-label']) !!}
				<div class="col-sm-10">
					@if($options['type'] === 'text')
						{!! Form::text($field, isset($object) ? $object->{$field} : null, ['class' => 'form-control']) !!}
					@endif
				</div>
			</div>
		@endforeach
		<div class="form-group">
			<div class="col-sm-10 col-sm-offset-2">
				{!! Form::submit('Save', ['class' => 'btn btn-default']) !!}
			</div>
		</div>
	{!! Form::close() !!}
@stop