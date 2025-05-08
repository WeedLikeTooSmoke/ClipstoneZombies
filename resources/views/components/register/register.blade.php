<div class="container page">
    <div class="login">
        <form method="POST" action="{{ route('auth.register') }}">
            @csrf

            <label><i class="fa-solid fa-user"></i> Plutonium GUID</label><br>
            <input type="number" name="guid" placeholder="Plutonium GUID..."/><br><br><br>

            <label><i class="fa-solid fa-user"></i> Email</label><br>
            <input type="email" name="email" placeholder="Email..."/><br><br><br>

            <label><i class="fa-solid fa-lock"></i> Password</label><br>
            <input type="password" name="password" placeholder="Password..."/><br><br><br>

            <label><i class="fa-solid fa-lock"></i> Password</label><br>
            <input type="password" name="password_confirmation" placeholder="Confirm Password..."/><br><br>

            <button type="submit">Register</button>
        </form>
    </div>
</div>
