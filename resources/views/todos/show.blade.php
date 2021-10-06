{{-- parameter: $todo --}}

<div class="card">
    <div class="card-content">
      <span class="card-title">{{ $todo->name }}</span>
      @if(isset($todo->description))
        <p>{{ $todo->description }}</p>
      @endif
      <table>
          <tr>
              <th>@lang('todo.uploader')</th>
              <td>{{ $todo->user->name }}</td>
          </tr>
          <tr>
              <th>@lang('todo.expire')</th>
              <td>{{ $todo->expiration_date }}</td>
          </tr>
          <tr>
              <th>@lang('todo.state')</th>
              <td>
                @if ($todo->completed)
                    @lang('todo.done')
                @else
                    @if (isset($todo->expiration_date) && $todo->expiration_date < Date::now())
                        @lang('todo.expired')
                    @else
                        @lang('todo.in_progress')
                    @endif
                @endif
              </td>
          </tr>
          <tr>
            <th>@lang('todo.assigned_users')</th>
            <td>
              @foreach ($todo->assigned_users as $user)
                {{ $user->name }}
              @endforeach
            </td>
          </tr>
          <tr>
            <th>@lang('todo.assign_users')</th>
            <td>
              @foreach (\App\Models\User::all() as $user)
                <form action="{{ route('todos.update', $todo->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <button type="submit" class="btn btn-flat">{{ $user->name }}</button>
                </form>
              @endforeach
            </td>
          </tr>

      </table>
    </div>
    <div class="card-action">
        <form action="{{ route('todos.mark_as_done', $todo->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn">@lang('todo.done')</button>
        </form>
    </div>
  </div>