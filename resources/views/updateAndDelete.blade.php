@extends('layouts.app')


@section('content')



    <div class=" row">
        <div class="col-lg-12 margin-tb">
        <div class="center-align">
            <h2> Update or delete recipes</h2>
        </div>

    </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div id="scrolltable">

    <table class="table highlight">
        <tr><th><div>Number</div></th>
            <th><div>Recipe id</div></th>
            <th><div>Recipe name</div></th>
            <th width="280px"><div>Action</div></th>

        </tr>

        @foreach ($recipes as $key => $item)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $item->recipe_id }}</td>
                <td>{{ $item->recipe_name }}</td>
                <td>
                    <a class="btn btn-primary" href="{{ route('updateFinal.edit',$item->recipe_id) }}">Edit</a>
                    {!! Form::open(['method' => 'DELETE','route' => ['updateFinal.delete', $item->recipe_id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>
    </div>





@endsection