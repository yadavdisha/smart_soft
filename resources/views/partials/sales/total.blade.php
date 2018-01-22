
<h1>hi disha</h1>

<!--@section('content')
<h1>hiiii</h1>
    <table class="table table-bordered" id="users-table">
        <h1>helloooo<h1>
        <thead>
        <tr>
            <th>Id</th>
            <th>order_id</th>
        </tr>
        </thead>

    </table>
@stop

@push('scripts')
<script>
    $(function () {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('datatables.data') !!}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'order_id', name: 'order_id'},

            ]
        });
    });
</script>
@endpush-->