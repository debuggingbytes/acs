<div class="bg-white rounded-lg shadow-md p-8 w-full mx-auto drop-shadow-lg">
    <h2 class="text-2xl font-bold mb-4 text-center">Contact Us</h2>

    <div wire:loading.block>  {{-- Spinner while loading --}}
        <div class="flex justify-center items-center h-48"> {{-- Center spinner --}}
            <div class="animate-spin rounded-full h-16 w-16 border-t-2 border-b-2 border-blue-500"></div>
        </div>
    </div>

    <div wire:loading.remove>  {{-- Hide form while loading --}}
        @if (!$isSent)  {{-- Show form only if not sent --}}
            <form wire:submit.prevent="sendEmail">  {{-- Use wire:submit.prevent --}}
                <div class="mb-2">
                    <label for="name" class="block text-gray-700 font-medium mb-2">Name</label>
                    <input type="text" id="name" name="name" wire:model.defer="name"  {{-- Use .defer --}}
                           class="border border-gray-300 rounded-md px-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Your Name" required>
                    @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-2">
                    <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                    <input type="email" id="email" name="email" wire:model.defer="email"  {{-- Use .defer --}}
                           class="border border-gray-300 rounded-md px-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Your Email" required>
                    @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-2 hidden">  {{-- Keep phone hidden --}}
                    <label for="phone" class="block text-gray-700 font-medium mb-2">Phone</label>
                    <input type="tel" id="phone" name="phone" wire:model="phone"  {{-- Use .defer --}}
                           class="border border-gray-300 rounded-md px-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Your Phone Number">
                    @error('phone') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="message" class="block text-gray-700 font-medium mb-2">Message</label>
                    <textarea id="message" name="message" rows="4" wire:model.defer="message"  {{-- Use .defer --}}
                              class="border border-gray-300 rounded-md px-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                              placeholder="Your Message" required></textarea>
                    @error('message') <span class="text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="text-center">
                    <button type="submit"  {{-- Add type="submit" --}}
                            class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-md transition duration-300 ease-in-out">
                        Submit
                    </button>
                </div>
            </form>
        @endif
    </div>

    @if ($isSent)  {{-- Show alert if sent --}}
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">Your message has been sent. We'll get back to you shortly.</span>
        </div>
    @endif
</div>