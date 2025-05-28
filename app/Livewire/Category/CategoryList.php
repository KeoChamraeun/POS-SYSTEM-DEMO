<?php 

namespace App\Livewire\Category;

use Livewire\Component;
use App\Models\Category;

class CategoryList extends Component
{
    public $name;
    public $status;
    public $selectedStatus = '';

    protected $rules = [
        'name' => 'required|string|max:255|unique:categories,name',
        'status' => 'required|in:active,inactive',
    ];

    public function createCategory()
    {
        $this->validate();

        Category::create([
            'name' => $this->name,
            'status' => $this->status,
        ]);

        $this->reset(['name', 'status']);

        session()->flash('success', 'Category created successfully.');
        $this->dispatch('categoryCreated');
        return redirect()->route('category.index');
    }

    public function render()
    {
        $categories = Category::when($this->selectedStatus, function ($query) {
            return $query->where('status', $this->selectedStatus);
        })->get();

        return view('livewire.category.category-list', compact('categories'));
    }
}