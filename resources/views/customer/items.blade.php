{{-- <div class="customer-items-page-refined">

    <!-- Header -->
    <div class="page-header text-center mb-5">
        <h3 class="page-title">Items We Take Care Of</h3>
        <p class="page-subtitle">
            Select from the list of clothes we professionally wash and iron
        </p>
    </div>

    <!-- Search Bar -->
    <div class="search-section mb-5">
        <div class="search-container">
            <i class="fa fa-search search-icon"></i>
            <input type="text" class="search-input" placeholder="Search items e.g. Shirt, Bedsheet…" id="searchInput">
        </div>
    </div>

    <!-- Categories Grid -->
    @foreach ($categories as $category)
        <div class="category-block mb-5">
            <!-- Category Header -->
            <div class="category-header-wrapper">
                <h5 class="category-title">{{ $category->type }}</h5>
                <span class="category-count">{{ $category->items->where('is_active', 1)->count() }} items</span>
            </div>

            <!-- Items Grid -->
            <div class="items-grid">
                @forelse($category->items->where('is_active', 1) as $item)
                    <div class="item-card-wrapper">
                        <div class="item-card" data-item-id="{{ $item->id }}">
                            <!-- Icon -->
                            <div class="item-icon-wrapper">
                                <i class="{{ $item->icon }} item-icon"></i>
                            </div>

                            <!-- Content -->
                            <div class="item-content">
                                <h6 class="item-title">{{ $item->name }}</h6>
                                <p class="item-description">Cleaned with care & attention</p>

                                <!-- Quick Price Preview -->
                                <div class="price-preview">
                                    <span class="price-tag">Starting from
                                        ₦{{ number_format($item->washing_price, 2) }}</span>
                                </div>
                            </div>

                            <!-- Action Button -->
                            <button class="select-btn"
                                onclick="showItemDetails({{ $item->id }}, '{{ $item->name }}', '{{ $item->icon }}', {{ $item->washing_price }}, {{ $item->ironing_price }}, {{ $item->wash_and_iron_price }})">
                                <span>View Details</span>
                                <i class="fa fa-arrow-right btn-arrow"></i>
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="empty-state">No items available in this category.</p>
                    </div>
                @endforelse
            </div>
        </div>
    @endforeach

</div>

<style>
    .customer-items-page-refined {
        font-family: 'Inter', 'Segoe UI', sans-serif;
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
        background: linear-gradient(to bottom, #f8f9fa 0%, #ffffff 100%);
        min-height: 100vh;
    }

    /* ========== HEADER ========== */
    .page-header {
        padding: 2rem 0 1rem;
    }

    .page-title {
        font-size: 2.25rem;
        font-weight: 700;
        color: #1a1a2e;
        margin-bottom: 0.75rem;
        letter-spacing: -0.5px;
    }

    .page-subtitle {
        font-size: 1.1rem;
        color: #6c757d;
        margin: 0;
    }

    /* ========== SEARCH SECTION ========== */
    .search-section {
        display: flex;
        justify-content: center;
    }

    .search-container {
        position: relative;
        width: 100%;
        max-width: 600px;
    }

    .search-icon {
        position: absolute;
        left: 1.25rem;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
        font-size: 1rem;
        pointer-events: none;
        transition: color 0.3s ease;
    }

    .search-input {
        width: 100%;
        padding: 1rem 1.5rem 1rem 3.25rem;
        border: 2px solid #e0e0e0;
        border-radius: 16px;
        background: #ffffff;
        color: #1a1a2e;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .search-input::placeholder {
        color: #adb5bd;
    }

    .search-input:focus {
        outline: none;
        border-color: #4f46e5;
        box-shadow: 0 4px 16px rgba(79, 70, 229, 0.15);
    }

    .search-input:focus~.search-icon,
    .search-container:hover .search-icon {
        color: #4f46e5;
    }

    /* ========== CATEGORY SECTION ========== */
    .category-block {
        margin-bottom: 3rem;
    }

    .category-header-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #e9ecef;
    }

    .category-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1a1a2e;
        margin: 0;
    }

    .category-count {
        font-size: 0.9rem;
        color: #6c757d;
        background: #f1f3f5;
        padding: 0.375rem 0.875rem;
        border-radius: 50px;
        font-weight: 500;
    }

    /* ========== ITEMS GRID ========== */
    .items-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 1.5rem;
    }

    .item-card-wrapper {
        animation: fadeInUp 0.5s ease forwards;
        opacity: 0;
    }

    .item-card-wrapper:nth-child(1) {
        animation-delay: 0.05s;
    }

    .item-card-wrapper:nth-child(2) {
        animation-delay: 0.1s;
    }

    .item-card-wrapper:nth-child(3) {
        animation-delay: 0.15s;
    }

    .item-card-wrapper:nth-child(4) {
        animation-delay: 0.2s;
    }

    .item-card-wrapper:nth-child(n+5) {
        animation-delay: 0.25s;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ========== ITEM CARD ========== */
    .item-card {
        background: #ffffff;
        border: 1px solid #e9ecef;
        border-radius: 20px;
        padding: 2rem 1.5rem;
        text-align: center;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        height: 100%;
        display: flex;
        flex-direction: column;
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }

    .item-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #4f46e5, #06b6d4);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .item-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
        border-color: #4f46e5;
    }

    .item-card:hover::before {
        transform: scaleX(1);
    }

    /* ========== ICON ========== */
    .item-icon-wrapper {
        width: 72px;
        height: 72px;
        margin: 0 auto 1.25rem;
        background: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);
    }

    .item-card:hover .item-icon-wrapper {
        transform: scale(1.1) rotate(5deg);
        box-shadow: 0 8px 20px rgba(79, 70, 229, 0.35);
    }

    .item-icon {
        font-size: 1.75rem;
        color: #ffffff;
    }

    /* ========== CONTENT ========== */
    .item-content {
        flex: 1;
        margin-bottom: 1.25rem;
    }

    .item-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1a1a2e;
        margin-bottom: 0.5rem;
    }

    .item-description {
        font-size: 0.9rem;
        color: #6c757d;
        margin: 0 0 0.75rem 0;
        line-height: 1.5;
    }

    .price-preview {
        margin-top: 0.75rem;
    }

    .price-tag {
        display: inline-block;
        background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
        color: #0369a1;
        padding: 0.375rem 0.875rem;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    /* ========== BUTTON ========== */
    .select-btn {
        width: 100%;
        padding: 0.75rem 1.25rem;
        background: #f8f9fa;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        color: #4f46e5;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .btn-arrow {
        font-size: 0.85rem;
        transition: transform 0.3s ease;
    }

    .select-btn:hover {
        background: #4f46e5;
        border-color: #4f46e5;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
    }

    .select-btn:hover .btn-arrow {
        transform: translateX(4px);
    }

    /* ========== MODAL STYLES ========== */
    .item-modal {
        border-radius: 24px;
        border: none;
        overflow: hidden;
    }

    .modal-header-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
        width: 100%;
        text-align: center;
    }

    .modal-icon-wrapper {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #4f46e5, #06b6d4);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 24px rgba(79, 70, 229, 0.3);
    }

    .modal-icon-wrapper i {
        font-size: 2rem;
        color: #ffffff;
    }

    .modal-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1a1a2e;
        margin: 0;
    }

    .service-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1a1a2e;
        margin-bottom: 1.25rem;
    }

    .service-card {
        background: #f8f9fa;
        border: 2px solid #e9ecef;
        border-radius: 16px;
        padding: 1.25rem;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
        position: relative;
    }

    .service-card.featured {
        background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
        border-color: #0369a1;
    }

    .popular-badge {
        position: absolute;
        top: -12px;
        right: 1rem;
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: #ffffff;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
    }

    .service-card:hover {
        border-color: #4f46e5;
        transform: translateY(-4px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    .service-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 0.75rem;
    }

    .service-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 1.25rem;
    }

    .wash-icon {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
    }

    .iron-icon {
        background: linear-gradient(135deg, #8b5cf6, #7c3aed);
    }

    .combo-icon {
        background: linear-gradient(135deg, #10b981, #059669);
    }

    .service-info {
        flex: 1;
    }

    .service-name {
        font-size: 1rem;
        font-weight: 700;
        color: #1a1a2e;
        margin: 0 0 0.25rem 0;
    }

    .service-desc {
        font-size: 0.85rem;
        color: #6c757d;
        margin: 0;
    }

    .service-price {
        text-align: right;
    }

    .price-amount {
        display: block;
        font-size: 1.5rem;
        font-weight: 700;
        color: #1a1a2e;
    }

    .price-label {
        font-size: 0.8rem;
        color: #6c757d;
    }

    .info-section {
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid #e9ecef;
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: #6c757d;
        font-size: 0.9rem;
    }

    .info-icon {
        color: #4f46e5;
        font-size: 1rem;
    }

    .btn-select-service {
        width: 100%;
        padding: 1rem;
        background: linear-gradient(135deg, #4f46e5, #06b6d4);
        border: none;
        border-radius: 12px;
        color: #ffffff;
        font-weight: 700;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-select-service:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(79, 70, 229, 0.4);
    }

    /* ========== EMPTY STATE ========== */
    .empty-state {
        text-align: center;
        color: #adb5bd;
        font-size: 0.95rem;
        padding: 2rem;
        background: #f8f9fa;
        border-radius: 12px;
    }

    /* ========== RESPONSIVE ========== */
    @media (max-width: 768px) {
        .customer-items-page-refined {
            padding: 1.5rem 1rem;
        }

        .page-title {
            font-size: 1.75rem;
        }

        .page-subtitle {
            font-size: 1rem;
        }

        .items-grid {
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 1rem;
        }

        .item-card {
            padding: 1.5rem 1rem;
        }

        .item-icon-wrapper {
            width: 60px;
            height: 60px;
        }

        .item-icon {
            font-size: 1.5rem;
        }

        .category-header-wrapper {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }
    }

    @media (max-width: 480px) {
        .items-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>

<script>
    function showItemDetails(itemId, itemName, itemIcon, washingPrice, ironingPrice, washIronPrice) {
        // Update modal content
        document.getElementById('modalItemName').textContent = itemName;
        document.querySelector('#modalIcon i').className = itemIcon;
        document.getElementById('washingPrice').textContent = '₦' + parseFloat(washingPrice).toLocaleString('en-NG', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
        document.getElementById('ironingPrice').textContent = '₦' + parseFloat(ironingPrice).toLocaleString('en-NG', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
        document.getElementById('washIronPrice').textContent = '₦' + parseFloat(washIronPrice).toLocaleString('en-NG', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });

        // Show modal
        const modal = new bootstrap.Modal(document.getElementById('itemDetailsModal'));
        modal.show();
    }

    // Search functionality
    document.getElementById('searchInput')?.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const itemCards = document.querySelectorAll('.item-card-wrapper');

        itemCards.forEach(card => {
            const itemName = card.querySelector('.item-title').textContent.toLowerCase();
            if (itemName.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
</script> --}}

{{-- <div class="customer-items-page-refined">

    <!-- Header -->
    <div class="page-header text-center mb-5">
        <h3 class="page-title">Items We Take Care Of</h3>
        <p class="page-subtitle">
            Select from the list of clothes we professionally wash and iron
        </p>
    </div>

    <!-- Search Bar -->
    <div class="search-section mb-5">
        <div class="search-container">
            <i class="fa fa-search search-icon"></i>
            <input type="text" class="search-input" placeholder="Search items e.g. Shirt, Bedsheet…" id="searchInput">
        </div>
    </div>

    <!-- Categories -->
    @foreach ($categories as $category)
        <div class="category-block mb-5">

            <!-- Category Header -->
            <div class="category-header-wrapper mb-4">
                <h5 class="category-title">{{ $category->type }}</h5>
                <span class="category-count">{{ $category->items->where('is_active', 1)->count() }} items</span>
            </div>

            <!-- Items Grid — Bootstrap row for full responsive control -->
            <div class="row g-3">
                @forelse($category->items->where('is_active', 1) as $item)

                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 item-card-wrapper">
                        <div class="item-card h-100" data-item-id="{{ $item->id }}">

                            <!-- Icon -->
                            <div class="item-icon-wrapper">
                                <i class="{{ $item->icon }} item-icon"></i>
                            </div>

                            <!-- Content -->
                            <div class="item-content">
                                <h6 class="item-title">{{ $item->name }}</h6>
                                <p class="item-description">Cleaned with care & attention</p>
                                <div class="price-preview">
                                    <span class="price-tag">From ₦{{ number_format($item->washing_price, 2) }}</span>
                                </div>
                            </div>

                            <!-- Button -->
                            <button class="select-btn mt-auto"
                                onclick="showItemDetails({{ $item->id }}, '{{ $item->name }}', '{{ $item->icon }}', {{ $item->washing_price }}, {{ $item->ironing_price }}, {{ $item->wash_and_iron_price }})">
                                <span>View Details</span>
                                <i class="fa fa-arrow-right btn-arrow"></i>
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="empty-state">No items available in this category.</p>
                    </div>
                @endforelse
            </div>

        </div>
    @endforeach

</div> --}}

{{-- Item Details Modal --}}
{{-- <div class="modal fade" id="itemDetailsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content item-modal">

            <div class="modal-header border-0 pb-0 pt-4 px-4">
                <div class="modal-header-content">
                    <div class="modal-icon-wrapper" id="modalIcon">
                        <i class="fa fa-shirt"></i>
                    </div>
                    <h5 class="modal-title" id="modalItemName">Item Name</h5>
                </div>
                <button type="button" class="btn-close position-absolute top-0 end-0 m-3"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body px-4 pb-4">

                <p class="service-title mt-4">Available Services</p>

                <!-- Washing -->
                <div class="service-card">
                    <div class="service-header">
                        <div class="service-icon wash-icon">
                            <i class="fa fa-droplet"></i>
                        </div>
                        <div class="service-info">
                            <p class="service-name">Washing</p>
                            <p class="service-desc">Deep clean & fresh rinse</p>
                        </div>
                        <div class="service-price">
                            <span class="price-amount" id="washingPrice">₦0.00</span>
                            <span class="price-label">per piece</span>
                        </div>
                    </div>
                </div>

                <!-- Ironing -->
                <div class="service-card">
                    <div class="service-header">
                        <div class="service-icon iron-icon">
                            <i class="fa fa-fire"></i>
                        </div>
                        <div class="service-info">
                            <p class="service-name">Ironing</p>
                            <p class="service-desc">Crisp, wrinkle-free finish</p>
                        </div>
                        <div class="service-price">
                            <span class="price-amount" id="ironingPrice">₦0.00</span>
                            <span class="price-label">per piece</span>
                        </div>
                    </div>
                </div>

                <!-- Wash & Iron -->
                <div class="service-card featured">
                    <span class="popular-badge">⭐ Popular</span>
                    <div class="service-header">
                        <div class="service-icon combo-icon">
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="service-info">
                            <p class="service-name">Wash & Iron</p>
                            <p class="service-desc">Complete care, best value</p>
                        </div>
                        <div class="service-price">
                            <span class="price-amount" id="washIronPrice">₦0.00</span>
                            <span class="price-label">per piece</span>
                        </div>
                    </div>
                </div>

                <!-- Info -->
                <div class="info-section">
                    <div class="info-item">
                        <i class="fa fa-clock info-icon"></i>
                        <span>Ready within 24–48 hours</span>
                    </div>
                    <div class="info-item">
                        <i class="fa fa-shield-halved info-icon"></i>
                        <span>Handled with care & quality guarantee</span>
                    </div>
                    <div class="info-item">
                        <i class="fa fa-truck info-icon"></i>
                        <span>Pickup & delivery available</span>
                    </div>
                </div>

                <!-- Book Now Button -->
                <div class="mt-4">
                    <a href="{{ route('bookLaundry') }}" class="btn-book-now">
                        <i class="fa fa-basket-shopping me-2"></i>
                        Book Laundry Now
                        <i class="fa fa-arrow-right ms-2 btn-arrow"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</div> --}}

{{-- <style>
    .customer-items-page-refined {
        font-family: 'Inter', 'Segoe UI', sans-serif;
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
        background: linear-gradient(to bottom, #f8f9fa 0%, #ffffff 100%);
        min-height: 100vh;
    }

    /* ── Header ─────────────────────────────────────────────── */
    .page-title    { font-size: 2.25rem; font-weight: 700; color: #1a1a2e; letter-spacing: -0.5px; }
    .page-subtitle { font-size: 1.1rem; color: #6c757d; margin: 0; }

    /* ── Search ─────────────────────────────────────────────── */
    .search-section   { display: flex; justify-content: center; }
    .search-container { position: relative; width: 100%; max-width: 600px; }
    .search-icon {
        position: absolute; left: 1.25rem; top: 50%;
        transform: translateY(-50%);
        color: #6c757d; font-size: 1rem; pointer-events: none;
    }
    .search-input {
        width: 100%;
        padding: 1rem 1.5rem 1rem 3.25rem;
        border: 2px solid #e0e0e0;
        border-radius: 16px;
        background: #fff;
        font-size: 1rem;
        transition: all .3s;
        box-shadow: 0 2px 8px rgba(0,0,0,.04);
    }
    .search-input::placeholder { color: #adb5bd; }
    .search-input:focus {
        outline: none;
        border-color: #4f46e5;
        box-shadow: 0 4px 16px rgba(79,70,229,.15);
    }

    /* ── Category header ─────────────────────────────────────── */
    .category-header-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: .75rem;
        border-bottom: 2px solid #e9ecef;
    }
    .category-title { font-size: 1.5rem; font-weight: 700; color: #1a1a2e; margin: 0; }
    .category-count {
        font-size: .9rem; color: #6c757d;
        background: #f1f3f5;
        padding: .375rem .875rem;
        border-radius: 50px; font-weight: 500;
    }

    /* ── Card animation ──────────────────────────────────────── */
    .item-card-wrapper { animation: fadeInUp .5s ease forwards; opacity: 0; }
    .item-card-wrapper:nth-child(1) { animation-delay: .05s; }
    .item-card-wrapper:nth-child(2) { animation-delay: .10s; }
    .item-card-wrapper:nth-child(3) { animation-delay: .15s; }
    .item-card-wrapper:nth-child(4) { animation-delay: .20s; }
    .item-card-wrapper:nth-child(n+5) { animation-delay: .25s; }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* ── Item Card ───────────────────────────────────────────── */
    .item-card {
        background: #fff;
        border: 1px solid #e9ecef;
        border-radius: 20px;
        padding: 2rem 1.5rem;
        text-align: center;
        transition: all .3s;
        box-shadow: 0 2px 8px rgba(0,0,0,.04);
        display: flex;
        flex-direction: column;
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }
    .item-card::before {
        content: '';
        position: absolute; top: 0; left: 0;
        width: 100%; height: 4px;
        background: linear-gradient(90deg, #4f46e5, #06b6d4);
        transform: scaleX(0);
        transition: transform .3s;
    }
    .item-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0,0,0,.1);
        border-color: #4f46e5;
    }
    .item-card:hover::before { transform: scaleX(1); }

    /* ── Icon ────────────────────────────────────────────────── */
    .item-icon-wrapper {
        width: 72px; height: 72px;
        margin: 0 auto 1.25rem;
        background: linear-gradient(135deg, #4f46e5, #06b6d4);
        border-radius: 18px;
        display: flex; align-items: center; justify-content: center;
        transition: all .3s;
        box-shadow: 0 4px 12px rgba(79,70,229,.25);
    }
    .item-card:hover .item-icon-wrapper {
        transform: scale(1.1) rotate(5deg);
        box-shadow: 0 8px 20px rgba(79,70,229,.35);
    }
    .item-icon { font-size: 1.75rem; color: #fff; }

    /* ── Content ─────────────────────────────────────────────── */
    .item-content  { flex: 1; margin-bottom: 1.25rem; }
    .item-title    { font-size: 1.1rem; font-weight: 700; color: #1a1a2e; margin-bottom: .5rem; }
    .item-description { font-size: .9rem; color: #6c757d; margin: 0 0 .75rem; line-height: 1.5; }
    .price-preview { margin-top: .75rem; }
    .price-tag {
        display: inline-block;
        background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
        color: #0369a1;
        padding: .375rem .875rem;
        border-radius: 8px;
        font-size: .85rem; font-weight: 600;
    }

    /* ── Button ──────────────────────────────────────────────── */
    .select-btn {
        width: 100%;
        padding: .75rem 1.25rem;
        background: #f8f9fa;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        color: #4f46e5;
        font-weight: 600; font-size: .95rem;
        cursor: pointer;
        transition: all .3s;
        display: flex; align-items: center; justify-content: center; gap: .5rem;
    }
    .btn-arrow { font-size: .85rem; transition: transform .3s; }
    .select-btn:hover {
        background: #4f46e5; border-color: #4f46e5; color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(79,70,229,.3);
    }
    .select-btn:hover .btn-arrow { transform: translateX(4px); }

    /* ── Empty state ─────────────────────────────────────────── */
    .empty-state {
        text-align: center; color: #adb5bd; font-size: .95rem;
        padding: 2rem; background: #f8f9fa; border-radius: 12px;
    }

    /* ── Responsive overrides ────────────────────────────────── */
    @media (max-width: 768px) {
        .customer-items-page-refined { padding: 1.5rem 1rem; }
        .page-title    { font-size: 1.75rem; }
        .page-subtitle { font-size: 1rem; }
        .item-card     { padding: 1.5rem 1rem; }
        .item-icon-wrapper { width: 60px; height: 60px; }
        .item-icon     { font-size: 1.5rem; }
        .category-header-wrapper { flex-direction: column; align-items: flex-start; gap: .5rem; }
    }

    /* ── Modal ───────────────────────────────────────────────── */
    .item-modal {
        border-radius: 24px;
        border: none;
        overflow: hidden;
    }
    .modal-header-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
        width: 100%;
        text-align: center;
    }
    .modal-icon-wrapper {
        width: 80px; height: 80px;
        background: linear-gradient(135deg, #4f46e5, #06b6d4);
        border-radius: 20px;
        display: flex; align-items: center; justify-content: center;
        box-shadow: 0 8px 24px rgba(79,70,229,.3);
    }
    .modal-icon-wrapper i { font-size: 2rem; color: #fff; }
    .modal-title  { font-size: 1.5rem; font-weight: 700; color: #1a1a2e; margin: 0; }
    .service-title { font-size: 1.1rem; font-weight: 700; color: #1a1a2e; margin-bottom: 1.25rem; }

    .service-card {
        background: #f8f9fa;
        border: 2px solid #e9ecef;
        border-radius: 16px;
        padding: 1.25rem;
        margin-bottom: 1rem;
        transition: all .3s;
        position: relative;
    }
    .service-card.featured {
        background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
        border-color: #0369a1;
    }
    .service-card:hover {
        border-color: #4f46e5;
        transform: translateY(-4px);
        box-shadow: 0 8px 16px rgba(0,0,0,.1);
    }
    .popular-badge {
        position: absolute; top: -12px; right: 1rem;
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: #fff;
        padding: .25rem .75rem;
        border-radius: 20px;
        font-size: .75rem; font-weight: 600;
        box-shadow: 0 4px 12px rgba(245,158,11,.3);
    }
    .service-header {
        display: flex; align-items: center; gap: 1rem; margin-bottom: .75rem;
    }
    .service-icon {
        width: 48px; height: 48px;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        color: #fff; font-size: 1.25rem; flex-shrink: 0;
    }
    .wash-icon  { background: linear-gradient(135deg, #3b82f6, #2563eb); }
    .iron-icon  { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }
    .combo-icon { background: linear-gradient(135deg, #10b981, #059669); }
    .service-info { flex: 1; }
    .service-name { font-size: 1rem; font-weight: 700; color: #1a1a2e; margin: 0 0 .25rem; }
    .service-desc { font-size: .85rem; color: #6c757d; margin: 0; }
    .service-price { text-align: right; flex-shrink: 0; }
    .price-amount  { display: block; font-size: 1.5rem; font-weight: 700; color: #1a1a2e; }
    .price-label   { font-size: .8rem; color: #6c757d; }

    .info-section {
        margin-top: 1.5rem; padding-top: 1.5rem;
        border-top: 1px solid #e9ecef;
        display: flex; flex-direction: column; gap: .75rem;
    }
    .info-item  { display: flex; align-items: center; gap: .75rem; color: #6c757d; font-size: .9rem; }
    .info-icon  { color: #4f46e5; font-size: 1rem; }

    /* ── Book Now Button ─────────────────────────────────────── */
    .btn-book-now {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        padding: 1rem 1.5rem;
        background: linear-gradient(135deg, #4f46e5, #06b6d4);
        border: none;
        border-radius: 14px;
        color: #fff;
        font-weight: 700;
        font-size: 1rem;
        text-decoration: none;
        transition: all .3s;
        box-shadow: 0 4px 16px rgba(79, 70, 229, .3);
    }
    .btn-book-now:hover {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(79, 70, 229, .45);
        background: linear-gradient(135deg, #4338ca, #0891b2);
    }
    .btn-book-now .btn-arrow { transition: transform .3s; }
    .btn-book-now:hover .btn-arrow { transform: translateX(4px); }

</style> --}}

{{-- <script>
    function showItemDetails(itemId, itemName, itemIcon, washingPrice, ironingPrice, washIronPrice) {
        document.getElementById('modalItemName').textContent = itemName;
        document.querySelector('#modalIcon i').className = itemIcon;

        const fmt = n => '₦' + parseFloat(n).toLocaleString('en-NG', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        document.getElementById('washingPrice').textContent  = fmt(washingPrice);
        document.getElementById('ironingPrice').textContent  = fmt(ironingPrice);
        document.getElementById('washIronPrice').textContent = fmt(washIronPrice);

        const modal = new bootstrap.Modal(document.getElementById('itemDetailsModal'));
        modal.show();
    }

    // Search
    document.getElementById('searchInput')?.addEventListener('input', function (e) {
        const term = e.target.value.toLowerCase();
        document.querySelectorAll('.item-card-wrapper').forEach(card => {
            const name = card.querySelector('.item-title')?.textContent.toLowerCase() || '';
            card.style.display = name.includes(term) ? '' : 'none';
        });
    });
</script> --}}


{{-- main --}}
<div class="customer-items-page-refined">

    <!-- Header -->
    <div class="page-header text-center mb-5">
        <h3 class="page-title">Items We Take Care Of</h3>
        <p class="page-subtitle">
            Select from the list of clothes we professionally wash and iron
        </p>
    </div>

    <!-- Search Bar -->
    <div class="search-section mb-5">
        <div class="search-container">
            <i class="fa fa-search search-icon"></i>
            <input type="text" class="search-input" placeholder="Search items e.g. Shirt, Bedsheet…" id="searchInput">
        </div>
    </div>

    <!-- Categories -->
    @foreach ($categories as $category)
        <div class="category-block mb-5">

            <!-- Category Header -->
            <div class="category-header-wrapper mb-4">
                <h5 class="category-title">{{ $category->type }}</h5>
                <span class="category-count">{{ $category->items->where('is_active', 1)->count() }} items</span>
            </div>

            <!-- Items Grid — Bootstrap row for full responsive control -->
            <div class="row g-3">
                @forelse($category->items->where('is_active', 1) as $item)
                    {{-- col-6 = 2 per row on mobile, col-md-4 = 3 on tablet, col-lg-3 = 4 on desktop --}}
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 item-card-wrapper">
                        <div class="item-card h-100" data-item-id="{{ $item->id }}">

                            <!-- Icon -->
                            <div class="item-icon-wrapper">
                                <i class="{{ $item->icon }} item-icon"></i>
                            </div>

                            <!-- Content -->
                            <div class="item-content">
                                <h6 class="item-title">{{ $item->name }}</h6>
                                <p class="item-description">Cleaned with care & attention</p>
                                <div class="price-preview">
                                    <span class="price-tag">From ₦{{ number_format($item->washing_price, 2) }}</span>
                                </div>
                            </div>

                            <!-- Button -->
                            <button class="select-btn mt-auto"
                                onclick="showItemDetails({{ $item->id }}, '{{ $item->name }}', '{{ $item->icon }}', {{ $item->washing_price }}, {{ $item->ironing_price }}, {{ $item->wash_and_iron_price }})">
                                <span>View Details</span>
                                <i class="fa fa-arrow-right btn-arrow"></i>
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="empty-state">No items available in this category.</p>
                    </div>
                @endforelse
            </div>

        </div>
    @endforeach

</div>

{{-- Item Details Modal --}}
<div class="modal fade" id="itemDetailsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content item-modal">

            <div class="modal-header border-0 pb-0 pt-3 px-4">
                <div class="modal-header-content">
                    <div class="modal-icon-wrapper" id="modalIcon">
                        <i class="fa fa-shirt"></i>
                    </div>
                    <h5 class="modal-title mt-2" id="modalItemName">Item Name</h5>
                </div>
                <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <div class="modal-body px-3 pt-2 pb-3">

                <p class="service-title mb-2">Services & Pricing</p>

                <!-- 3 service pills in a row -->
                <div class="row g-2 mb-3">
                    <div class="col-4">
                        <div class="svc-pill wash-pill">
                            <div class="svc-pill-icon"><i class="fa fa-droplet"></i></div>
                            <div class="svc-pill-name">Washing</div>
                            <div class="svc-pill-price" id="washingPrice">₦0</div>
                            <div class="svc-pill-label">per piece</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="svc-pill iron-pill">
                            <div class="svc-pill-icon"><i class="fa fa-fire"></i></div>
                            <div class="svc-pill-name">Ironing</div>
                            <div class="svc-pill-price" id="ironingPrice">₦0</div>
                            <div class="svc-pill-label">per piece</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="svc-pill combo-pill">
                            <span class="svc-popular">Popular</span>
                            <div class="svc-pill-icon"><i class="fa fa-star"></i></div>
                            <div class="svc-pill-name">Wash & Iron</div>
                            <div class="svc-pill-price" id="washIronPrice">₦0</div>
                            <div class="svc-pill-label">per piece</div>
                        </div>
                    </div>
                </div>

                <!-- Info chips in a 2-col grid -->
                <div class="info-chips">
                    <div class="info-chip"><i class="fa fa-clock"></i> 24–48 hrs</div>
                    <div class="info-chip"><i class="fa fa-shield-halved"></i> Quality guaranteed</div>
                    <div class="info-chip"><i class="fa fa-truck"></i> Pickup & delivery</div>
                    <div class="info-chip"><i class="fa fa-tags"></i> Best price promise</div>
                </div>

                <!-- Book Now -->
                <a href="{{ route('bookLaundry') }}" class="btn-book-now mt-3">
                    <i class="fa fa-basket-shopping me-2"></i>
                    Book Laundry Now
                    <i class="fa fa-arrow-right ms-2 btn-arrow"></i>
                </a>

            </div>
        </div>
    </div>
</div>

<style>
    .customer-items-page-refined {
        font-family: 'Inter', 'Segoe UI', sans-serif;
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
        background: linear-gradient(to bottom, #f8f9fa 0%, #ffffff 100%);
        min-height: 100vh;
    }

    /* ── Header ─────────────────────────────────────────────── */
    .page-title {
        font-size: 2.25rem;
        font-weight: 700;
        color: #1a1a2e;
        letter-spacing: -0.5px;
    }

    .page-subtitle {
        font-size: 1.1rem;
        color: #6c757d;
        margin: 0;
    }

    /* ── Search ─────────────────────────────────────────────── */
    .search-section {
        display: flex;
        justify-content: center;
    }

    .search-container {
        position: relative;
        width: 100%;
        max-width: 600px;
    }

    .search-icon {
        position: absolute;
        left: 1.25rem;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
        font-size: 1rem;
        pointer-events: none;
    }

    .search-input {
        width: 100%;
        padding: 1rem 1.5rem 1rem 3.25rem;
        border: 2px solid #e0e0e0;
        border-radius: 16px;
        background: #fff;
        font-size: 1rem;
        transition: all .3s;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .04);
    }

    .search-input::placeholder {
        color: #adb5bd;
    }

    .search-input:focus {
        outline: none;
        border-color: #4f46e5;
        box-shadow: 0 4px 16px rgba(79, 70, 229, .15);
    }

    /* ── Category header ─────────────────────────────────────── */
    .category-header-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: .75rem;
        border-bottom: 2px solid #e9ecef;
    }

    .category-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1a1a2e;
        margin: 0;
    }

    .category-count {
        font-size: .9rem;
        color: #6c757d;
        background: #f1f3f5;
        padding: .375rem .875rem;
        border-radius: 50px;
        font-weight: 500;
    }

    /* ── Card animation ──────────────────────────────────────── */
    .item-card-wrapper {
        animation: fadeInUp .5s ease forwards;
        opacity: 0;
    }

    .item-card-wrapper:nth-child(1) {
        animation-delay: .05s;
    }

    .item-card-wrapper:nth-child(2) {
        animation-delay: .10s;
    }

    .item-card-wrapper:nth-child(3) {
        animation-delay: .15s;
    }

    .item-card-wrapper:nth-child(4) {
        animation-delay: .20s;
    }

    .item-card-wrapper:nth-child(n+5) {
        animation-delay: .25s;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ── Item Card ───────────────────────────────────────────── */
    .item-card {
        background: #fff;
        border: 1px solid #e9ecef;
        border-radius: 20px;
        padding: 2rem 1.5rem;
        text-align: center;
        transition: all .3s;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .04);
        display: flex;
        flex-direction: column;
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }

    .item-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #4f46e5, #06b6d4);
        transform: scaleX(0);
        transition: transform .3s;
    }

    .item-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, .1);
        border-color: #4f46e5;
    }

    .item-card:hover::before {
        transform: scaleX(1);
    }

    /* ── Icon ────────────────────────────────────────────────── */
    .item-icon-wrapper {
        width: 72px;
        height: 72px;
        margin: 0 auto 1.25rem;
        background: linear-gradient(135deg, #4f46e5, #06b6d4);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all .3s;
        box-shadow: 0 4px 12px rgba(79, 70, 229, .25);
    }

    .item-card:hover .item-icon-wrapper {
        transform: scale(1.1) rotate(5deg);
        box-shadow: 0 8px 20px rgba(79, 70, 229, .35);
    }

    .item-icon {
        font-size: 1.75rem;
        color: #fff;
    }

    /* ── Content ─────────────────────────────────────────────── */
    .item-content {
        flex: 1;
        margin-bottom: 1.25rem;
    }

    .item-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1a1a2e;
        margin-bottom: .5rem;
    }

    .item-description {
        font-size: .9rem;
        color: #6c757d;
        margin: 0 0 .75rem;
        line-height: 1.5;
    }

    .price-preview {
        margin-top: .75rem;
    }

    .price-tag {
        display: inline-block;
        background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
        color: #0369a1;
        padding: .375rem .875rem;
        border-radius: 8px;
        font-size: .85rem;
        font-weight: 600;
    }

    /* ── Button ──────────────────────────────────────────────── */
    .select-btn {
        width: 100%;
        padding: .75rem 1.25rem;
        background: #f8f9fa;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        color: #4f46e5;
        font-weight: 600;
        font-size: .95rem;
        cursor: pointer;
        transition: all .3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: .5rem;
    }

    .btn-arrow {
        font-size: .85rem;
        transition: transform .3s;
    }

    .select-btn:hover {
        background: #4f46e5;
        border-color: #4f46e5;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(79, 70, 229, .3);
    }

    .select-btn:hover .btn-arrow {
        transform: translateX(4px);
    }

    /* ── Empty state ─────────────────────────────────────────── */
    .empty-state {
        text-align: center;
        color: #adb5bd;
        font-size: .95rem;
        padding: 2rem;
        background: #f8f9fa;
        border-radius: 12px;
    }

    /* ── Responsive overrides ────────────────────────────────── */
    @media (max-width: 768px) {
        .customer-items-page-refined {
            padding: 1.5rem 1rem;
        }

        .page-title {
            font-size: 1.75rem;
        }

        .page-subtitle {
            font-size: 1rem;
        }

        .item-card {
            padding: 1.5rem 1rem;
        }

        .item-icon-wrapper {
            width: 60px;
            height: 60px;
        }

        .item-icon {
            font-size: 1.5rem;
        }

        .category-header-wrapper {
            flex-direction: column;
            align-items: flex-start;
            gap: .5rem;
        }
    }

    /* ── Modal ───────────────────────────────────────────────── */
    .item-modal {
        border-radius: 20px;
        border: none;
        overflow: hidden;
    }

    .modal-header-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: .4rem;
        width: 100%;
        text-align: center;
    }

    .modal-icon-wrapper {
        width: 52px;
        height: 52px;
        background: linear-gradient(135deg, #4f46e5, #06b6d4);
        border-radius: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 5px 14px rgba(79, 70, 229, .3);
    }

    .modal-icon-wrapper i {
        font-size: 1.35rem;
        color: #fff;
    }

    .modal-title {
        font-size: 1.05rem;
        font-weight: 700;
        color: #1a1a2e;
        margin: 0;
    }

    .service-title {
        font-size: .7rem;
        font-weight: 700;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: .07em;
        margin-bottom: .5rem;
    }

    /* ── Service Pills (3 equal cols) ───────────────────────── */
    .svc-pill {
        border: 2px solid #e9ecef;
        border-radius: 12px;
        padding: .7rem .4rem;
        text-align: center;
        background: #fafafa;
        transition: all .25s;
        position: relative;
        height: 100%;
    }

    .svc-pill:hover {
        border-color: #4f46e5;
        background: #f5f3ff;
        transform: translateY(-2px);
    }

    .wash-pill:hover {
        border-color: #3b82f6;
        background: #eff6ff;
    }

    .iron-pill:hover {
        border-color: #8b5cf6;
        background: #f5f3ff;
    }

    .combo-pill {
        border-color: #bae6fd;
        background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
    }

    .combo-pill:hover {
        border-color: #4f46e5;
        background: #eff6ff;
    }

    .svc-popular {
        position: absolute;
        top: -9px;
        left: 50%;
        transform: translateX(-50%);
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: #fff;
        font-size: .6rem;
        font-weight: 700;
        padding: .1rem .5rem;
        border-radius: 20px;
        white-space: nowrap;
    }

    .svc-pill-icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: .85rem;
        color: #fff;
        margin: 0 auto .35rem;
    }

    .wash-pill .svc-pill-icon {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
    }

    .iron-pill .svc-pill-icon {
        background: linear-gradient(135deg, #8b5cf6, #7c3aed);
    }

    .combo-pill .svc-pill-icon {
        background: linear-gradient(135deg, #10b981, #059669);
    }

    .svc-pill-name {
        font-size: .7rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: .15rem;
    }

    .svc-pill-price {
        font-size: .95rem;
        font-weight: 700;
        color: #1a1a2e;
        line-height: 1.2;
    }

    .svc-pill-label {
        font-size: .6rem;
        color: #9ca3af;
    }

    /* ── Info chips 2×2 grid ─────────────────────────────────── */
    .info-chips {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: .35rem;
    }

    .info-chip {
        display: flex;
        align-items: center;
        gap: .35rem;
        background: #f3f4f6;
        border-radius: 7px;
        padding: .35rem .5rem;
        font-size: .7rem;
        color: #6b7280;
        font-weight: 500;
    }

    .info-chip i {
        color: #4f46e5;
        font-size: .75rem;
        flex-shrink: 0;
    }

    /* ── Book Now Button ─────────────────────────────────────── */
    .btn-book-now {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        padding: .7rem 1rem;
        background: linear-gradient(135deg, #4f46e5, #06b6d4);
        border: none;
        border-radius: 11px;
        color: #fff;
        font-weight: 700;
        font-size: .9rem;
        text-decoration: none;
        transition: all .3s;
        box-shadow: 0 4px 14px rgba(79, 70, 229, .3);
    }

    .btn-book-now:hover {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 7px 20px rgba(79, 70, 229, .4);
        background: linear-gradient(135deg, #4338ca, #0891b2);
    }

    .btn-book-now .btn-arrow {
        transition: transform .3s;
    }

    .btn-book-now:hover .btn-arrow {
        transform: translateX(4px);
    }
</style>

<script>
    function showItemDetails(itemId, itemName, itemIcon, washingPrice, ironingPrice, washIronPrice) {
        document.getElementById('modalItemName').textContent = itemName;
        document.querySelector('#modalIcon i').className = itemIcon;

        const fmt = n => '₦' + parseFloat(n).toLocaleString('en-NG', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
        document.getElementById('washingPrice').textContent = fmt(washingPrice);
        document.getElementById('ironingPrice').textContent = fmt(ironingPrice);
        document.getElementById('washIronPrice').textContent = fmt(washIronPrice);

        const modal = new bootstrap.Modal(document.getElementById('itemDetailsModal'));
        modal.show();
    }

    // Search
    document.getElementById('searchInput')?.addEventListener('input', function(e) {
        const term = e.target.value.toLowerCase();
        document.querySelectorAll('.item-card-wrapper').forEach(card => {
            const name = card.querySelector('.item-title')?.textContent.toLowerCase() || '';
            card.style.display = name.includes(term) ? '' : 'none';
        });
    });
</script>
