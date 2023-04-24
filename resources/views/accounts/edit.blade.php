@extends('layouts.app')

@section('title')
    Creation
@endsection

@section('content')
    
<form action="{{ route('accounts.update', $account->id) }}" method="POST">
    @csrf
    
    <input type="text" name="amount" placeholder="Amount" value="{{$account->amount}}"/>
    <input type="text" name="notes" placeholder="Notes" value="{{$account->notes}}"/>

    <div class="switch">
    <label>
      not income
      @if($account->income)
      <input type="checkbox" name="income" value="1" checked>
      @else
      <input type="checkbox" name="income" value="1">
      @endif
      <span class="lever"></span>
      income
    </label>
  </div>

  <div class="switch">
    <label>
      credit card
      @if($account->cash)
      <input type="checkbox" name="cash" value="1" checked>
      @else
      <input type="checkbox" name="cash" value="1">
      @endif
      <span class="lever"></span>
      cash
    </label>
  </div>
    
    <button type="submit">Update</button>
</form>

@endsection