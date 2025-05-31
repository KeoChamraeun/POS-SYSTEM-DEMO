<div class="container-fluid mt-4">
    <div class="row">
        {{-- Left Column: Categories + Products --}}
        <div class="col-lg-8">

            {{-- Categories --}}
            <div class="mb-3">
                <h5 class="fw-bold mb-3">Categories</h5>
                <div class="d-flex flex-wrap gap-2">
                    <button wire:click="$set('selectedCategory', null)" class="btn btn-outline-warning">
                        All Categories<br><small class="text-muted">80 Items</small>
                    </button>
                    @foreach($categories as $category)
                    <button wire:click="$set('selectedCategory', '{{ $category }}')"
                        class="btn btn-outline-primary {{ $selectedCategory === $category ? 'border-2 border-primary' : '' }}">
                        {{ $category }}<br><small class="text-muted">80 Items</small>
                    </button>
                    @endforeach
                </div>
            </div>

            {{-- Menu --}}
            <h5 class="fw-bold mt-4 mb-3">Products</h5>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <h5 class="mb-3">Menus</h5>
                    @foreach($menus as $menu)
                    <button wire:click="addMenu({{ $menu->id }})" class="btn btn-outline-primary w-100 mb-2">
                        {{ $menu->name }} - {{ $menu->price }} Tk
                    </button>
                    @endforeach
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
            <div class="row">
                @foreach($items as $item)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100" style="cursor: pointer;" wire:click="addItem({{ $item->id }})">
                        <img src="{{asset($item->image)}}" class="card-img-top"
                            alt="{{ $item->name }}">
                        <div class="card-body d-flex flex-column">
                            <h6 class="text-muted">{{ $item->menu->name }}</h6>
                            <h5 class="fw-bold">{{ $item->name }}</h5>
                            {{-- <p class="mb-1 text-pink">30 Pcs</p> --}}
                            <p class="text-success fw-bold">${{ number_format($item->price, 2) }}</p>
                            <button wire:click="addItem({{ $item->id }})" class="btn btn-primary mt-auto">Add to
                                Cart</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Right Column: Customer Info + Cart --}}
        <div class="col-lg-4">
            <div class="sticky-top" style="top: 80px;">
                {{-- Flash messages --}}
                @if(session()->has('success'))
                <div class="alert alert-success mt-3">{{ session('success') }}</div>
                @endif
                @if(session()->has('error'))
                <div class="alert alert-danger mt-3">{{ session('error') }}</div>
                @endif
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="fw-bold">Customer Information</h5>
                        <select class="form-select mb-2" wire:model="customerName">
                            <option value="Walk in Customer">Walk in Customer</option>
                            @foreach($customers as $customer)
                            <option value="{{ $customer->name }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                        <input type="text" class="form-control mb-2" placeholder="Search Products">
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
                            <img src="{{asset($cartItem['image'])}}" class="me-2 rounded"
                                alt="{{ $cartItem['name'] }}" width="25" height="25">
                            <div class="flex-grow-1">
                                <small class="badge bg-warning text-dark mb-1">#{{ strtoupper($cartItem['type'])
                                    }}</small>
                                <div class="fw-bold">{{ $cartItem['name'] }}</div>
                                <div class="text-success">${{ number_format($cartItem['price'], 2) }}</div>
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
                                <option value="{{ $vat->rate }}">{{ $vat->name }} ({{ $vat->rate }}%)</option>
                                @endforeach
                            </select>
                        </div>
                        <hr>
                        <p class="mb-1">Sub Total: <span class="float-end">${{ number_format($this->getSubTotal(), 2)
                                }}</span></p>
                        <p class="mb-1"> 
                            <span class="text-danger">Discount 
                            <a href="#" class="link-default" data-bs-toggle="modal" data-bs-target="#discount"><i class="ti ti-edit"></i></a>: </span>
                            <span class="float-end">${{ number_format($this->getDiscount(), 2) }}</span></p>
                        <p class="mb-1">VAT (GST {{ $this->vat  }}%): <span class="float-end">${{ number_format($this->getTotal() *
                                ($this->vat / 100), 2) }}</span></p>
                        <p class="mb-1">Adjustment: <span class="float-end">$0.00</span></p>
                        <hr>
                        <p class="fw-bold">Total: <span class="float-end">${{ number_format($this->getTotal() - $this->getDiscount() + ($this->getTotal() * ($this->vat / 100)), 2)
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
                                        class="payment-item d-flex align-items-center gap-2 p-3 border rounded shadow-sm {{ $paymentMethod === 'bkash' ? 'border-warning bg-warning bg-opacity-10' : '' }}"
                                        wire:click="$set('paymentMethod', 'bkash')"
                                        style="text-decoration: none; min-width: 140px;">
                                        <i class="ti ti-building-bank fs-2 text-primary"></i>
                                        <span class="fw-bold text-dark">Bkash</span>
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
                            <select class="select" wire:model="discountType">
                                <option>Select</option>
                                <option>Flat</option>
                                <option>Percentage</option>
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