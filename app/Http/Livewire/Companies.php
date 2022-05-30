<?php

namespace App\Http\Livewire;

use App\Models\Company;
use Livewire\Component;
use Livewire\WithPagination;

class Companies extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $companies = Company::paginate(5);

        return view('livewire.companies', [
            'companies' => $companies
        ]);
    }
}
