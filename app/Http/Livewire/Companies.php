<?php

namespace App\Http\Livewire;

use App\Models\Company;
use Livewire\Component;
use Livewire\WithPagination;

class Companies extends Component
{
    use WithPagination;

    public $name, $email, $logo, $website;
    public $search = null;

    protected $paginationTheme = 'bootstrap';

    // Validation rules
    protected function rules()
    {
        return [
            'name' => 'required|string|min:6|unique:companies,name,' . $this->company_id,
            'email' => 'required|email|unique:companies,email,' . $this->company_id,
            'logo' => 'nullable|string',
            'website' => 'nullable|url',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }


    // Add new company
    public function saveCompany()
    {
        $validatedData = $this->validate();
        Company::create($validatedData);

        session()->flash('message', 'Company Added Successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }


    // Catching data for editing Company
    public function editCompany(int $company_id)
    {
        $company = Company::find($company_id);
        if($company){

            $this->company_id = $company->id;
            $this->name = $company->name;
            $this->email = $company->email;
            $this->logo = $company->logo;
            $this->website = $company->website;
        }else{
            return redirect()->to('/companies');
        }
    }

    // Update Company
    public function updateCompany()
    {
        $validatedData = $this->validate();

        Company::where('id',$this->company_id)->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'logo' => $validatedData['logo'],
            'website' => $validatedData['website']
        ]);

        session()->flash('message','Company Updated Successfully');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }


    // Catching data for deleting Company
    public function deleteCompany(int $company_id)
    {
        $this->company_id = $company_id;
    }

    // Delete Company
    public function destroyCompany()
    {
        Company::find($this->company_id)->delete();
        session()->flash('message', 'Company Deleted Successfully');
        $this->dispatchBrowserEvent('close-modal');
    }




    // Modal Close 
    public function closeModal()
    {
        $this->resetInput();
    }

    // Reset Input
    public function resetInput()
    {
        $this->name = null;
        $this->email = null;
        $this->logo = null;
        $this->website = null;
    }


    public function render()
    {
        $companies = Company::where('name', 'like', '%'.$this->search.'%')->orderBy('id','DESC')->paginate(5);
        return view('livewire.companies', [
            'companies' => $companies
        ]);
    }
}
