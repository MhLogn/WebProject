<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\CheckoutMail;

class CartController extends Controller
{
    // Thêm xe vào giỏ hàng
    public function addToCart($carId)
    {
        $user = Auth::user();

        $existingItem = $user->cart()
            ->where('car_id', $carId)
            ->where('status', 'active')
            ->first();

        if ($existingItem) {
            $existingItem->increment('quantity');
        } else {
            $user->cart()->create([
                'car_id' => $carId,
                'quantity' => 1,
                'status' => 'active',
            ]);
        }

        return redirect()->back()->with('success', 'Đã thêm mẫu xe cần tư vấn!');
    }

    // Hiển thị giỏ hàng
    public function index()
    {
        $user = Auth::user();
        $cartItems = $user->cart()
            ->where('status', 'active')
            ->with('car')
            ->get();

        return view('cart.index', compact('cartItems'));
    }

    // Cập nhật số lượng
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = Cart::findOrFail($id);

        if ($cartItem->user_id !== Auth::id() || $cartItem->status !== 'active') {
            abort(403);
        }

        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return redirect()->route('cart.index')->with('success', 'Cập nhật số lượng thành công!');
    }

    // Xóa khỏi giỏ hàng
    public function removeFromCart($id)
    {
        $cartItem = Cart::findOrFail($id);

        if ($cartItem->user_id !== Auth::id() || $cartItem->status !== 'active') {
            abort(403);
        }

        $cartItem->delete();

        return redirect()->back()->with('success', 'Đã xóa khỏi giỏ hàng!');
    }

    // Hiển thị form thanh toán
    public function showCheckoutForm()
    {
        $user = Auth::user();
        $cartItems = $user->cart()
            ->where('status', 'active')
            ->with('car')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        $total = $cartItems->sum(fn($item) => $item->quantity * $item->car->price);

        return view('cart.checkout', compact('cartItems', 'total'));
    }

    // Xử lý gửi yêu cầu tư vấn (checkout)
    public function checkout(Request $request)
    {
        $user = Auth::user();
        $cartItems = $user->cart()
            ->where('status', 'active')
            ->with('car')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'message' => 'nullable|string|max:1000',
        ]);

        $data = [
            'user' => $user,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'message' => $request->message,
            'cartItems' => $cartItems,
            'total' => $cartItems->sum(fn($item) => $item->quantity * $item->car->price),
        ];

        Mail::to('daylaaccclone39@gmail.com')->send(new CheckoutMail($data));

        $user->cart()->delete();
        
        // Cập nhật trạng thái các item thành 'checked_out'
        // foreach ($cartItems as $item) {
        //     $item->status = 'checked_out';
        //     $item->save();
        // }

        return redirect()->route('cart.index')->with('success', 'Yêu cầu tư vấn của bạn đã được gửi. Chúng tôi sẽ liên hệ bạn sớm nhất!');
    }
}

