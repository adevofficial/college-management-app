@extends('layouts.dashboard')

@section('content')

@if(Session::has('success_message'))
<div class="alert alert-success">
    <span class="fas fa-check"></span>
    {!! session('success_message') !!}

    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>

</div>
@endif

<div class="card">
    <div class="card-header">
        <h4 class="cards-title mb-0 float-left">Subjects</h4>
        @can('create-subjects')
        <a href="{{ route('subjects.subject.create') }}" class="btn btn-success btn-sm float-right"
            title="Create New Subject">
            <span class="fas fa-plus" aria-hidden="true"></span> Create Subjects
        </a>
        @endcan
    </div>
    @if(count($subjects) == 0)
    <div class="card-body p-0 text-center">
        <h4>No Subjects Available.</h4>
    </div>
    @else
    <div class="card-body p-0">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Teacher</th>
                    <th>Student Class</th>

                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($subjects as $subject)
                <tr>
                    <td>{{ $subject->name }}</td>
                    <td>{{ isset($subject->teacher->name) ? $subject->teacher->name : '' }}</td>
                    <td>{{ isset($subject->studentClass->batch_name) ? $subject->studentClass->batch_name : '' }}</td>

                    <td>

                        {!! Form::open([
                        'method' =>'DELETE',
                        'route' => ['subjects.subject.destroy', $subject->id],
                        'style' => 'display: inline;',
                        ]) !!}
                        <div class="float-right">

                            <a href="{{ route('attendances.attendance.report', [$subject->student_class_id,$subject->id] ) }}"
                                class="btn btn-sm btn-info" title="Attendance Report">
                                Attendance Report
                            </a>
                            <div class="btn-group btn-group-xs" role="group">
                                @can('view-subjects')
                                <a href="{{ route('subjects.subject.show', $subject->id ) }}"
                                    class="btn btn-sm btn-info" title="Show Subject">
                                    <span class="fas fa-eye" aria-hidden="true"></span> Open
                                </a>
                                @endcan
                                @can('edit-subjects')

                                <a href="{{ route('subjects.subject.edit', $subject->id ) }}"
                                    class="btn btn-sm btn-primary" title="Edit Subject">
                                    <span class="fas fa-pen" aria-hidden="true"></span> Edit
                                </a>
                                @endcan
                                @can('delete-subjects')

                                {!! Form::button('<span class="fas fa-trash" aria-hidden="true"></span> Delete',
                                [
                                'type' => 'submit',
                                'class' => 'btn btn-sm btn-danger',
                                'title' => 'Delete Subject',
                                'onclick' => 'return confirm("' . 'Click Ok to delete Subject.' . '")'
                                ])
                                !!}
                                @endcan

                            </div>
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if ($subjects->hasPages())
    <div class="card-footer">
        {!! $subjects->render() !!}
    </div>
    @endif
    @endif
</div>
@endsection