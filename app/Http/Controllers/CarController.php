<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function index(Request $request)
    {
        //Tìm kiếm xe
        $search = $request -> input('search');
        $query = Car::query();

        if($search) {
            $query -> where('name', 'like', "%{$search}%")
                    -> orWhere('brand', 'like', "%{$search}%");
        }

        //Phân trang (5/1t)
        $cars = $query -> orderBy('id', 'desc') -> paginate(5);
        $cars -> appends(['search' => $search]);

        return view('cars.index', compact('cars', 'search'));
    }

    public function create() {
        return view('cars.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'year' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'price' => 'required|numeric|min:0',
            'note' => 'nullable|string',
        ]);

        // Xử lý upload ảnh nếu có
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('cars', 'public');
            $validated['image'] = $path;
        }

        Car::create($validated);

        return redirect()->route('cars.index')->with('success', 'Đã thêm thành công một mẫu xe mới!');
    }

    public function show($id)
    {
        $car = Car::findOrFail($id);
        return view('cars.show', compact('car'));
    }

    public function edit($id)
    {
        $car = Car::findOrFail($id);
        return view('cars.edit', compact('car'));
    }

    public function update(Request $request, $id)
    {
        $car = Car::findOrFail($id);

        $validated = $request->validate([
            'image' => 'nullable|image',
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'year' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'price' => 'required|numeric|min:0',
            'note' => 'nullable|string',
        ]);

        // Nếu có upload ảnh mới, xóa ảnh cũ rồi lưu ảnh mới
        if ($request->hasFile('image')) {
            if ($car->image && Storage::disk('public')->exists($car->image)) {
                Storage::disk('public')->delete($car->image);
            }
            $path = $request->file('image')->store('cars', 'public');
            $validated['image'] = $path;
        }

        $car->update($validated);

        return redirect()->route('cars.index')->with('success', 'Cập nhật lại thông tin xe thành công!');
    }

    public function destroy($id)
    {
        $car = Car::findOrFail($id);

        // Xóa ảnh khi xoá xe
        if ($car->image && Storage::disk('public')->exists($car->image)) {
            Storage::disk('public')->delete($car->image);
        }

        $car->delete();

        return redirect()->route('cars.index')->with('success', 'Mẫu xe đã được xóa thành công');
    }
}
