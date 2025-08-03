<footer class="bg-[#234C4C] py-8 px-4 md:px-8">
    <div class="container mx-auto max-w-6xl">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <!-- Contact section with icons -->
            <div class="mb-6 md:mb-0 text-center md:text-left w-full md:w-auto">
                <h3 class="text-xl font-bold mb-4 text-[#FFD18F] lato-regular">{{ __('navigation.contact_us') }}</h3>
                <div class="flex flex-col space-y-3">
                    <a href="tel:+6281234567890" class="text-white hover:text-gray-900 transition flex items-center justify-center md:justify-start lato-light">
                        <i class="fas fa-phone-alt mr-2 text-lg text-[#FFD18F]"></i>
                        +62 815-4745-6202
                    </a>
                    <a href="mailto:sayfood.web@gmail.com" class="text-white hover:text-gray-900 transition flex items-center justify-center md:justify-start lato-light">
                        <i class="fas fa-envelope mr-2 text-lg text-[#FFD18F]"></i>
                        sayfood.web@gmail.com
                    </a>
                </div>
            </div>
            
            <!-- Logo section - centered -->
            <div class="mb-6 md:mb-0 order-first md:order-none w-full md:w-auto">
                <img src="{{ asset('assets/WEB_LOGO_Footer.png') }}" class="w-75 h-auto img-fluid ms-8">
            </div>
            
            <!-- Social media icons -->
            <div class="flex justify-center space-x-4 mb-6 md:mb-0 w-full md:w-auto">
                <a href="https://www.instagram.com/pptibca.17/" class="text-[#FFD18F] hover:text-gray-900 transition text-2xl">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://web.facebook.com/sayfood.sayfood" class="text-[#FFD18F] hover:text-gray-900 transition text-2xl">
                    <i class="fab fa-facebook"></i>
                </a>
                <a href="https://api.whatsapp.com/send/?phone=6281547456202&text&type=phone_number&app_absent=0" class="text-[#FFD18F] hover:text-gray-900 transition text-2xl">
                    <i class="fab fa-whatsapp"></i>
                </a>
            </div>
        </div>
        
        <!-- Copyright - perfectly centered with logo -->
        <div class="mt-2 pt-6 flex justify-center">
            <p class="text-white text-center lato-light"><span style="color: #FFD18F;">©2025</span>SAYFOOD</p >
        </div>
    </div>
</footer>

