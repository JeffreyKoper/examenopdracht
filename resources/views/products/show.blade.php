@extends('layouts.default')
@section('content')
    <h1>Products:</h1>
    <div class="promo">
        <table>
            <tr>
                <th>id</th>
                <th>Product_Name</th>
                <th>Description</th>
                <th>Excerpt</th>
                <th>Img_filepath/url</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Size</th>
                <th>Variant</th>
                <th>Category</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            @foreach($product_data as $data)
                <tr>
                    <td>{{$data->id}}</td>
                    <td>{{$data->product_name}}</td>
                    <td>{{$data->description}}</td>
                    <td>{{$data->excerpt}}</td>
                    <td style=" max-width:200px; overflow: hidden; text-overflow: ellipsis;">{{$data->img_filepath}}</td>
                    <td>{{$data->price}}</td>
                    <td>{{$data->stock}}</td>
                    <td>{{$data->size}}</td>
                    <td>{{$data->variant}}</td>
                    <td>{{$data->category}}</td>
                    <td><a href="{{ route('products.edit', $data->id) }}"><button>Edit</button></a></td>
                    <td>
                        <form id="deleteForm{{$data->id}}" action="{{route('products.delete', $data->id)}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>                    
                    </td>
                </tr>
            @endforeach
        </table>
        <div class="product_pagination second-pagination">
            {{ $product_data->links() }}
        </div>
        <div class="create-section">
            <h2>Create a New Product</h2>
            <div class="create-button">
                <form action="{{route('products.showCreate')}}">
                    <button>Create New Product</button>
                </form>
            </div>
        </div>
    </div>
@endsection
