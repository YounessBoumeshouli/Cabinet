<?php
ob_start();

?>
<div class="space-y-8">
    <div class="text-center py-12 bg-gradient-to-r from-green-600 to-blue-600 rounded-lg shadow-lg mb-12">
        <h1 class="text-4xl font-bold text-white mb-4">Welcome to Our Medicine Portal</h1>
        <p class="text-lg text-gray-100 mb-8">Your health, our priority. Discover our services.</p>
        <form class="max-w-2xl mx-auto flex gap-4 px-4">
            <input 
                type="text" 
                placeholder="Search for medical services..." 
                class="flex-grow p-3 rounded-lg border-2 border-transparent focus:border-green-300 focus:ring-2 focus:ring-green-200 focus:outline-none transition-all duration-300"
            >
            <button type="submit" class="px-6 py-3 bg-white text-green-600 font-semibold rounded-lg hover:bg-gray-100 transition duration-300 shadow-md">
                Search
            </button>
        </form>
    </div>

    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Our Services</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="service-card bg-white rounded-lg shadow-md hover:shadow-lg transition duration-300 p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-3">General Consultation</h3>
                <p class="text-gray-600 mb-4">Get expert medical advice and treatment plans tailored to your needs.</p>
            </div>
            <div class="service-card bg-white rounded-lg shadow-md hover:shadow-lg transition duration-300 p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Emergency Services</h3>
                <p class="text-gray-600 mb-4">Immediate medical attention for urgent health issues.</p>
            </div>
            <div class="service-card bg-white rounded-lg shadow-md hover:shadow-lg transition duration-300 p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Health Checkups</h3>
                <p class="text-gray-600 mb-4">Regular checkups to monitor your health and prevent diseases.</p>
            </div>
        </div>
    </div>

    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Testimonials</h2>
        <div class="bg-white rounded-lg shadow-md p-6">
            <p class="text-gray-600 mb-4">"The best medical service I've ever experienced! Highly recommend." - John Doe</p>
            <p class="text-gray-600 mb-4">"Professional and caring staff. I felt well taken care of." - Jane Smith</p>
        </div>
    </div>

    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Contact Us</h2>
        <form class="bg-white rounded-lg shadow-md p-6">
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Name:</label>
                <input type="text" id="name" class="border rounded-lg w-full p-3" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email:</label>
                <input type="email" id="email" class="border rounded-lg w-full p-3" required>
            </div>
            <div class="mb-4">
                <label for="message" class="block text-gray-700">Message:</label>
                <textarea id="message" class="border rounded-lg w-full p-3" required></textarea>
            </div>
            <button type="submit" class="bg-green-600 text-white rounded-lg px-4 py-2">Send Message</button>
        </form>
    </div>
</div>
<?php
$content = ob_get_clean();
require_once("layout.php");
?>