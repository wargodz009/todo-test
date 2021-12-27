<div>
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>
    <h1 class="text-6xl font-bold leading-tight text-center text-base">Todo List</h1>

    <label for="new-todo"></label>
    <input wire:model="newTodo"
     wire:keydown.enter="addTodo()"
     class="flex-grow block pt-4 pb-4 pl-2 text-2xl italic font-normal text-gray-700 border-l-2 border-indigo-600 outline-none"
     type="text" name="new-todo" id="new-todo" placeholder="add Todo ?" autofocus>

    <ul>
    @foreach($todos as $todo)
        @if($updateTodoId == $todo->id)
                <label for=""></label>
                <input type="text" wire:model="oldTodoValue">
                <i wire:click="updateTodoValue({{ $todo->id }})">Save</i>
        @else
            <li class="@if($todo->status == 0) line-through @endif">{{ $todo->value }}
                <i wire:click="deleteTodo({{ $todo->id }})">delete</i>
                <i wire:click="updateTodoStatus({{ $todo->id }},{{ $todo->status }})">@if($todo->status == 1) Complete @else Incomplete @endif </i>
                <i wire:click="setUpdateTodoValue({{ $todo->id }},'{{ $todo->value }}')">Update</i>
            </li>
        @endif
    @endforeach
    </ul>
</div>
