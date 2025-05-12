@props(['malls'])

<div class="relative inline-block text-left">
    <button type="button" id="mall-dropdown-button" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500" aria-expanded="false">
        <span id="selected-mall-text">{{ request('mall') ? $malls->firstWhere('id', request('mall'))->name : 'All Malls' }}</span>
        <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
    </button>

    <div id="mall-dropdown-menu" class="hidden origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-10">
        <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="mall-dropdown-button">
            <button type="button" class="mall-option block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-gray-900" role="menuitem" data-mall="all">
                All Malls
            </button>
            @foreach ($malls as $mall)
                <button type="button" class="mall-option block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-gray-900" role="menuitem" data-mall="{{ $mall->id }}">
                    {{ $mall->name }}
                </button>
            @endforeach
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownButton = document.getElementById('mall-dropdown-button');
        const dropdownMenu = document.getElementById('mall-dropdown-menu');
        const mallOptions = document.querySelectorAll('.mall-option');
        let isDropdownOpen = false;

        // Toggle dropdown
        dropdownButton.addEventListener('click', function(e) {
            e.stopPropagation();
            isDropdownOpen = !isDropdownOpen;
            dropdownMenu.classList.toggle('hidden');
            dropdownButton.setAttribute('aria-expanded', isDropdownOpen);
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (isDropdownOpen && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
                dropdownButton.setAttribute('aria-expanded', 'false');
                isDropdownOpen = false;
            }
        });

        // Handle mall selection
        mallOptions.forEach(option => {
            option.addEventListener('click', function() {
                const selectedMall = this.getAttribute('data-mall');
                const buttonText = this.textContent.trim();
                
                // Update dropdown button text
                document.getElementById('selected-mall-text').textContent = buttonText;
                
                // Filter products
                const productCards = document.querySelectorAll('.product-card');
                productCards.forEach(card => {
                    if (selectedMall === 'all' || card.getAttribute('data-mall') === selectedMall) {
                        card.classList.remove('hidden');
                        card.classList.add('animate__animated', 'animate__fadeIn');
                    } else {
                        card.classList.add('hidden');
                        card.classList.remove('animate__animated', 'animate__fadeIn');
                    }
                });

                // Close dropdown
                dropdownMenu.classList.add('hidden');
                dropdownButton.setAttribute('aria-expanded', 'false');
                isDropdownOpen = false;

                // Update URL
                const url = new URL(window.location);
                if (selectedMall === 'all') {
                    url.searchParams.delete('mall');
                } else {
                    url.searchParams.set('mall', selectedMall);
                }
                window.history.pushState({}, '', url);
            });
        });

        // Initialize filter from URL if present
        const urlParams = new URLSearchParams(window.location.search);
        const initialMall = urlParams.get('mall');
        if (initialMall) {
            const option = document.querySelector(`[data-mall="${initialMall}"]`);
            if (option) {
                option.click();
            }
        }
    });
</script>
@endpush 