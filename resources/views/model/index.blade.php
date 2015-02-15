@extends('admininja::layouts.master')

@section('content')
	<h1 title="{{ $title }}">{{ $title }}</h1>
	<a href="{{ route('admininja.model.create', ['model' => $modelName]) }}" class="btn btn-success" role="button">New</a>
	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					@foreach($columns as $column)
						<th>{{ $column }}</th>
					@endforeach
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($rows as $row)
					<tr>
						@foreach($columns as $i => $column)
							<td>{{ $row->{$fields[$i]} }}</td>
						@endforeach
						<td>
							<a href="{{ route('admininja.model.edit', ['model' => $modelName, 'id' => $row->id]) }}" class="btn btn-xs btn-default" role="button">Edit</a>
							<a href="{{ route('admininja.model.destroy', ['model' => $modelName, 'id' => $row->id]) }}" class="btn btn-xs btn-danger" role="button" data-method="delete">Delete</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@stop