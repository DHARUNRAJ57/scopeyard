<?php
namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Staff;
use Illuminate\Support\Facades\Storage;

class StaffManagement extends Component
{
    use WithFileUploads;

    public $staffs, $name, $gender, $employment_type, $technologies_known = [], $joining_date, $photo, $staff_id;
    public $isOpen = false;

    public function render()
    {
        $this->staffs = Staff::all();
        return view('livewire.staff-management');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->gender = '';
        $this->employment_type = '';
        $this->technologies_known = [];
        $this->joining_date = '';
        $this->photo = '';
        $this->staff_id = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'gender' => 'required',
            'employment_type' => 'required',
            'technologies_known' => 'required|array',
            'joining_date' => 'required|date',
            'photo' => 'nullable|image|max:1024', // Adjust the validation rules as needed
        ]);

        if ($this->photo) {
            $photoPath = $this->photo->store('photos', 'public');
        } else {
            $photoPath = null;
        }

        Staff::updateOrCreate(['id' => $this->staff_id], [
            'name' => $this->name,
            'gender' => $this->gender,
            'employment_type' => $this->employment_type,
            'technologies_known' => $this->technologies_known,
            'joining_date' => $this->joining_date,
            'photo' => $photoPath,
        ]);

        session()->flash('message', $this->staff_id ? 'Staff Updated Successfully.' : 'Staff Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $staff = Staff::findOrFail($id);
        $this->staff_id = $id;
        $this->name = $staff->name;
        $this->gender = $staff->gender;
        $this->employment_type = $staff->employment_type;
        $this->technologies_known = $staff->technologies_known;
        $this->joining_date = $staff->joining_date;
        $this->photo = $staff->photo;

        $this->openModal();
    }

    public function delete($id)
    {
        $staff = Staff::findOrFail($id);
        if ($staff->photo) {
            Storage::disk('public')->delete($staff->photo);
        }
        $staff->delete();
        session()->flash('message', 'Staff Deleted Successfully.');
    }
}
