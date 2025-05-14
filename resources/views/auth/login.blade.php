@extends('layouts.app')

<style>
/* Consistent Gaming Theme CSS */
:root {
  --primary: #6c5ce7;
  --secondary: #a29bfe;
  --accent: #fd79a8;
  --dark: #2d3436;
  --light: #f5f6fa;
  --success: #00b894;
  --danger: #d63031;
  --warning: #fdcb6e;
}

body {
  font-family: 'Poppins', sans-serif;
  background-color: #1a1a2e;
  color: var(--light);
  line-height: 1.6;
  background-image: 
    radial-gradient(circle at 10% 20%, rgba(108, 92, 231, 0.1) 0%, transparent 20%),
    radial-gradient(circle at 90% 80%, rgba(253, 121, 168, 0.1) 0%, transparent 20%);
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  margin: 0;
}

.container {
  width: 100%;
  max-width: 500px;
  padding: 20px;
}

/* Form Box */
.form-box {
  background: rgba(45, 52, 54, 0.9);
  border-radius: 16px;
  padding: 40px;
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.1);
  position: relative;
  overflow: hidden;
  animation: fadeIn 0.5s ease-out;
}

.form-box::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, var(--primary), var(--accent));
}

/* Title */
h2 {
  color: white;
  text-align: center;
  margin-bottom: 30px;
  font-size: 2.2rem;
  background: linear-gradient(90deg, #fff, var(--secondary));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  position: relative;
}

h2::after {
  content: "";
  position: absolute;
  bottom: -10px;
  left: 50%;
  transform: translateX(-50%);
  width: 80px;
  height: 3px;
  background: linear-gradient(90deg, var(--primary), var(--accent));
}

/* Form Elements */
form {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

input[type="text"],
input[type="password"] {
  padding: 15px;
  border-radius: 8px;
  border: none;
  background: rgba(255, 255, 255, 0.1);
  color: white;
  font-size: 1rem;
  border: 1px solid rgba(255, 255, 255, 0.2);
  transition: all 0.3s ease;
}

input[type="text"]:focus,
input[type="password"]:focus {
  outline: none;
  border-color: var(--primary);
  box-shadow: 0 0 0 2px rgba(108, 92, 231, 0.3);
}

input::placeholder {
  color: rgba(255, 255, 255, 0.6);
}

/* Button */
button {
  padding: 15px;
  background: linear-gradient(135deg, var(--primary), var(--accent));
  color: white;
  border: none;
  border-radius: 8px;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  text-transform: uppercase;
  letter-spacing: 1px;
  box-shadow: 0 4px 15px rgba(108, 92, 231, 0.4);
  margin-top: 10px;
}

button:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(108, 92, 231, 0.6);
}

button:active {
  transform: translateY(0);
}

/* Alert Messages */
.alert {
  padding: 15px;
  margin-bottom: 20px;
  border-radius: 8px;
  font-weight: 500;
  display: flex;
  align-items: center;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.alert.danger {
  background-color: var(--danger);
  color: white;
}

.alert::before {
  content: "!";
  margin-right: 10px;
  font-weight: bold;
}

/* Switch Link */
.switch-link {
  text-align: center;
  margin-top: 20px;
  color: rgba(255, 255, 255, 0.7);
}

.switch-link a {
  color: var(--secondary);
  text-decoration: none;
  font-weight: 500;
  transition: all 0.3s ease;
}

.switch-link a:hover {
  color: var(--accent);
  text-decoration: underline;
}

/* Animations */
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Responsive Design */
@media (max-width: 600px) {
  .container {
    padding: 15px;
  }
  
  .form-box {
    padding: 30px 20px;
  }
  
  h2 {
    font-size: 1.8rem;
  }
}
</style>

@section('content')
<div class="container">
    <div class="form-box">
        <h2>Login</h2>

        @if(session('error'))
            <div class="alert danger">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ url('/login') }}">
            @csrf
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>

        <p class="switch-link">Belum punya akun? <a href="{{ url('/register') }}">Daftar di sini</a></p>
    </div>
</div>
@endsection
