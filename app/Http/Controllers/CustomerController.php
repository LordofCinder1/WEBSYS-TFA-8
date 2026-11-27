<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesAvatar;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    use HandlesAvatar;

    public function index()
    {
        $customers = Customer::all();
        return view('customers', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email'     => 'required|email|unique:customers,email',
            'phone'     => 'nullable|string|max:50',
            'avatar'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $this->processAvatar($request->file('avatar'), 'avatars/customers');
        }

        Customer::create($validated);

        return redirect()->route('customers.index')->with('success', 'Customer added successfully.');
    }

    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email'     => 'required|email|unique:customers,email,' . $customer->id,
            'phone'     => 'nullable|string|max:50',
            'avatar'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            $oldAvatar = $customer->avatar;
            $validated['avatar'] = $this->processAvatar($request->file('avatar'), 'avatars/customers');
            $this->deleteAvatar($oldAvatar);
        }

        $customer->update($validated);

        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        $this->deleteAvatar($customer->avatar);

        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }
}
