@extends('layouts.app')

@section('title')
    Creation
@endsection

@section('content')
    
<form action="{{ route('accounts.store') }}" method="POST">
    @csrf
    
    <input type="text" name="amount" placeholder="Amount"/>
    <input type="text" name="notes" placeholder="Notes"/>

    <div class="switch">
    <label>
      not income
      <input type="checkbox" name="income" value="1">
      <span class="lever"></span>
      income
    </label>
  </div>

  <div class="switch">
    <label>
      credit card
      <input type="checkbox" name="cash" value="1">
      <span class="lever"></span>
      cash
    </label>
  </div>
    
    <button type="submit">Creation</button>
</form>

@endsection