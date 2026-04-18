<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fw-bold mb-0 text-dark tracking-tight">
                <i class="bi bi-plus-square text-primary me-2"></i> Log New Transaction
            </h2>
        </div>
    </x-slot>

    <div class="py-5">
        <div class="container-fluid max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="glass-card card p-4 p-md-5">
                        <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
                            <h4 class="fw-bold mb-0 text-dark">Transaction Details</h4>
                            <a href="{{ route('dashboard') }}" class="btn btn-light rounded-pill px-4 shadow-sm fw-medium text-secondary hover-bg-light transition-all">
                                <i class="bi bi-arrow-left me-1"></i> Cancel
                            </a>
                        </div>

                        <form action="{{ route('transactions.store') }}" method="POST">
                            @csrf
                            
                            <div class="row g-4 mb-4">
                                <!-- Type Selection -->
                                <div class="col-md-6">
                                    <label for="type" class="form-label fw-semibold text-secondary" style="font-size: 0.9rem;">Transaction Type</label>
                                    <select class="form-select form-select-lg bg-light border-0 shadow-none @error('type') is-invalid @enderror" id="type" name="type" required>
                                        <option value="expense" {{ old('type', 'expense') == 'expense' ? 'selected' : '' }}>Expense (Spending)</option>
                                        <option value="income" {{ old('type') == 'income' ? 'selected' : '' }}>Income (Earnings)</option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Date Selection -->
                                <div class="col-md-6">
                                    <label for="date" class="form-label fw-semibold text-secondary" style="font-size: 0.9rem;">Transaction Date</label>
                                    <input type="date" class="form-control form-control-lg bg-light border-0 shadow-none @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required>
                                    @error('date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Category -->
                                <div class="col-md-6">
                                    <label for="category" class="form-label fw-semibold text-secondary" style="font-size: 0.9rem;">Category Tag</label>
                                    <input type="text" class="form-control form-control-lg bg-light border-0 shadow-none @error('category') is-invalid @enderror" id="category" name="category" value="{{ old('category') }}" placeholder="e.g., Groceries, Rent, Salary" required>
                                    @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Amount -->
                                <div class="col-md-6">
                                    <label for="amount" class="form-label fw-semibold text-secondary" style="font-size: 0.9rem;">Amount Value</label>
                                    <div class="input-group input-group-lg">
<span class="input-group-text bg-light border-0 text-muted fw-bold">৳</span>                                        <input type="number" step="0.01" min="0.01" class="form-control bg-light border-0 shadow-none @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount') }}" placeholder="0.00" required>
                                        @error('amount')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-4 pt-3 border-top">
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm fw-semibold">
                                    Save Transaction <i class="bi bi-check2-circle ms-2"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
