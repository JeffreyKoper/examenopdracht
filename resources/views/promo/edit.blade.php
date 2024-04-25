@extends('layouts.default')
@section('content')
    <div class="promo-edit">
        <div class="edit-form">
            <h2>Edit Promo Code</h2>
            <form action="{{ route('promo.update', $promo->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="code">Promo Code:</label>
                    <input type="text" id="code" name="code" value="{{ $promo->code }}" placeholder="XXXX-XXXX-XXXX-XXXX, EveryWordCapatilized, etc." required>
                </div>
                <div class="form-group">
                    <label for="percentage">Percentage:</label>
                    <input type="number" id="percentage" name="percentage" min="0" max="100" value="{{ $promo->percentage }}" placeholder="0%" required>
                </div>
                <div class="form-group">
                    <label for="uses">Uses:</label>
                    <input type="number" id="uses" name="uses" min="0" value="{{ $promo->uses }}" placeholder="amount of uses" required>
                </div>
                <div class="form-group">
                    <label for="valid">Active:</label>
                    <select id="valid" name="valid" required>
                        <option value="1" {{ $promo->valid ? 'selected' : '' }}>True</option>
                        <option value="0" {{ !$promo->valid ? 'selected' : '' }}>False</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit">Update Promo Code</button>
                </div>
            </form>
        </div>
    </div>
@endsection
