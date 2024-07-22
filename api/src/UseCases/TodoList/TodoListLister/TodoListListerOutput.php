<?php

namespace Src\UseCases\TodoList\TodoListLister;

class TodoListListerOutput
{
    public function __construct(
        public array $todoLists
    )
    {

    }
}
