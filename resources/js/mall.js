document.addEventListener('DOMContentLoaded', function() {
    const mallDropdown = document.getElementById('mallDropdown');
    const mallButton = document.getElementById('mallButton');
    const mallOptions = document.querySelectorAll('.mall-option');
    const selectedMallText = document.getElementById('selectedMall');
    const productsContainer = document.querySelector('.products-container');
    const products = document.querySelectorAll('.product-card');

    // Toggle dropdown
    mallButton.addEventListener('click', function() {
        mallDropdown.classList.toggle('hidden');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        if (!mallButton.contains(event.target) && !mallDropdown.contains(event.target)) {
            mallDropdown.classList.add('hidden');
        }
    });

    // Handle mall selection
    mallOptions.forEach(option => {
        option.addEventListener('click', function(e) {
            e.preventDefault();
            const selectedMall = this.getAttribute('data-mall');
            selectedMallText.textContent = selectedMall;
            mallDropdown.classList.add('hidden');

            // Filter products
            products.forEach(product => {
                const productMall = product.getAttribute('data-mall');
                if (selectedMall === 'All Malls' || productMall === selectedMall) {
                    product.style.display = '';
                } else {
                    product.style.display = 'none';
                }
            });
        });
    });
}); 