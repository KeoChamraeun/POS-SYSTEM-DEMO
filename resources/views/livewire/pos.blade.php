<div class="container-fluid mt-4">

    <style>
        .product-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }


        .border:hover {
            background-color: #ffff;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }
    </style>
    <div class="row">
        {{-- Left Column: Categories + Products --}}
        <div class="col-lg-8">

            {{-- Categories --}}
            <div class="mb-3">
                <h5 class="fw-bold mb-3">Categories</h5>
                <div class="d-flex flex-wrap gap-2">
                    <button wire:click="$set('selectedCategory', null)" class="btn btn-outline-warning">
                        All Categories<br><small class="text-muted">{{ $numberOfItems}} Items</small>
                    </button>
                    @foreach($categories as $category)
                    <button wire:click="$set('selectedCategory', '{{ $category->id }}')"
                        class="btn btn-outline-primary {{ $selectedCategory === $category ? 'border-2 border-primary' : '' }}">
                        {{ $category->name }}<br><small class="text-muted">{{ $category->menuItems()->count() }}
                            Items</small>
                    </button>
                    @endforeach
                </div>
            </div>

            {{-- Menu --}}
            <div class="row">
                <div class="col-12 mb-3">
                    <h5 class="mb-3">Menus</h5>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($menus as $menu)
                        <button wire:click="addMenu({{ $menu->id }})" wire:loading.attr="disabled" wire:target="addMenu"
                            class="btn btn-outline-primary">

                            <span wire:loading.remove wire:target="addMenu">
                                {{ $menu->name }} - {{ number_format($menu->price, 2) }} Tk
                            </span>

                            <span wire:loading wire:target="addMenu">
                                Loading...
                            </span>
                        </button>
                        @endforeach
                    </div>
                </div>
            </div>


            {{-- Products --}}
            <div class="d-flex align-items-center justify-content-between">
                <h4 class="mb-3">Products</h4>
                <div class="input-icon-start pos-search position-relative mb-3">
                    <span class="input-icon-addon">
                        <i class="ti ti-search"></i>
                    </span>
                    <input type="text" class="form-control" placeholder="Search Product"
                        wire:model.live.debounce.300ms="searchTerm">
                </div>
            </div>

            <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 g-2 mb-5">
                @foreach($items as $item)
                <div class="col">
                    <div class="border rounded text-center p-2 h-100 shadow-md" style="cursor: pointer;"
                        wire:click="addItem({{ $item->id }})">
                        <img src="{{ asset($item->image) }}" alt="{{ $item->name }}" class="mb-2"
                            style="height: 100px; object-fit: contain;">
                        <div class="fw-semibold small text-dark fw-bold mb-1">{{ $item->name }}</div>
                        <div class="text-success fw-bold small">${{ number_format($item->price, 2) }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Right Column: Customer Info + Cart --}}
        <div class="col-lg-4">
            <div class="sticky-top" style="top: 80px; z-index: 9 !important;">
                {{-- Flash messages --}}
                @if(session()->has('success'))
                <div class="alert alert-success mt-3">{{ session('success') }}</div>
                @endif
                @if(session()->has('error'))
                <div class="alert alert-danger mt-3">{{ session('error') }}</div>
                @endif
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="fw-bold mb-1">Customer Information</h5>
                        <select class="form-select mb-2" wire:model="customerName" required>
                            <option value="" disabled>Select Customer</option>
                            @foreach($customers as $customer)
                            <option value="{{ $customer->name }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="fw-bold mb-0">Product Added <span class="badge bg-warning text-dark">{{
                                    count($cart) }}</span></h6>
                            <button wire:click="clearCart" class="btn btn-link text-danger text-decoration-none">Clear
                                all</button>
                        </div>
                        @foreach($cart as $index => $cartItem)
                        <div class="d-flex align-items-center mb-3 border rounded p-2">
                            <img src="{{asset($cartItem['image'])}}" class="me-2 rounded" alt="{{ $cartItem['name'] }}"
                                width="25" height="25">
                            <div class="flex-grow-1">
                                <small class="badge bg-warning text-dark mb-1">#{{ strtoupper($cartItem['type'])
                                    }}</small>
                                <div class="fw-bold">{{ $cartItem['name'] }}</div>
                                <div class="text-success">
                                    ${{ number_format($cartItem['price'], 2) }}
                                </div>
                            </div>
                            <div class="text-end">
                                <div class="btn-group btn-group-sm">
                                    <button wire:click="decreaseQty({{ $index }})"
                                        class="btn btn-outline-secondary">-</button>
                                    <span class="btn btn-light">{{ $cartItem['quantity'] }}</span>
                                    <button wire:click="increaseQty({{ $index }})"
                                        class="btn btn-outline-secondary">+</button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Order Summary --}}
                <div class="card">
                    <div class="card-body">
                        <div class="mb-2">
                            <label class="form-label">Order VAT</label>
                            <select class="form-select mb-2" name="vat" wire:model.live="vat">
                                <option value="">Select Vat</option>
                                @foreach ($vats as $vat)
                                <option value="{{ $vat->rate }}">{{ $vat->name }} ({{ $vat->rate}}%)</option>
                                @endforeach
                            </select>
                        </div>
                        <hr>
                        <p class="mb-1">Sub Total: <span class="float-end">${{ number_format($this->getSubTotal(), 2) }}</span></p>
                        <p class="mb-1">
                            <span class="text-danger">Discount
                                <a href="#" class="link-default" data-bs-toggle="modal" data-bs-target="#discount"><i
                                        class="ti ti-edit"></i></a>: </span>
                            <span class="float-end">${{ number_format($this->getDiscount(), 2) }}</span>
                        </p>
                        <p class="mb-1">VAT (GST {{ number_format($this->vat )}}%): <span class="float-end">${{ number_format($this->getTotal() *
                                ($this->vat / 100), 2) }}</span></p>
                        <p class="mb-1">Adjustment: <span class="float-end">$0.00</span></p>
                        <hr>
                        <p class="fw-bold">Total: <span class="float-end">${{ number_format($this->getTotal() -
                                $this->getDiscount() + ($this->getTotal() * ($this->vat / 100)), 2)
                                }}</span></p>

                        <div class="block-section payment-method">
                            <h4 class="mb-2">Payment Method</h4>
                            <div class="row d-flex align-items-center justify-content-start methods g-2">
                                <div class="col-auto">
                                    <a href="javascript:void(0);"
                                        class="payment-item d-flex align-items-center gap-2 p-3 rounded border shadow-sm {{ $paymentMethod === 'cash' ? 'border-warning bg-warning bg-opacity-10' : '' }}"
                                        wire:click="$set('paymentMethod', 'cash')"
                                        style="text-decoration: none; min-width: 140px;">
                                        <i class="ti ti-cash-banknote fs-2 text-warning"></i>
                                        <span class="fw-bold text-dark">Cash</span>
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <a href="javascript:void(0);"
                                        class="payment-item d-flex align-items-center gap-2 p-3 border rounded shadow-sm {{ $paymentMethod === 'ABA' ? 'border-warning bg-warning bg-opacity-10' : '' }}"
                                        wire:click="$set('paymentMethod', 'ABA')"
                                        style="text-decoration: none; min-width: 140px;">
                                        {{-- <i class="ti ti-building-bank fs-2 text-primary"></i> --}}
                                        <img src="{{ asset('/backend/assets/img/aba.png') }}" alt="ABA ICON" style="width: 30px; height: 30px;">
                                        <span class="fw-bold text-dark">ABA</span>
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <a href="javascript:void(0);"
                                        class="payment-item d-flex align-items-center gap-2 p-3 border rounded shadow-sm {{ $paymentMethod === 'Acleda' ? 'border-warning bg-warning bg-opacity-10' : '' }}"
                                        wire:click="$set('paymentMethod', 'Acleda')"
                                        style="text-decoration: none; min-width: 140px;">
                                        {{-- <i class="ti ti-building-bank fs-2 text-primary"></i> --}}
                                        <img src="{{ asset('/backend/assets/img/Acleda.png') }}" alt="Acleda ICON" style="width: 30px; height: 30px;">
                                        <span class="fw-bold text-dark">Acleda</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <button wire:click="submitOrder" class="btn btn-success w-100 mt-3">Submit Order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Discount -->
    <div class="modal fade modal-default" id="discount">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Discount </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form wire:submit.prevent="getDiscount">
                    <div class="modal-body pb-1">
                        <div class="mb-3">
                            <label class="form-label">Order Discount Type <span class="text-danger">*</span></label>
                            <select class="select form-control" wire:model="discountType">
                                <option value="">Select</option>
                                <option value="flat">Flat</option>
                                <option value="percentage">Percentage</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Value <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" wire:model="discountValue"
                                placeholder="Enter discount value">
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-end flex-wrap gap-2">
                        <button type="button" class="btn btn-md btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-md btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Discount -->
</div>

@script
<script>
    window.addEventListener('closeDiscountModal', () => {
        $('#discount').modal('hide');
    });
</script>
@endscript