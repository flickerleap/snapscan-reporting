<table class="table table-responsive" id="merchants-table">
    <thead>
        <th>Name</th>
        <th>Merchant Code</th>
        <th>Api Key</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($merchants as $merchant)
        <tr>
            <td>{!! $merchant->name !!}</td>
            <td>{!! $merchant->merchant_code !!}</td>
            <td>{!! $merchant->api_key !!}</td>
            <td>
                {!! Form::open(['route' => ['merchants.destroy', $merchant->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('merchants.show', [$merchant->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('merchants.edit', [$merchant->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>