@extends('layouts.dashboard')

@section('content')


<div class="card">
    <div class="card-header">
        <h3 class="float-left mb-0">Create New Attendance</h3>
        <div class="btn-group btn-group-sm float-right" role="group">
            <a href="{{ route('attendances.attendance.index') }}" class="btn btn-primary" title="Show All Attendance">
                <span class="fas fa-th-list" aria-hidden="true"></span> All List
            </a>
        </div>
    </div>
    <div class="card-body">

        @if ($errors->any())
        <ul class="list-unstyled alert alert-danger">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif

        {!! Form::open([
        'route' => 'attendances.attendance.store',
        'class' => 'form-horizontal',
        'name' => 'create_attendance_form',
        'id' => 'create_attendance_form',

        ])
        !!}

        @include ('attendances.form', ['attendance' => null,])
        <div class="form-group">
            <div class="col-md-offset-2 col-md-10">
                {!! Form::submit('Add', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>

        {!! Form::close() !!}
    </div>
</div>
@endsection