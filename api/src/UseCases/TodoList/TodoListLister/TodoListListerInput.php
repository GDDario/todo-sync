<?php

namespace Src\UseCases\TodoList\TodoListLister;

class TodoListListerInput
{
    public function __construct(
        public int $userId
    )
    {

    }
}
