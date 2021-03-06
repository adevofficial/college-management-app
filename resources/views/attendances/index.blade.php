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
        <h4 class="cards-title mb-0 float-left">Attendances</h4>
        @can('create-attendance')
        <a href="{{ route('attendances.attendance.create') }}" class="btn btn-success btn-sm float-right"
            title="Create New Attendance">
            <span class="fas fa-plus" aria-hidden="true"></span> Create Attendances
        </a>
        @endcan
    </div>
    @if(count($attendances) == 0)
    <div class="card-body p-0 text-center">
        <h4>No Attendances Available.</h4>
    </div>
    @else
    <div class="card-body p-0">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Marked At</th>
                    <th>Slot</th>
                    <th>Subject</th>
                    <th>Student Class</th>
                    <th>Teacher</th>

                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->marked_at_human }}</td>
                    <td>{{ isset($attendance->slot->name) ? $attendance->slot->name : '' }}</td>
                    <td>{{ isset($attendance->subject->name) ? $attendance->subject->name : '' }}</td>
                    <td>{{ isset($attendance->studentClass->batch_name) ? $attendance->studentClass->batch_name : '' }}
                    </td>
                    <td>{{ isset($attendance->teacher->name) ? $attendance->teacher->name : '' }}</td>

                    <td>

                        {!! Form::open([
                        'method' =>'DELETE',
                        'route' => ['attendances.attendance.destroy', $attendance->id],
                        'style' => 'display: inline;',
                        ]) !!}

                        <div class="btn-group btn-group-xs float-right" role="group">
                            @can('view-attendance')
                            <a href="{{ route('attendances.attendance.show', $attendance->id ) }}"
                                class="btn btn-sm btn-info" title="Show Attendance">
                                <span class="fas fa-eye" aria-hidden="true"></span> Open
                            </a>
                            @endcan
                            @can('edit-attendance')
                            <a href="{{ route('attendances.attendance.edit', $attendance->id ) }}"
                                class="btn btn-sm btn-primary" title="Edit Attendance">
                                <span class="fas fa-pen" aria-hidden="true"></span> Edit
                            </a>
                            @endcan
                            @can('delete-attendance')

                            {!! Form::button('<span class="fas fa-trash" aria-hidden="true"></span> Delete',
                            [
                            'type' => 'submit',
                            'class' => 'btn btn-sm btn-danger',
                            'title' => 'Delete Attendance',
                            'onclick' => 'return confirm("' . 'Click Ok to delete Attendance.' . '")'
                            ])
                            !!}
                            @endcan
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if ($attendances->hasPages())
    <div class="card-footer">
        {!! $attendances->render() !!}
    </div>
    @endif
    @endif
</div>
@endsection