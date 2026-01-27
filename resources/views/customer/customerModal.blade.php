    <!-- Item Details Modal -->
    <div class="modal fade" id="itemDetailsModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content item-modal">
                <div class="modal-header border-0">
                    <div class="modal-header-content">
                        <div class="modal-icon-wrapper" id="modalIcon">
                            <i class="fa fa-tshirt"></i>
                        </div>
                        <h5 class="modal-title" id="modalItemName">Item Name</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <!-- Service Options -->
                    <div class="service-options">
                        <h6 class="service-title">Choose Your Service</h6>

                        <!-- Washing Only -->
                        <div class="service-card">
                            <div class="service-header">
                                <div class="service-icon wash-icon">
                                    <i class="fa fa-water"></i>
                                </div>
                                <div class="service-info">
                                    <h6 class="service-name">Washing Only</h6>
                                    <p class="service-desc">Professional washing service</p>
                                </div>
                            </div>
                            <div class="service-price">
                                <span class="price-amount" id="washingPrice">₦0.00</span>
                                <span class="price-label">per item</span>
                            </div>
                        </div>

                        <!-- Ironing Only -->
                        <div class="service-card">
                            <div class="service-header">
                                <div class="service-icon iron-icon">
                                    <i class="fa fa-wind"></i>
                                </div>
                                <div class="service-info">
                                    <h6 class="service-name">Ironing Only</h6>
                                    <p class="service-desc">Crisp & clean ironing</p>
                                </div>
                            </div>
                            <div class="service-price">
                                <span class="price-amount" id="ironingPrice">₦0.00</span>
                                <span class="price-label">per item</span>
                            </div>
                        </div>

                        <!-- Wash & Iron -->
                        <div class="service-card featured">
                            <div class="popular-badge">
                                <i class="fa fa-star"></i> Most Popular
                            </div>
                            <div class="service-header">
                                <div class="service-icon combo-icon">
                                    <i class="fa fa-sync"></i>
                                </div>
                                <div class="service-info">
                                    <h6 class="service-name">Wash & Iron</h6>
                                    <p class="service-desc">Complete laundry service</p>
                                </div>
                            </div>
                            <div class="service-price">
                                <span class="price-amount" id="washIronPrice">₦0.00</span>
                                <span class="price-label">per item</span>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Info -->
                    <div class="info-section">
                        <div class="info-item">
                            <i class="fa fa-clock info-icon"></i>
                            <span>24-48 hours turnaround</span>
                        </div>
                        <div class="info-item">
                            <i class="fa fa-shield-alt info-icon"></i>
                            <span>100% satisfaction guaranteed</span>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0">
                    <button type="button" class="btn-select-service">
                        <i class="fa fa-check-circle me-2"></i>
                        Select This Item
                    </button>
                </div>
            </div>
        </div>
    </div>
