<?php include "conn.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body>
    <footer class="bg-indigo-950/80 border-t border-white/10 text-indigo-200 mt-10">
        <div class="max-w-6xl mx-auto px-4 py-10 grid grid-cols-1 sm:grid-cols-3 gap-8">
            <!-- Info -->
            <div>
                <h4 class="text-white font-semibold text-base mb-4">Information</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#About_Us" class="hover:text-white transition">About Us</a></li>
                    <li><a href="#Message_Us" class="hover:text-white transition">Message Us</a></li>
                </ul>
            </div>
            <!-- Social -->
            <div>
                <h4 class="text-white font-semibold text-base mb-4">Follow Us</h4>
                <div class="flex flex-wrap gap-3">
                    <a href="https://www.facebook.com/share/vQejT1KtYj9VgqYi/" target="_blank"
                        class="bg-indigo-800/50 hover:bg-indigo-700 p-2 rounded-lg transition">
                        <img src="img/facebook.png" alt="Facebook" class="h-6 w-6">
                    </a>
                    <a href="https://www.instagram.com/ak_edit__08/" target="_blank"
                        class="bg-indigo-800/50 hover:bg-indigo-700 p-2 rounded-lg transition">
                        <img src="img/instagram.png" alt="Instagram" class="h-6 w-6">
                    </a>
                    <a href="https://twitter.com/" target="_blank"
                        class="bg-indigo-800/50 hover:bg-indigo-700 p-2 rounded-lg transition">
                        <img src="img/twitter.png" alt="Twitter" class="h-6 w-6">
                    </a>
                    <a href="https://whatsapp.com/" target="_blank"
                        class="bg-indigo-800/50 hover:bg-indigo-700 p-2 rounded-lg transition">
                        <img src="img/whatsapp.png" alt="WhatsApp" class="h-6 w-6">
                    </a>
                    <a href="https://www.linkedin.com/in/ashish-kalsara-4b3217227/" target="_blank"
                        class="bg-indigo-800/50 hover:bg-indigo-700 p-2 rounded-lg transition">
                        <img src="img/linkedin.png" alt="LinkedIn" class="h-6 w-6">
                    </a>
                </div>
            </div>
            <!-- Contact -->
            <div>
                <h4 class="text-white font-semibold text-base mb-4">Contact Us</h4>
                <ul class="space-y-2 text-sm">
                    <li>📧 ashish_25078@ldrp.ac.in</li>
                    <li>📞 +91 9499648505</li>
                    <li>📍 Quiz Master, Amreli, India</li>
                </ul>
            </div>
        </div>
        <div class="border-t border-white/10 py-4 text-center text-xs text-indigo-400">
            Copyright ©<?php echo date("Y"); ?> All rights reserved | Made by <span class="text-indigo-300 font-medium">Ashish Kalsara</span>
        </div>
    </footer>
</body>
</html>