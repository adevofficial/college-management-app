@extends('layouts.dashboard')

@section('content')


<div class="card">
        <div class="card-header">
          <h3 class="float-left mb-0">Create New Role Has Permission</h3>
          <div class="btn-group btn-group-sm float-right" role="group">
                <a href="{{ route('role_has_permissions.role_has_permission.index') }}" class="btn btn-primary" title="Show All Role Has Permission">
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
                'route' => 'role_has_permissions.role_has_permission.store',
                'class' => 'form-horizontal',
                'name' => 'create_role_has_permission_form',
                'id' => 'create_role_has_permission_form',
                
                ])
            !!}

            @include ('role_has_permissions.form', ['roleHasPermission' => null,])
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    {!! Form::submit('Add', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>

            {!! Form::close() !!}
        </div>
      </div>
@endsection