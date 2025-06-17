<h1 align="center"><strong>🚗 Dự Án Website Tư Vấn / Mua Bán Ô Tô</strong></h1>

<h2>👤 Thông Tin Sinh Viên</h2>

- **Họ và tên:** Hà Mạnh Long  
- **Mã sinh viên:** 23010390  
- **Lớp:** K17_CNTT-4  
- **Môn học:** Web nâng cao (TH3)  

---

## 📋 Giới Thiệu Dự Án
Dự án xây dựng một website chuyên về **tư vấn và mua bán ô tô**, kết nối giữa người **mua** và **bán**, mang đến trải nghiệm giao dịch:
- Nhanh chóng  
- Minh bạch  
- Đáng tin cậy  

### ✨ Tính năng hỗ trợ:
- Tìm kiếm xe theo nhu cầu  
- Thêm vào giỏ hàng  
- Gửi yêu cầu tư vấn  
- Đặt lịch dịch vụ  
- Liên hệ với người bán  

---

## 💻 Công Nghệ Sử Dụng
- **PHP** (Laravel Framework)  
- **Laravel Breeze** (Xác thực người dùng)  
- **MySQL** (Aiven Cloud)  
- **Blade Template** (Giao diện)  
- **Tailwind CSS** (Thiết kế responsive)  

---

## 🧠 Sơ Đồ

### 📌 Sơ Đồ Khối
<img src="https://github.com/user-attachments/assets/0dba67d4-02c7-4f6c-932b-96335fab4005" width="700px">

### 📌 Sơ Đồ Chức Năng
<img src="https://github.com/user-attachments/assets/8f3117d6-8729-4a63-99ad-458faf23adcc" width="700px">

### 📌 Sơ Đồ Thuật Toán
- **CRUD Car**  
    <img src="https://github.com/user-attachments/assets/4543f453-1423-4fa5-9354-36ddb5a72dd8" width="700px">
- **CRUD Cart**  
    <img src="https://github.com/user-attachments/assets/40ffa733-1212-48ec-b75a-dc0d594d563e" width="700px">
- **IsAdmin**  
    <img src="https://github.com/user-attachments/assets/4236bd4a-a5b8-4be9-935f-28e965591e55" width="700px">
- **User ➝ SelectCar ➝ addToCart**  
    <img src="https://github.com/user-attachments/assets/173472f7-ff66-4c3f-9bcc-2ab9c235fed1" width="700px">
- **Contact**  
    <img src="https://github.com/user-attachments/assets/2abdafe4-4d44-4977-a308-2e4e80a21a40" width="700px">
- **Schedule**  
    <img src="https://github.com/user-attachments/assets/96421d79-b637-4267-ad5a-5a8f1a964ce5" width="700px">

---

## 🧩 Code Chính Minh Họa

### 📦 Model

**User**

```php
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function cart()
    {
    return $this->hasMany(Cart::class);
    }
}

```
**Car**

```php

class Car extends Model
{
    protected $fillable = [
        'image',
        'name',
        'brand',
        'year',
        'price',
        'note',
    ];
}

```
**Cart**

```php

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'car_id', 'quantity', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}

```
**CartItem**  
```php

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ['cart_id', 'car_id', 'quantity'];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}

```

### 🧠 Controller
**ProfileController**

```php

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

```

**CarController**

```php

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

```

**CartController**

```php
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

        return redirect()->back()->with('success', 'Đã thêm xe vào giỏ hàng!');
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
```

**ContactController**

```php

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function send(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $contactData = $request->only(['name', 'email', 'subject', 'message']);

        Mail::to('daylaaccclone39@gmail.com')->send(new ContactMail($contactData));

        return redirect()->back()->with('success', 'Cảm ơn bạn đã liên hệ với chúng tôi, chúng tôi sẽ phản hồi lại bạn sớm!');
    }
}

```

**ScheduleController**

