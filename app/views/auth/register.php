<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-image: url('https://images.pexels.com/photos/259200/pexels-photo-259200.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260'); 
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Create Account</h2>
        <span class="text-red-500"></span>
        <form method="post" action="/register" id="registerForm" class="space-y-4">
            <div>
                <label class="block text-gray-700">User Name</label>
                <input type="text" required class="w-full p-2 border rounded">
                <span class="text-red-500"></span>
            </div>
            <div>
                <label class="block text-gray-700">Email</label>
                <input type="email" required class="w-full p-2 border rounded">
                <span class="text-red-500"></span>
            </div>
            <div>
                <label class="block text-gray-700">Password</label>
                <input type="password" required class="w-full p-2 border rounded">
                <span class="text-red-500"></span>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">
                Register
            </button>
        </form>
    </div>
</body>
</html>