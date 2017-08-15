<table class="table table-responsive" id="codes-table">
    <thead>
        <th>Reference</th>
        <th>Merchant Id</th>
        <th>Legacy</th>
        <th>Name</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($codes as $code)
        <tr>
            <td>{!! $code->reference !!}</td>
            <td>{!! $code->merchant_id !!}</td>
            <td>{!! $code->legacy !!}</td>
            <td>{!! $code->name !!}</td>
            <td>
                {!! Form::open(['route' => ['codes.destroy', $code->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('codes.show', [$code->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('codes.edit', [$code->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>