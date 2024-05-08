@extends('layouts.default')
@section('content')
    <div class="create-form">
        <h2>Create a New Promo Code</h2>
        <form action="{{route('promo.create')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="code">Promo Code:</label>
                <input type="text" id="code" name="code" placeholder="XXXX-XXXX-XXXX-XXXX, EveryWordCapatilized, etc." required>
            </div>
            <div class="form-group">
                <label for="percentage">Percentage:</label>
                <input type="number" id="percentage" name="percentage" min="0" max="100" placeholder="0%" required>
            </div>
            <div class="form-group">
                <label for="uses">Uses:</label>
                <input type="number" id="uses" name="uses" min="0" placeholder="amount of uses" required>
            </div>
            <div class="form-group">
                <label for="valid">Active:</label>
                <select id="valid" name="valid" required>
                    <option value="1">True (default)</option>
                    <option value="0">False</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit">Create Promo Code</button>
            </div>
        </form>
    </div>
@endsection
