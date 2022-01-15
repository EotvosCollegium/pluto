@extends('layouts.app')

@section('title')

Felhasználói email: 
{{ auth()->user()->email }}

@endsection

@section('content')


<div class="row">
    <div class="col s10">
      <div class="card-panel teal">
      
        <a href="{{ route('accounts.create') }}" class="btn-floating btn-large waves-effect waves-light green accent-3 right"><i class="material-icons">add</i></a>
        <span class="white-text">
        <p>
          Total account: {{ $income_sum - $expense_sum }}
        </p>
        <p>
          Total income: {{ $income_sum }}
        </p>
        <p>
          Total expense: {{ $expense_sum }}
        </p>

        </span>
        
      
      </div>
    </div>
</div>

              

@foreach ($accounts as $account)
<!-- TODO: cash/card symboles according to the rigth boolean value -->

<div class="row" style="margin-bottom:0px;">
  <div class="col s10">
    <ul class="collapsible">
      @if($account->income)
      <li>
        <div class="collapsible-header teal lighten-2" >
          @if($account->cash)   
          <i class="material-icons">attach_money</i>
          @else
          <i class="material-icons">credit_card</i>
          @endif
          {{ $account->amount }}
          <span class="badge" data-badge-caption="{{ $account->created_at }}"></span>
        </div>
        <div class="collapsible-body teal lighten-3">
          <p>{{ $account->notes }}</p>
        </div>
      </li>
      @else
      <li>
        <div class="collapsible-header red lighten-2">
          @if($account->cash)   
          <i class="material-icons">attach_money</i>
          @else
          <i class="material-icons">credit_card</i>
          @endif          
          {{ $account->amount }}
          <span class="badge" data-badge-caption="{{ $account->created_at }}"></span>
        </div>
        <div class="collapsible-body red lighten-3">
          <p>{{ $account->notes }}</p>
        </div>
      </li>
      @endif
    </ul>

  </div>
    <div class="col s2">
      <div class="valign-wrapper">
          <p>
            <a href="{{ route('accounts.edit', $account->id) }}" class="btn-floating btn-medium waves-effect waves-light blue lighten-4" style="margin-right: 2pt"><i class="material-icons">edit</i></a>
            <a href="{{ route('accounts.destroy', $account->id) }}" class="btn-floating btn-medium waves-effect waves-light red lighten-2"><i class="material-icons">delete</i></a>
          </p>
    </div>
  </div>
</div>

@endforeach

@endsection