```php

class ScheduleController extends Controller
{
    // Hiển thị form đặt lịch
    public function showForm()
    {
        return view('schedule.form');
    }

    // Xử lý lưu thông tin đặt lịch
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email',
            'service' => 'required|string',
            'date' => 'required|date|after_or_equal:today',
            'note' => 'nullable|string',
        ]);

        // Gửi mail cho admin
        Mail::to('daylaaccclone39@gmail.com')->send(new ScheduleNotification($validated));

        // Schedule::create($validated);

        return redirect()->route('schedule.form')->with('success', 'Đặt lịch thành công! Chúng tôi sẽ phản hồi bạn sớm.');
    }
}

```

---

### 📄 Blade Template (View)

![view](https://github.com/user-attachments/assets/05519eca-8279-4be5-8767-265885d7beb9)

---

### 🌐 Routes
```php

// Trang welcome (mặc định)
Route::get('/', fn () => view('welcome'))->name('welcome');

// Dashboard redirect (cần đăng nhập + xác thực email)
Route::get('/dashboard', fn () => redirect()->route('home.homepage'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Trang chính (Home)
Route::get('/home', fn () => view('home.homepage'))->name('home.homepage');

// Trang liên hệ (Contact)
Route::get('/contact', fn () => view('contact.index'))->name('contact');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

// =======================
// Quản lý Giỏ hàng (Cart)
// =======================
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{carId}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{cartId}', [CartController::class, 'removeFromCart'])->name('cart.remove');

    // Hiển thị form checkout (gửi yêu cầu tư vấn)

    Route::get('/cart/checkout', [CartController::class, 'showCheckoutForm'])->name('cart.checkout.form');

    // Xử lý submit form checkout gửi mail
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout.submit');
});

// =======================
// Quản lý Xe (Cars)
// =======================

// Các route cần phân quyền Admin
Route::middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('/cars/create', [CarController::class, 'create'])->name('cars.create');
    Route::post('/cars', [CarController::class, 'store'])->name('cars.store');
    Route::get('/cars/{car}/edit', [CarController::class, 'edit'])->name('cars.edit');
    Route::put('/cars/{car}', [CarController::class, 'update'])->name('cars.update');
    Route::delete('/cars/{car}', [CarController::class, 'destroy'])->name('cars.destroy');
});

// Các route ai cũng xem được (Danh sách + Chi tiết)
Route::resource('cars', CarController::class)->only(['index', 'show']);

// Đặt lịch
Route::get('/schedule', [ScheduleController::class, 'showForm'])->name('schedule.form');
Route::post('/schedule', [ScheduleController::class, 'store'])->name('schedule.store');

// =======================
// Quản lý Profile Người dùng
// =======================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =======================
// Auth routes (Laravel Breeze / Fortify / Jetstream)
// =======================
require __DIR__.'/auth.php';

```

---

## 🔒 Bảo Mật
**CSRF & XSS Token bảo vệ form** (ví dụ: `car.index`)
```php

    @if(Auth::user() && Auth::user()->is_admin)
        <a href="{{ route('cars.edit', $car->id) }}" class="btn-edit">Sửa</a>
        <form action="{{ route('cars.destroy', $car->id) }}" method="POST"
            class="inline-block"
            onsubmit="return confirm('Bạn có chắc muốn xóa xe này?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-delete">Xóa</button>
        </form>
    @endif

    <form action="{{ route('cart.add', $car->id) }}" method="POST"
        class="inline-block">
        @csrf
        <button type="submit" class="btn-cart">Mua Bán</button>
    </form>

```

**Query Builder chống SQL Injection** (ví dụ: `CartController`)  
```php

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

        return redirect()->back()->with('success', 'Đã thêm xe vào giỏ hàng!');
    }

```

**Middleware phân quyền Admin**  
```php

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || !auth()->user()->is_admin) {
            abort(403, 'Bạn không có quyền truy cập,');
        }
        return $next($request);
    }
}

// Các route cần phân quyền Admin
Route::middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('/cars/create', [CarController::class, 'create'])->name('cars.create');
    Route::post('/cars', [CarController::class, 'store'])->name('cars.store');
    Route::get('/cars/{car}/edit', [CarController::class, 'edit'])->name('cars.edit');
    Route::put('/cars/{car}', [CarController::class, 'update'])->name('cars.update');
    Route::delete('/cars/{car}', [CarController::class, 'destroy'])->name('cars.destroy');
});

// Các route ai cũng xem được (Danh sách + Chi tiết)
Route::resource('cars', CarController::class)->only(['index', 'show']);

```

---

## 🖼️ Giao Diện Website

### 🔐 Trang Xác Thực
- **Đăng nhập**  
    <img src="https://github.com/user-attachments/assets/f480b218-c588-4e6e-9710-9d5bccd4c2ce" width="800px">
- **Đăng ký**  
    <img src="https://github.com/user-attachments/assets/9ab20a38-fef6-48f3-b783-96217ef28da4" width="800px">
- **Quên mật khẩu**  
    <img src="https://github.com/user-attachments/assets/8938c6ed-3eb2-4861-9e27-6cd3cfaa28da" width="800px">

### 🏠 Trang Chủ  
<img src="https://github.com/user-attachments/assets/5d1af8c4-aee5-4c6c-922c-41e6535d04e0" width="800px">  
<img src="https://github.com/user-attachments/assets/d4dc6a12-af96-4f04-9a24-97370a6df363" width="800px">

---

### 🚘 Trang Sản Phẩm
- **Danh sách xe**  
    <img src="https://github.com/user-attachments/assets/fb9b0b13-9311-4411-9e2c-c85c321bacd1" width="800px">
- **Chi tiết xe**  
    <img src="https://github.com/user-attachments/assets/e33a7006-d4b0-491b-813d-634fc00c0c90" width="800px">
- **Thêm xe (Admin)**  
    <img src="https://github.com/user-attachments/assets/ec95a06f-aaf0-427a-af2e-1c85eb2aab82" width="800px">
- **Sửa / Xoá (Admin)**  
    <img src="https://github.com/user-attachments/assets/6faf5303-c149-484a-accb-f787257b8cb2" width="800px">

---

### 🛠️ Tư Vấn - Dịch Vụ
- **Giỏ hàng**  
    <img src="https://github.com/user-attachments/assets/515667a0-065a-4b92-95bc-251165659512" width="800px">
- **Gửi tư vấn**  
    <img src="https://github.com/user-attachments/assets/f22e1416-c813-457d-bb7a-09d2a1ddcc17" width="800px">
- **Đặt lịch dịch vụ**  
    <img src="https://github.com/user-attachments/assets/499b1b27-8c0e-4f2a-a001-78f95b684023" width="800px">
- **Liên hệ**  
    <img src="https://github.com/user-attachments/assets/6ad952d6-04eb-4a38-9d13-7d1a4aef22cb" width="800px">

---

### ✉️ Gửi Gmail Tự Động
- **Đặt lịch:**  
    <img src="https://github.com/user-attachments/assets/83fe3df9-2ce2-4ccc-b908-01877de1b19c" width="800px">
- **Tư vấn:**  
    <img src="https://github.com/user-attachments/assets/6bc556b5-6dd3-4806-bc48-0c6d1e48822e" width="800px">
- **Liên hệ:**  
    <img src="https://github.com/user-attachments/assets/fe6cf771-f46a-4d64-8e2a-01f7084e399e" width="800px">

---

## 🔗 Liên Kết
- 🔗 **GitHub:** [https://github.com/MhLogn](https://github.com/MhLogn)  
- ▶️ **YouTube Demo:** [https://www.youtube.com/@longhamanh5118](https://www.youtube.com/@longhamanh5118)  
- 🌐 **Public Website:** *(đang cập nhật)*

---

## 📜 License
Laravel framework được phát hành theo giấy phép [MIT License](https://opensource.org/licenses/MIT).
