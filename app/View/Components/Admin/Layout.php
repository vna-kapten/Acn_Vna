<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Layout extends Component
{
    public function __construct(
        public string $title = 'Admin Panel'
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.admin.layout');
    }
}
