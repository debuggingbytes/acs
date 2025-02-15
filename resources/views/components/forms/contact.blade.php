<div class="bg-white rounded-lg shadow-md p-8 w-full mx-auto drop-shadow-lg">
  <h2 class="text-2xl font-bold mb-4 text-center">Contact Us</h2>
  <form action="#" method="POST">  {{-- Replace with your form handling --}}
      <div class="mb-2">
          <label for="name" class="block text-gray-700 font-medium mb-2">Name</label>
          <input type="text" id="name" name="name"
                 class="border border-gray-300 rounded-md px-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                 placeholder="Your Name" required>
      </div>
      <div class="mb-2">
          <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
          <input type="email" id="email" name="email"
                 class="border border-gray-300 rounded-md px-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                 placeholder="Your Email" required>
      </div>
      <div class="mb-3">
          <label for="message" class="block text-gray-700 font-medium mb-2">Message</label>
          <textarea id="message" name="message" rows="4"
                    class="border border-gray-300 rounded-md px-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Your Message" required></textarea>
      </div>
      <div class="text-center">  {{-- Center the button --}}
          <button type="submit"
                  class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-md transition duration-300 ease-in-out">
              Submit
          </button>
      </div>
  </form>
</div>