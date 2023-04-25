<div class="table-responsive">
    <table class="table" id="calls-table">
        <thead>
        <tr>
            <th>Type</th>
        <th>State Id</th>
        <th>Locality Id</th>
        <th>Htype Id</th>
        <th>Sec Status</th>
        <th>Details</th>
        <th>Area</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Phone2</th>
        <th>Img</th>
        <th>Status</th>
        <th>Comment</th>
        <th>Updated By</th>
        <th>Assigned By</th>
        <th>Completed By</th>
        <th>Confirmed By</th>
        <th>User Id</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($calls as $call)
            <tr>
                <td>{{ $call->type }}</td>
            <td>{{ $call->state_id }}</td>
            <td>{{ $call->locality_id }}</td>
            <td>{{ $call->htype_id }}</td>
            <td>{{ $call->sec_status }}</td>
            <td>{{ $call->details }}</td>
            <td>{{ $call->area }}</td>
            <td>{{ $call->address }}</td>
            <td>{{ $call->phone }}</td>
            <td>{{ $call->phone2 }}</td>
            <td>{{ $call->img }}</td>
            <td>{{ $call->status }}</td>
            <td>{{ $call->comment }}</td>
            <td>{{ $call->updated_by }}</td>
            <td>{{ $call->assigned_by }}</td>
            <td>{{ $call->completed_by }}</td>
            <td>{{ $call->confirmed_by }}</td>
            <td>{{ $call->user_id }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['calls.destroy', $call->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('calls.show', [$call->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('calls.edit', [$call->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
