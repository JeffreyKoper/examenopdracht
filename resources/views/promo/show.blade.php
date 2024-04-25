@extends('layouts.default')
@section('content')
    <h1>Promo codes:</h1>
    <div class="promo">
        <table>
            <tr>
                <th>id</th>
                <th>Code</th>
                <th>Percentage</th>
                <th>Uses left</th>
                <th>Active? </th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            @foreach($promo_data as $data)
                <tr>
                    <td>{{$data->id}}</td>
                    <td>{{$data->code}}</td>
                    <td>{{$data->percentage}}%</td>
                    <td>{{$data->uses}}</td>
                    @if($data->valid == 1)
                        <td>Active</td>
                    @else
                        <td>Inactive</td>
                    @endif
                    <td><a href="{{ route('promo.edit', $data->id) }}"><button>Edit</button></a></td>
                    <td>
                        <form id="deleteForm{{$data->id}}" action="{{route('promo.delete', $data->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        <div class="create-section">
            <h2>Create a New Promo Code</h2>
            <div class="create-button">
                <form action="{{route('promo.createForm')}}">
                    <button>Create New Promo Code</button>
                </form>
            </div>
        </div>
    </div>
@endsection
