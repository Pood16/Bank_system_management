<?php require_once __DIR__ . '/../components/head.php'; ?> 
<?php require_once __DIR__ . '/../components/header.php'; ?> 
<main class="px-1.5  text-gray-300">
  <div class="container mt-20 mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-gray-700 rounded-lg shadow-md">
      <!-- Header Section -->
      <div class="p-6 border-b border-gray-600 flex justify-between items-center">
        <h1 class="text-2xl font-semibold text-gray-200">Profile Information</h1>
        <!-- Edit Button -->
        <div class="pt-2">
              <button @click="openModal" id="editProfileBtn" class="px-6 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 transition-colors"> Edit Profile </button>
        </div>
      </div>
      <!-- Profile Content -->
      <div class="p-6">
        <div class="flex flex-col md:flex-row items-start space-y-4 md:space-y-0 md:space-x-6">
          <!-- Profile Picture Section -->
          <div class="flex flex-col items-center space-y-3">
            <div class="w-48 h-48 rounded-full overflow-hidden bg-gray-200">
              <img src="<?=$user['profile_pic']?>" alt="Profile Picture" class="w-full h-full object-cover" />
            </div>
            <button class="hidden px-4 py-2 text-sm text-blue-600 border border-blue-600 rounded-md hover:bg-blue-50 transition-colors"> Change Photo </button>
          </div>
          <!-- Profile Details Section -->
          <div class="flex-1 space-y-6">
            <!-- Personal Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">Full Name</label>
                <p class="text-gray-200 font-medium"><?=$user['name']?></p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">Email Address</label>
                <p class="text-gray-200 font-medium"><?=$user['email']?></p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-400 mb-1">Address</label>
                <p class="text-gray-200 font-medium"><?=$user['user_addres']?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- update form -->
  <div x-show="isModalOpen" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
    <div x-show="isModalOpen" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 transform translate-y-1/2" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0 transform translate-y-1/2" @click.away="closeModal" @keydown.escape="closeModal" class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl" role="dialog" id="modal">
      <header class="flex justify-end">
        <button class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover:text-gray-700" aria-label="close" @click="closeModal">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">
            <path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>
          </svg>
        </button>
      </header>
      <div class="mt-4 mb-6">
        <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300"> Update your informations </p>
        <form class="mt-4" action="/user/profile" method="POST">
          <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-400"> Name </label>
            <input type="text" id="name" name="name" value="<?=$user['name']?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white py-2 px-3">
            <span class="text-red-500"><?//=$update_errors['name']?></span>
          </div>
          <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-400"> Email </label>
            <input type="email" id="email" name="email" value="<?=$user['email']?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white py-2 px-3">
            <span class="text-red-500"><?//=$update_errors['email']?></span>
        </div>
          <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-400"> new Password </label>
            <input type="password" id="password" name="password" value="<?=$user['password']?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white py-2 px-3">
            <span class="text-red-500"><?//=$update_errors['password']?></span>
        </div>
          <div class="mb-4">
            <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-400"> Address </label>
            <input type="text" id="address" name="address" value="<?=$user['user_addres']?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white py-2 px-3">
            <span class="text-red-500"><?//=$update_errors['address']?></span>
        </div>
          <div class="mb-4">
            <label for="profile" class="block text-sm font-medium text-gray-700 dark:text-gray-400"> Profile picture </label>
            <input type="file" id="profile" name="profile" value="<?//=$user['profile_pic']?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring focus:ring-purple-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white py-2 px-3">
        </div>
          <footer class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800">
            <button @click="closeModal" type="button" class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray"> Cancel </button>
            <button type="submit" name="submit" class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"> update </button>
          </footer>
        </form>
      </div>
    </div>
  </div>
</main> 
<?php require_once __DIR__ . '/../components/footer.php'; ?>