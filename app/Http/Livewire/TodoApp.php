<?php

namespace App\Http\Livewire;

use App\Models\Todo;
use Livewire\Component;

class TodoApp extends Component
{
    public $newTodo = '';
    public $updateTodoId = '';
    public $oldTodoValue = '';

    public function render()
    {
        $allTodo = Todo::where('user_id',auth()->user()->id)->orderBy('id','desc')->get();
        return view('livewire.todo-app',[
            'todos' => $allTodo
        ]);
    }
    public function addTodo() {
        $this->validate(['newTodo' => 'required',],['newTodo.required' => 'A new todo can\'t be empty.',]);
        $todo = new Todo();
        $todo->value = $this->newTodo;
        $todo->user_id = auth()->user()->id;
        $todo->save();
        $this->newTodo = '';
        session()->flash('message', 'Todo successfully Added.');
    }
    public function deleteTodo($todoid) {
        Todo::destroy($todoid);
        session()->flash('message', 'Todo successfully Deleted.');
    }

    public function updateTodoStatus($todoId,$todoStatus)
    {
        Todo::where('id',$todoId)->update(
            ['status'=> !$todoStatus]
        );
        session()->flash('message', 'Todo successfully Updated.');
    }
    public function updateTodoValue($todoId)
    {
        Todo::where('id',$todoId)->update(
            ['value'=> $this->oldTodoValue]
        );
        $this->updateTodoId = '';
        $this->oldTodoValue = '';
        session()->flash('message', 'Todo successfully Updated.');
    }
    public function setUpdateTodoValue($todoId,$oldValue)
    {
        $this->updateTodoId = $todoId;
        $this->oldTodoValue = $oldValue;
    }
}
